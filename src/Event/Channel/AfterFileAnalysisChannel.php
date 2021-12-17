<?php

declare(strict_types=1);

namespace Churn\Event\Channel;

use Churn\Event\Channel;
use Churn\Event\Event\AfterFileAnalysis as AfterFileAnalysisEvent;
use Churn\Event\Subscriber\AfterFileAnalysis;
use Closure;

/**
 * @internal
 * @implements Channel<AfterFileAnalysis, AfterFileAnalysisEvent>
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
     * @param AfterFileAnalysis $subscriber A subscriber instance.
     * @return Closure(AfterFileAnalysisEvent): void
     */
    public function buildEventHandler(AfterFileAnalysis $subscriber): Closure
    {
        return static function (AfterFileAnalysisEvent $event) use ($subscriber): void {
            $subscriber->onAfterFileAnalysis($event);
        };
    }
}
