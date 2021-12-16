<?php

declare(strict_types=1);

namespace Churn\Configuration\Validator;

use Churn\Configuration\Config;
use Churn\Configuration\Validator;
use Webmozart\Assert\Assert;

/**
 * @internal
 */
final class Vcs extends AbstractValidator
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('vcs');
    }

    /**
     * @param EditableConfig $config The configuration object.
     * @param mixed $value The value to validate.
     */
    protected function validateValue(EditableConfig $config, $value): void
    {
        Assert::string($value, 'VCS should be a string');

        $config->setVCS($value);
    }
}
