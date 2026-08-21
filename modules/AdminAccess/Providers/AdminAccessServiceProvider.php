<?php

namespace Modules\AdminAccess\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\{Route, Gate, RateLimiter};
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Cache\Repository as CacheRepository;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use Symfony\Component\Console\Output\ConsoleOutput;
use Modules\AdminAccess\Domain\Contracts\{
    InstallationInterface,
    AdminRepositoryInterface,
    PasswordHasherInterface,
    RoleManagerInterface,
    PasswordPolicyInterface,
    BreachedPasswordCheckerInterface,
    SessionManagerInterface
};
use Modules\AdminAccess\Infrastructure\Persistence\Eloquent\Repositories\{
    InstallationRepository,
    AdminRepository
};
use Modules\AdminAccess\Application\Services\PasswordPolicyService;
use Modules\AdminAccess\Infrastructure\Security\{
    BcryptPasswordHasher,
    SpatieRoleManager,
    HaveIBeenPwnedChecker,
    GuardSessionManager
};

use Modules\AdminAccess\Application\Actions\SetupWizardAction;
class AdminAccessServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config.php', 'admin_access'); // config has failed to load due to  configkey is invalid format "admin-access" to "admin_access"
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(PasswordHasherInterface::class, BcryptPasswordHasher::class);
        $this->app->bind(BreachedPasswordCheckerInterface::class, HaveIBeenPwnedChecker::class);
        $this->app->bind(RoleManagerInterface::class, SpatieRoleManager::class);
        $this->app->bind(PasswordPolicyInterface::class, PasswordPolicyService::class);
        $this->app->bind(SessionManagerInterface::class, GuardSessionManager::class);
        $this->app->singleton(InstallationInterface::class, InstallationRepository::class);

        $this->app->when(PasswordPolicyService::class)
            ->needs('$minLength')
            ->give(fn() => (int) config('admin_access.password.min_length'));

        $this->app->when(PasswordPolicyService::class)
            ->needs('$historyLimit')
            ->give(fn() => (int) config('admin_access.password.history_limit'));

        $this->app->when(SetupWizardAction::class)
            ->needs('$superAdminRole')
            ->give(fn() => (string) config('admin_access.roles.super_admin'));
    }

    public function boot(): void
    {

        $this->loadMigrationsFrom(__DIR__ . '/../Infrastructure/Persistence/Migrations');

        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');

        $this->publishes([
            __DIR__ . '/../config.php' => config_path('config.php')
        ], 'admin_access_config');

        $this->registerRateLimiters();

        Gate::before(function ($admin, string $ability) {
            return method_exists($admin, 'hasRole') && $admin->hasRole(config('admin_access.roles.super_admin'))
                ? true
                : null;
        });


        $this->app['router']->aliasMiddleware('role', \Spatie\Permission\Middleware\RoleMiddleware::class);
        $this->app['router']->aliasMiddleware('permission', \Spatie\Permission\Middleware\PermissionMiddleware::class);
        $this->app['router']->aliasMiddleware('role_or_permission', \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class);

        Route::pushMiddlewareToGroup('api', EnsureFrontendRequestsAreStateful::class);
    }

    private function registerRateLimiters(): void
    {
        
        RateLimiter::for('admin-setup', function ($request) {
            $config = config('admin_access.rate_limits.setup');
            
            return Limit::perMinutes($config['decay_minutes'], $config['max_attempts'])
                ->by($request->ip());
        });
    }

    // Register Events/Listeners, Jobs, etc. (if not auto-discovered)
    // $this->app->bind(...);
    // Event::listen(...)
}