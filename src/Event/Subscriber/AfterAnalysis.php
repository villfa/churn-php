<?php

declare(strict_types=1);

namespace Churn\Event\Subscriber;

use Churn\Event\Event\AfterAnalysis;

/**
 * @internal
 */
interface AfterAnalysis
{
    /**
     * @param AfterAnalysis $event The event triggered when the analysis is done.
     */
    public function onAfterAnalysis(AfterAnalysis $event): void;
}
