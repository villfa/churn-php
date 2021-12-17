<?php

declare(strict_types=1);

namespace Churn\Event\Subscriber;

use Churn\Event\Event\AfterFileAnalysis as AfterFileAnalysisEvent;

/**
 * @internal
 */
class AfterFileAnalysisHookDecorator implements AfterFileAnalysis, HookDecorator
{
    /**
     * @var class-string<AfterFileAnalysis>
     */
    private $hook;

    /**
     * @param class-string<AfterFileAnalysis> $hook The user-defined hook class name.
     */
    public function __construct(string $hook)
    {
        $this->hook = $hook;
    }

    /**
     * @param AfterFileAnalysisEvent $event The event triggered when the analysis of a file is done.
     */
    public function onAfterFileAnalysis(AfterFileAnalysisEvent $event): void
    {
        ($this->hook)::afterFileAnalysis($event);
    }
}
