<?php

use App\Providers\{AppServiceProvider, SharedServiceProvider};
use Modules\Products\Providers\ProductServiceProvider;
use Modules\AdminAccess\Providers\{
    AdminAccessServiceProvider,
    AdminAccessEventServiceProvider,
};
use App\Providers\TypeScriptTransformerServiceProvider;

return [
    AppServiceProvider::class,
    SharedServiceProvider::class,
    TypeScriptTransformerServiceProvider::class,
    AdminAccessServiceProvider::class,
    AdminAccessEventServiceProvider::class,
    ProductServiceProvider::class,
];
