<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['api'])->group(function () {
    Route::prefix('users')->name('users')->group(function () {
      
    });

}); 