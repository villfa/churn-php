<?php

declare(strict_types=1);

namespace Churn\Event\Subscriber;

use Churn\Event\Event\AfterFileAnalysis;

/**
 * @internal
 */
class AfterFileAnalysisHookDecorator implements AfterFileAnalysis, HookDecorator
{
    /**
     * @var string
     */
    private $hook;

    /**
     * @param class-string $hook The user-defined hook class name.
     */
    public function __construct(string $hook)
    {
        $this->hook = $hook;
    }

    /**
     * @param AfterFileAnalysis $event The event triggered when the analysis of a file is done.
     */
    public function onAfterFileAnalysis(AfterFileAnalysis $event): void
    {
        \call_user_func([$this->hook, 'afterFileAnalysis'], $event);
    }
}
