<?php

namespace Modules\AdminAccess\Infrastructure\Persistence\Eloquent\Repositories;

use Illuminate\Contracts\Cache\Repository as CacheRepository;
use Illuminate\Support\Facades\DB;
use Modules\AdminAccess\Domain\Contracts\InstallationInterface;
use Modules\AdminAccess\Domain\ValueObjects\AdminId;
use Modules\AdminAccess\Infrastructure\Persistence\Eloquent\Models\InstallationLock;
final class InstallationRepository implements InstallationInterface 
{

    public function __construct (
        private readonly CacheRepository $cache,
    ) {}

    public function isInstalled() : bool
    {

    }

    public function isInstalledByDB(bool $lockForUpdate = false) : bool
    {

    }

    public function claimsInstallation(AdminId $claimedBy) : bool
    {

    }

    public function markInstalled(AdminId $installedBy) : bool
    {

    }

    public function forgetCache() : void
    {

    }

    private function writeInstalledRow(Admin_id $installedBy) : void
    {

    }

    private function warmCache() : void
    {
        
    }
}