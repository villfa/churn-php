<?php

declare(strict_types=1);

namespace Churn\Event;

use Closure;

/**
 * @internal
 * @template S of object
 */
interface Channel
{
    /**
     * @param object $subscriber A subscriber instance.
     */
    public function accepts($subscriber): bool;

    /**
     * @return class-string<Event>
     */
    public function getEventClassname(): string;

    /**
     * @param object $subscriber A subscriber instance.
     * @return Closure(Event): void
     * @psalm-param S $subscriber
     */
    public function buildEventHandler($subscriber): Closure;
}
