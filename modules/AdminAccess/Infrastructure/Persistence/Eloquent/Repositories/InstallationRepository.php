<?php

namespace Modules\AdminAccess\Infrastructure\Persistence\Eloquent\Repositories;

use Illuminate\Support\Facades\Cache;
use Modules\AdminAccess\Domain\Contracts\InstallationInterface;
use Modules\AdminAccess\Domain\ValueObjects\AdminId;
use Modules\AdminAccess\Infrastructure\Persistence\Eloquent\Models\{InstallationLock, Admin};

final class InstallationRepository implements InstallationInterface 
{

    private const CACHE_KEY = 'admin_access.installed';
    

    public function isInstalled() : bool
    {

        return Cache::store("installation")->rememberForever(self::CACHE_KEY, function (){
            return Admin::role(config('admin_access.roles.super_admin'))->exists();
        });
    }

  

    public function claimInstallationForUpdate() : bool
    {
        $onLock = InstallationLock::where('id', 1)->lockForUpdate()->first(); // it return a single object
        return $onLock->installed_at === null;
    }

    public function markInstalled(AdminId $installedBy) : void
    {
        InstallationLock::where('id', 1)->update([
            'installed_at' => now(),
            'installed_by_admin_id' => $installedBy->value()
        ]);

        Cache::store('installation')->forever(self::CACHE_KEY, true);
    }

    public function forgetCache() : void
    {
        Cache::store('installation')->forget(self::CACHE_KEY);
    }

   
}