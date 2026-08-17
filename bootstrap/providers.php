<?php

use App\Providers\{AppServiceProvider, SharedServiceProvider};
use Modules\Product\Providers\ProductServiceProvider;
use Modules\AdminAccess\Providers\{
    AdminAccessServiceProvider,
    AdminAccessEventServiceProvider
};

return [
    AppServiceProvider::class,
    SharedServiceProvider::class,
    AdminAccessServiceProvider::class,
    AdminAccessEventServiceProvider::class,
    ProductServiceProvider::class,
];
