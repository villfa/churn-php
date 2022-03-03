<?php

declare(strict_types=1);

namespace Churn\Assessor;

/**
 * @internal
 */
class CyclomaticComplexityAssessor
{
    /**
     * @var array<int, int>
     */
    private $tokens = [
        \T_CLASS => 1,
        \T_INTERFACE => 1,
        \T_TRAIT => 1,
        \T_IF => 1,
        \T_ELSEIF => 1,
        \T_FOR => 1,
        \T_FOREACH => 1,
        \T_WHILE => 1,
        \T_CASE => 1,
        \T_CATCH => 1,
        \T_BOOLEAN_AND => 1,
        \T_LOGICAL_AND => 1,
        \T_BOOLEAN_OR => 1,
        \T_LOGICAL_OR => 1,
        \T_COALESCE => 1,
    ];

    public function __construct()
    {
        // Since PHP 7.4
        if (\defined('T_COALESCE_EQUAL')) {
            $this->tokens[\T_COALESCE_EQUAL] = 1;
        }
        // Since PHP 8.1
        if (!\defined('T_ENUM')) {
            return;
        }

        $this->tokens[\T_ENUM] = 1;
    }

    /**
     * Assess the files cyclomatic complexity.
     *
     * @param string $contents The contents of a PHP file.
     */
    public function assess(string $contents): int
    {
        $tokens = \token_get_all($contents);
        $score = 0;
        foreach ($tokens as $token) {
            if (\is_array($token)) {
                $score += $this->getComplexity($token[0]);

                continue;
            }
            if ('?' === $token) {
                $score += 1;

                continue;
            }
        }

        return 0 === $score
            ? 1
            : $score;
    }

    /**
     * @param integer $code Code of a PHP token.
     */
    private function getComplexity(int $code): int
    {
        return $this->tokens[$code] ?? 0;
    }
}
