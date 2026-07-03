<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\ProductController;

Route::middleware(['web'])->group(function () {
    Route::prefix('products')->name('products')->group(function () {
        Route::controller(ProductController::class)->group(function () {
            Route::get('/', 'index')->name('product.index');
        });
    });
});