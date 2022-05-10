<?php

declare(strict_types=1);

namespace Churn\Result\Render;

use Symfony\Component\Console\Output\OutputInterface;

/**
 * @internal
 */
final class MarkdownResultsRenderer implements ResultsRendererInterface
{
    /**
     * Renders the results.
     *
     * @param OutputInterface $output Output Interface.
     * @param array<array<float|integer|string>> $results The results.
     */
    public function render(OutputInterface $output, array $results): void
    {
        $output->writeln('| File | Times Changed | Complexity | Score |');
        $output->writeln('|------|---------------|------------|-------|');

        foreach ($results as $result) {
            $output->writeln('| ' . \implode(' | ', $result) . ' |');
        }
    }

    private function inline(array $data): string
    {
        $escapedData = array_map($data, function ($item) {
            return \is_string($item) ? \str_replace('|', '\\|', $item) : $item;
        });

        return '| ' . \implode(' | ', $escapedData) . ' |';
    }
}
