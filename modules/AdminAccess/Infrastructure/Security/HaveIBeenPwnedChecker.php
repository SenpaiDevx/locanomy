<?php

namespace Modules\AdminAccess\Infrastructure\Security;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\AdminAccess\Domain\Contracts\BreachedPasswordCheckerInterface;
final class HaveIBeenPwnedChecker implements BreachedPasswordCheckerInterface
{
    public function isBreached(string $plainPassword): bool
    {
        $sha1 = strtoupper(sha1($plainPassword));
        $prefix = substr($sha1, 0, 5);
        $suffix = substr($sha1, 5);

        try {
            $response = Http::timeout(2)->get("https://api.pwnedpasswords.com/range/{$prefix}");
        } catch (\Throwable $e) {
            // Fail open: a third-party outage must never block an admin
            // from logging in or resetting a password.
            Log::warning('HIBP breach check unreachable, failing open.', ['error' => $e->getMessage()]);
            return false;
        }

        if (! $response->successful()) {
            return false;
        }

        foreach (explode("\r\n", $response->body()) as $line) {
            [$candidateSuffix] = explode(':', $line);
            if (hash_equals(trim($candidateSuffix), $suffix)) {
                return true;
            }
        }

        return false;
    }
}