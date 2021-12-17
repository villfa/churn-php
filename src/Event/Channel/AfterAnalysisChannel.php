<?php

declare(strict_types=1);

namespace Churn\Event\Channel;

use Churn\Event\Channel;
use Churn\Event\Event\AfterAnalysisEvent;
use Churn\Event\Subscriber\AfterAnalysis;
use Closure;

/**
 * @internal
 * @implements Channel<AfterAnalysis>
 */
final class AfterAnalysisChannel implements Channel
{
    /**
     * @param object $subscriber A subscriber instance.
     */
    public function accepts($subscriber): bool
    {
        return $subscriber instanceof AfterAnalysis;
    }

    /**
     * @return class-string<AfterAnalysisEvent>
     */
    public function getEventClassname(): string
    {
        return AfterAnalysisEvent::class;
    }

    /**
     * @param object $subscriber A subscriber instance.
     * @return Closure(AfterAnalysisEvent): void
     */
    public function buildEventHandler($subscriber): Closure
    {
        return static function (AfterAnalysisEvent $event) use ($subscriber): void {
            $subscriber->onAfterAnalysis($event);
        };
    }
}