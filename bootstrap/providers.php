<?php

use App\Providers\AppServiceProvider;
use Modules\Product\Providers\ProductServiceProvider;
use Modules\AdminAccess\Providers\AdminAccessServiceProvider;

return [
    AppServiceProvider::class,
    ProductServiceProvider::class,
    AdminAccessServiceProvider::class,
];
