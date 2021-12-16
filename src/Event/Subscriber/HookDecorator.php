<?php

declare(strict_types=1);

namespace Churn\Event\Subscriber;

/**
 * @internal
 */
interface HookDecorator
{
    /**
     * @param class-string $hook The user-defined hook class name.
     */
    public function __construct(string $hook);
}
