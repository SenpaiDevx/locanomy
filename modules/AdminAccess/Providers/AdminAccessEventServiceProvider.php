<?php

namespace Modules\AdminAccess\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\AdminAccess\Domain\Events\SystemInstalled;
use Modules\AdminAccess\Infrastructure\Listeners\LogSystemInstallationListener;
/**
 * Explicit wiring on purpose: every cross-cutting reaction to this
 * module's events is listed here in one place, instead of scattered
 * dispatch calls buried inside Actions — "what happens when an admin
 * gets locked out" is answerable by reading this one file. This is the
 * "explicit usage for the right dependency" principle in practice: this
 * module publishes events without knowing who, if anyone, listens; this
 * file is where that direction of dependency actually gets wired.
 *
 * AdminUpdated/AdminActivated/AdminDeactivated/AdminDeleted (added
 * with the admin-management CRUD) are published but deliberately
 * unwired here for now — same as several of the pre-existing events,
 * not every event needs a listener on day one. A future audit-log or
 * security-notification listener can subscribe without any change to
 * the Actions that publish them.
 */
final class AdminAccessEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        SystemInstalled::class => [
            LogSystemInstallationListener::class
        ]
    ];
}