<?php

declare(strict_types=1);

namespace Churn\Event\Subscriber;

use Churn\Event\Event\AfterFileAnalysis;

/**
 * @internal
 */
interface AfterFileAnalysis
{
    /**
     * @param AfterFileAnalysis $event The event triggered when the analysis of a file is done.
     */
    public function onAfterFileAnalysis(AfterFileAnalysis $event): void;
}
