<?php

namespace App\Domain\Contracts;

interface DomainEvent
{
    /**
     * Stable, dotted name used for logging and audit trails, e.g.
     * "admin_access.admin_logged_in".
     */
    public function eventName(): string;

    /**
     * When the event actually happened (not when it was dispatched).
     */
    public function occurredAt(): \DateTimeImmutable;

    /**
     * Safe-to-serialize payload for logging/audit. Deliberately separate
     * from the object's own properties so secrets (tokens, passwords)
     * can be excluded here while still being available in-process to
     * synchronous listeners that need them.
     */
    public function toArray(): array;
}
