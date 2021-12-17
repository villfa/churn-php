<?php

declare(strict_types=1);

namespace Churn\Event\Channel;

use Churn\Event\Channel;
use Churn\Event\Event\BeforeAnalysisEvent;
use Churn\Event\Subscriber\BeforeAnalysis;
use Closure;

/**
 * @internal
 * @implements Channel<BeforeAnalysis>
 */
final class BeforeAnalysisChannel implements Channel
{
    /**
     * @param object $subscriber A subscriber instance.
     */
    public function accepts($subscriber): bool
    {
        return $subscriber instanceof BeforeAnalysis;
    }

    /**
     * @return class-string<BeforeAnalysisEvent>
     */
    public function getEventClassname(): string
    {
        return BeforeAnalysisEvent::class;
    }

    /**
     * @param object $subscriber A subscriber instance.
     * @return Closure(BeforeAnalysisEvent): void
     */
    public function buildEventHandler($subscriber): Closure
    {
        return static function (BeforeAnalysisEvent $event) use ($subscriber): void {
            $subscriber->onBeforeAnalysis($event);
        };
    }
}
