<?php

declare(strict_types=1);

namespace Churn\Event\Channel;

use Churn\Event\Channel;
use Churn\Event\Event\AfterFileAnalysisEvent;
use Churn\Event\Subscriber\AfterFileAnalysis;
use Closure;

/**
 * @internal
 * @implements Channel<AfterFileAnalysis>
 */
final class AfterFileAnalysisChannel implements Channel
{
    /**
     * @param object $subscriber A subscriber instance.
     */
    public function accepts($subscriber): bool
    {
        return $subscriber instanceof AfterFileAnalysis;
    }

    /**
     * @return class-string<AfterFileAnalysisEvent>
     */
    public function getEventClassname(): string
    {
        return AfterFileAnalysisEvent::class;
    }

    /**
     * @param object $subscriber A subscriber instance.
     * @return Closure(AfterFileAnalysisEvent): void
     */
    public function buildEventHandler($subscriber): Closure
    {
        return static function (AfterFileAnalysisEvent $event) use ($subscriber): void {
            $subscriber->onAfterFileAnalysis($event);
        };
    }
}
