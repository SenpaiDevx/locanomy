<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Application\Contracts\IdempotencyGuardInterface;
use App\Domain\Contracts\EventBusInterface;
use App\Infrastructure\EventBus\LaravelEventBus;
use App\Infrastructure\Idempotency\DatabaseIdempotencyGuard;

/**
 * Binds the primitives every other module is allowed to depend on
 * (EventBusInterface, IdempotencyGuardInterface) exactly once. This is
 * the Shared Kernel's own service provider — the only code any module
 * may reference from outside its own boundary. Must be registered
 * before any feature module's provider — see app/Providers/ModuleServiceProvider.php.
 */
final class SharedServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(EventBusInterface::class, LaravelEventBus::class);
        $this->app->singleton(IdempotencyGuardInterface::class, DatabaseIdempotencyGuard::class);
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../Infrastructure/Migrations');
    }
}