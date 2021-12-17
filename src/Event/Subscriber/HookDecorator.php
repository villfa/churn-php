<?php

declare(strict_types=1);

namespace Churn\Event\Subscriber;

/**
 * @internal
 * @template H
 */
interface HookDecorator
{
    /**
     * @param class-string<H> $hook The user-defined hook class name.
     */
    public function __construct(string $hook);
}
