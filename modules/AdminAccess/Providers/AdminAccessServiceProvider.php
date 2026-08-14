<?php

namespace Modules\AdminAccess\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Cache\Repository as CacheRepository;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use Modules\AdminAccess\Domain\Contracts\InstallationInterface;
use Modules\AdminAccess\Infrastructure\Persistence\Eloquent\Repositories\InstallationRepository;
class AdminAccessServiceProvider extends ServiceProvider
{
 
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config.php', 'admin-access');
        $this->app->bind(
            InstallationInterface::class,
            static fn ($app) => new InstallationRepository($app->make(CacheRepository::class))
        ); 
    }

    public function boot(): void
    {
        
        $this->loadMigrationsFrom(__DIR__ . '/../Infrastructure/Persistence/Migrations');
        
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        
        $this->publishes([
            __DIR__.'/../config.php' => config_path('config.php')
        ], 'admin-access-config');
    }



    // Register Events/Listeners, Jobs, etc. (if not auto-discovered)
    // $this->app->bind(...);
    // Event::listen(...)
}