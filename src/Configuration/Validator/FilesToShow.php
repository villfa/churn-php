<?php

declare(strict_types=1);

namespace Churn\Configuration\Validator;

use Churn\Configuration\Config;
use Churn\Configuration\Validator;
use Webmozart\Assert\Assert;

/**
 * @internal
 */
final class FilesToShow extends AbstractValidator
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct('filesToShow');
    }

    /**
     * @param EditableConfig $config The configuration object.
     * @param mixed $value The value to validate.
     */
    protected function validateValue(EditableConfig $config, $value): void
    {
        Assert::integer($value, 'Files to show should be an integer');

        $config->setFilesToShow($value);
    }
}
