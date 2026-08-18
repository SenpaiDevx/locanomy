<?php

use Illuminate\Support\Facades\Route;
use Modules\AdminAccess\Infrastructure\Http\Controllers\SetupWizardController;
use Modules\AdminAccess\Infrastructure\Http\Middleware\{
    EnsureHttps,
    RedirectIfNotInstalled
};
/*
|--------------------------------------------------------------------------
| AdminAccess web routes
|--------------------------------------------------------------------------
| Explicitly wrapped in the 'web' middleware group — that is NOT implied
| just by living in a file named web.php. Laravel only auto-applies the
| 'web' group (sessions, CSRF, cookie encryption) to the *root*
| routes/web.php via its own bootstrap; this module's routes are loaded
| separately via AdminAccessServiceProvider::boot()'s loadRoutesFrom(),
| which is a plain require with no implicit middleware. Without this
| wrapper, the setup wizard's CSRF token and session-based auto-login
| would silently not work.
|
| Most of the admin panel is a JSON API (Routes/api.php) consumed by an
| SPA. The setup wizard is the exception — a "web installer pattern"
| needs a real server-rendered form, not a JSON endpoint, since it has
| to work before any frontend JS app can assume an installed backend
| exists to call.
*/

Route::middleware(['web', RedirectIfNotInstalled::class])
    ->prefix('admin')
    ->name('admin_access.web.')
    ->group(function () {
        Route::middleware(['throttle:admin-setup', EnsureHttps::class])->group(function () {
            Route::controller(SetupWizardController::class)->group(function () {
                Route::get('/','index')->name('setup.show');
                Route::post('/setup', 'store')->name('setup.store');
            });
        });
    });

