<?php

declare(strict_types=1);

namespace Churn\Event\Subscriber;

use Churn\Event\Event\BeforeAnalysis;

/**
 * @internal
 */
interface BeforeAnalysis
{
    /**
     * @param BeforeAnalysis $event The event triggered when the analysis starts.
     */
    public function onBeforeAnalysis(BeforeAnalysis $event): void;
}
