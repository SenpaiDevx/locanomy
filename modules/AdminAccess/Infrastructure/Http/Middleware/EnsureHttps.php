<?php

namespace Modules\AdminAccess\Infrastructure\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Renamed and broadened from an earlier EnsureSetupIsSecure, which
 * applied only to the setup-wizard routes. That was too narrow: login,
 * register/create-admin, and reset-password all transmit a plaintext
 * credential in the request body too, and none of them were protected.
 * Now applied to the entire 'api/admin' route group and the setup
 * wizard's 'web' group — see Routes/api.php and Routes/web.php.
 *
 * Scoped to non-local/testing environments so it doesn't get in the
 * way of `php artisan serve` during development or the (HTTP, by
 * default) test suite.
 */
final class EnsureHttps
{
    public function handle(Request $request, Closure $next) : Response
    {
        if (!request()->secure() && app()->environment('production', 'staging')) {
            return redirect()->secure($request->getRequestUri());
        }
        return $next($request);
    }
}