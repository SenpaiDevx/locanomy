<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['api'])->group(function () {
    Route::prefix('api/v1/products')->name('api.products')->group(function () {
        
    });
});