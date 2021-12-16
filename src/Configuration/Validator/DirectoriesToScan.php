<?php

declare(strict_types=1);

namespace Churn\Configuration\Validator;

use Churn\Config;
use Churn\Configuration\Validator;
use Webmozart\Assert\Assert;

/**
 * @internal
 */
final class DirectoriesToScan implements Validator
{
    private const KEY = 'directoriesToScan';

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

        Assert::isArray($value, 'Directories to scan should be an array of strings');
        Assert::allString($value, 'Directories to scan should be an array of strings');

        $config->setDirectoriesToScan($value);
    }
}
