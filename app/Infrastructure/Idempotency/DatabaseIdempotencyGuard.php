<?php

namespace App\Infrastructure\Idempotency;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Application\Contracts\IdempotencyGuardInterface;

/**
 * Backed by a single `idempotency_keys` table (key varchar PRIMARY KEY).
 * The unique/primary constraint is the actual concurrency control —
 * two requests racing on the same key will have one succeed on INSERT
 * and one hit a QueryException, which is treated as "someone else is
 * already handling this" rather than as an error.
 */
final class DatabaseIdempotencyGuard implements IdempotencyGuardInterface
{
    public function once(string $key, \Closure $callback): mixed
    {
        $existing = DB::table('idempotency_keys')->where('key', $key)->first();

        if ($existing !== null) {
            return json_decode($existing->response ?? 'null', true);
        }

        return DB::transaction(function () use ($key, $callback) {
            try {
                DB::table('idempotency_keys')->insert([
                    'key' => $key,
                    'response' => json_encode(null),
                    'created_at' => now(),
                ]);
            } catch (QueryException) {
                // Lost the race to a concurrent request — reuse its result.
                $row = DB::table('idempotency_keys')->where('key', $key)->first();
                return json_decode($row->response ?? 'null', true);
            }

            $result = $callback();

            DB::table('idempotency_keys')
                ->where('key', $key)
                ->update(['response' => json_encode($result)]);

            return $result;
        });
    }
}