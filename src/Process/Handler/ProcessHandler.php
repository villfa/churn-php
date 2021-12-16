<?php

declare(strict_types=1);

namespace Churn\Process\Handler;

use Churn\File\File;
use Churn\Process\ProcessFactory;
use Generator;

/**
 * @internal
 */
interface ProcessHandler
{
    /**
     * Run the processes to gather information.
     *
     * @param Generator<File> $filesFinder Collection of files.
     * @param ProcessFactory $processFactory Process Factory.
     */
    public function process(Generator $filesFinder, ProcessFactory $processFactory): void;
}
