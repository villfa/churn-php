<?php

declare(strict_types=1);

namespace Churn\Event\Subscriber;

use Churn\Event\Event\AfterAnalysis as AfterAnalysisEvent;

/**
 * @internal
 */
class AfterAnalysisHookDecorator implements AfterAnalysis, HookDecorator
{
    /**
     * @var class-string<AfterAnalysis>
     */
    private $hook;

    /**
     * @param class-string<AfterAnalysis> $hook The user-defined hook class name.
     */
    public function __construct(string $hook)
    {
        $this->hook = $hook;
    }

    /**
     * @param AfterAnalysisEvent $event The event triggered when the analysis is done.
     */
    public function onAfterAnalysis(AfterAnalysisEvent $event): void
    {
        ($this->hook)::afterAnalysis($event);
    }
}
