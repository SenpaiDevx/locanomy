<?php

use Illuminate\Support\Facades\Route;
use Modules\AdminAccess\Http\Controllers\UsersController;

Route::middleware(['web',])->group(function () {
    Route::prefix('users')->name('users')->group(function () {
        Route::controller(UsersController::class)->group(function () {
            Route::get('/', 'index')->name('users.index');
        });
    });
});