<?php

namespace App\Contracts;

/**
 * Monolith-safe event bus abstraction.
 *
 * Application/Domain code depends on this interface only — never on
 * Laravel's Dispatcher or the `event()` helper directly. That keeps call
 * sites free of framework coupling, and means the concrete transport
 * (synchronous in-process dispatch today, a queued or brokered transport
 * tomorrow) can change without touching a single Action or Service.
 */
interface EventBusInterface
{
     public function publish(object $event): void;

    /**
     * @param array<int, object> $events
     */
    public function publishMany(array $events): void;
}