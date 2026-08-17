<?php

namespace  App\Application\Contracts;

/**
 * Generic guard so any Action in any module can make a write operation
 * idempotent without re-implementing the "check then insert" race
 * condition every time. Backed by a unique key in storage — see
 * Modules\Shared\Infrastructure\Idempotency\DatabaseIdempotencyGuard.
 */
interface IdempotencyGuardInterface
{
    /**
     * Runs $callback exactly once for a given $key. If $key was already
     * recorded, returns the previously stored result instead of
     * re-running $callback. Safe under concurrent requests: relies on a
     * unique constraint + transaction, not a race-prone SELECT-then-INSERT.
     */
    public function once(string $key, \Closure $callback): mixed;
}