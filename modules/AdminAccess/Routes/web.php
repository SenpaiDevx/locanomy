<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['web',])->group(function () {
    Route::prefix('users')->name('users')->group(function () {
    });
}); 
