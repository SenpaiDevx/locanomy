<?php

namespace Modules\Product\Providers;

use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider{

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config.php', 'products');
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
    }

   // Register Events/Listeners, Jobs, etc. (if not auto-discovered)
        // $this->app->bind(...);
        // Event::listen(...)
}