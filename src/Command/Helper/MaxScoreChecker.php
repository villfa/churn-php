<?php

declare(strict_types=1);

namespace Churn\Command\Helper;

use Churn\Result\ResultAccumulator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @internal
 */
class MaxScoreChecker
{

    /**
     * @var float|null
     */
    private $maxScoreThreshold;

    /**
     * @param float|null $maxScoreThreshold The max score threshold.
     */
    public function __construct(?float $maxScoreThreshold)
    {
        $this->maxScoreThreshold = $maxScoreThreshold;
    }

    /**
     * @param InputInterface $input Input.
     * @param OutputInterface $output Output.
     * @param ResultAccumulator $report The report containing the scores.
     */
    public function isOverThreshold(InputInterface $input, OutputInterface $output, ResultAccumulator $report): bool
    {
        $maxScore = $report->getMaxScore();

        if (null === $this->maxScoreThreshold || null === $maxScore || $maxScore <= $this->maxScoreThreshold) {
            return false;
        }

        if ('text' === $input->getOption('format') || !empty($input->getOption('output'))) {
            $output->writeln('<error>Max score is over the threshold</>');
        }

        return true;
    }
}
