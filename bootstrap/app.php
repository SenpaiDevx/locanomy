<?php

use App\Http\Middleware\HandleInertiaRequests;
use App\Domain\Exceptions\DomainException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            HandleInertiaRequests::class,
            AddLinkHeadersForPreloadedAssets::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
         // Safety-net renderable for any DomainException a controller
        // didn't explicitly catch (most do, for a response shape with
        // extra fields — see AuthController's catch blocks) — falls
        // back to httpStatus()'s per-exception-class default (see
        // Modules\Shared\Domain\Exceptions\DomainException) rather
        // than every future exception needing its own controller catch
        // just to avoid an unhandled 500.
        $exceptions->render(function (DomainException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => $e->getMessage(),
                    'error_code' => $e->errorCode(),
                ], $e->httpStatus());
            }
        });
    })->create();
