<?php

declare(strict_types=1);

namespace Churn\Event;

use Churn\Event\Event\AfterAnalysisEvent;
use Churn\Event\Event\AfterFileAnalysisEvent;
use Churn\Event\Event\BeforeAnalysisEvent;
use Churn\Event\Subscriber\AfterAnalysis;
use Churn\Event\Subscriber\AfterFileAnalysis;
use Churn\Event\Subscriber\BeforeAnalysis;
use Closure;

/**
 * @internal
 */
class Broker
{
    /**
     * @var array<class-string, array<callable>>
     */
    private $subscribers = [];

    /**
     * @var array<array{class-string, callable(mixed): callable, class-string<Event>}>
     */
    private $channels;

    /**
     * Class constructor.
     */
    public function __construct()
    {
        $onAfterAnalysis = static function (AfterAnalysis $subscriber): Closure {
            return static function (AfterAnalysisEvent $event) use ($subscriber): void {
                $subscriber->onAfterAnalysis($event);
            };
        };
        $onAfterFileAnalysis = static function (AfterFileAnalysis $subscriber): Closure {
            return static function (AfterFileAnalysisEvent $event) use ($subscriber): void {
                $subscriber->onAfterFileAnalysis($event);
            };
        };
        $onBeforeAnalysis = static function (BeforeAnalysis $subscriber): Closure {
            return static function (BeforeAnalysisEvent $event) use ($subscriber): void {
                $subscriber->onBeforeAnalysis($event);
            };
        };
        $this->channels = [
            [AfterAnalysis::class, $onAfterAnalysis, AfterAnalysisEvent::class],
            [AfterFileAnalysis::class, $onAfterFileAnalysis, AfterFileAnalysisEvent::class],
            [BeforeAnalysis::class, $onBeforeAnalysis, BeforeAnalysisEvent::class],
        ];
    }

    /**
     * @param mixed $subscriber A subscriber object.
     */
    public function subscribe($subscriber): void
    {
        foreach ($this->channels as [$class, $builder, $eventClass]) {
            if (!$subscriber instanceof $class) {
                continue;
            }

            $this->subscribers[$eventClass][] = $builder($subscriber);
        }
    }

    /**
     * @param Event $event The triggered event.
     */
    public function notify(Event $event): void
    {
        foreach ($this->subscribers as $eventClass => $subscribers) {
            if (!$event instanceof $eventClass) {
                continue;
            }

            $this->notifyAll($event, $subscribers);
        }
    }

    /**
     * @param Event $event The triggered event.
     * @param array<callable> $subscribers The subscribers to notify.
     */
    private function notifyAll(Event $event, array $subscribers): void
    {
        foreach ($subscribers as $subscriber) {
            $subscriber($event);
        }
    }
}
