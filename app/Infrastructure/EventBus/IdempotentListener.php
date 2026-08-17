<?php

namespace App\Infrastructure\EventBus;

use Illuminate\Support\Facades\DB;
use App\Domain\Contracts\IdempotentDomainEvent;

trait IdempotentListener
{
    protected function onceFor(IdempotentDomainEvent $event, \Closure $callback): void
    {
        $claimed = DB::table('processed_events')->insertOrIgnore([
            'idempotency_key' => $event->idempotencyKey(),
            'listener' => static::class,
            'processed_at' => now(),
        ]);

        // insertOrIgnore() returns the number of rows actually inserted.
        // Zero means a row for this (key, listener) pair already
        // existed -- i.e. this listener has already reacted to this
        // exact occurrence of the event -- so skip the side effect.
        if ($claimed === 0) {
            return;
        }

        $callback();
    }
}