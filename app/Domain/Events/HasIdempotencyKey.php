<?php

namespace App\Domain\Events;

use Illuminate\Support\Str;

/**
 * Gives an event class a working idempotencyKey() with almost no
 * boilerplate. Two usage modes:
 *
 *  - Do nothing extra: each publish gets its own random key, i.e. no
 *    deduplication (fine for events where every occurrence is
 *    genuinely distinct and a listener redelivery is an acceptable,
 *    rare cost).
 *  - Call setIdempotencyKey() from the constructor with a
 *    content-derived string (e.g. "admin_access.system_installed") so
 *    that logically-repeated occurrences of "the same thing" dedupe
 *    against Modules\Shared's processed_events table.
 */

trait HasIdempotencyKey
{
    private ?string $idempotencyKey = null;

    public function idempotencyKey(): string
    {
        return $this->idempotencyKey ??= (string) Str::uuid();
    }

    protected function setIdempotencyKey(string $key): void
    {
        $this->idempotencyKey = $key;
    }
}