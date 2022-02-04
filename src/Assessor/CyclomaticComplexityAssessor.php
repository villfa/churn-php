<?php

declare(strict_types=1);

namespace Churn\Assessor;

/**
 * @internal
 */
class CyclomaticComplexityAssessor
{
    /**
     * The total cyclomatic complexity score.
     *
     * @var integer
     */
    private $score = 0;

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
            } elseif ($token === '?') {
                $score += 1;
            }
        }

        return $score === 0 ? 1 : $score;
    }

    /**
     * @param int $code Code of a PHP token.
     */
    private function getComplexity(int $code): int
    {
        switch ($code) {
            case T_CLASS:
            case T_INTERFACE:
            case T_TRAIT:
            case 336: // T_ENUM (PHP 8.1)
            case T_IF:
            case T_ELSEIF:
            case T_FOR:
            case T_FOREACH:
            case T_WHILE:
            case T_CASE:
            case T_CATCH:
            case T_BOOLEAN_AND:
            case T_LOGICAL_AND:
            case T_BOOLEAN_OR:
            case T_LOGICAL_OR:
                return 1;
            
            default:
                return 0;
        }
    }
}
