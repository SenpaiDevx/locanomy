<?php

use App\Providers\AppServiceProvider;
use Modules\Product\Providers\ProductServiceProvider;
use Modules\AdminAccess\Providers\UsersServiceProvider;

return [
    AppServiceProvider::class,
    ProductServiceProvider::class,
    UsersServiceProvider::class,
];
