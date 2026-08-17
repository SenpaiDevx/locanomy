<?php

namespace App\Domain\Contracts;

interface IdempotentDomainEvent extends DomainEvent
{
    /**
     * A key that is stable for a given logical occurrence of this event.
     * Two publishes that represent "the same thing happening" must
     * return the same key; two publishes representing genuinely
     * different occurrences must not collide.
     */
    public function idempotencyKey(): string;
}