<?php

declare(strict_types=1);

namespace Churn\Configuration\Validator;

use Churn\Config;
use Churn\Configuration\Validator;
use Webmozart\Assert\Assert;

/**
 * @internal
 */
final class MaxScoreThreshold implements Validator
{
    private const KEY = 'maxScoreThreshold';

    /**
     * Returns the configuration key.
     */
    public function getKey(): string
    {
        return self::KEY;
    }

    /**
     * @param Config The configuration object.
     * @param array<mixed> $configuration The array containing the configuration values.
     */
    public function validate(Config $config, array $configuration): void
    {
        if (!\array_key_exists(self::KEY, $configuration)) {
            return;
        }

        $value = $configuration[self::KEY];
        if ($value === null) {
            $config->setMaxScoreThreshold(null);
            return;
        }

        Assert::numeric($value, 'Maximum score threshold should be a number');

        $config->setMaxScoreThreshold($value);
    }
}
