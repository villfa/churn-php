<?php

declare(strict_types=1);

namespace Churn\Process\Handler;

use Churn\Process\ProcessFactory;
use Generator;

interface ProcessHandler
{

    /**
     * Run the processes to gather information.
     *
     * @param Generator $filesFinder Collection of files.
     * @param ProcessFactory $processFactory Process Factory.
     */
    public function process(Generator $filesFinder, ProcessFactory $processFactory): void;
}
