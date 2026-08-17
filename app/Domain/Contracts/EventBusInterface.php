<?php

namespace App\Domain\Contracts;

interface EventBusInterface
{
    /**
     * Publish one domain event to every registered listener immediately.
     */
    public function publish(DomainEvent $event): void;

    /**
     * Publish events only once the current DB transaction commits. Use
     * this from any Action that mutates state and emits events in the
     * same transaction — it guarantees listeners (mailers, other
     * modules, queued jobs) never observe a row that isn't durable yet.
     *
     * @param DomainEvent[] $events
     */
    public function publishAfterCommit(array $events): void;
}