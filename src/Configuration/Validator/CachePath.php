<?php

declare(strict_types=1);

namespace Churn\Configuration\Validator;

use Churn\Config;
use Churn\Config\Validator;
use Webmozart\Assert\Assert;

/**
 * @internal
 */
final class CachePath implements Validator
{
    private const KEY = 'cachePath';

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
            $config->setCachePath(null);
            return;
        }

        Assert::string($value, 'Cache path should be a string');

        $config->setCachePath($value);
    }
}
