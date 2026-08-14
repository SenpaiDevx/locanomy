<?php

namespace Modules\AdminAccess\Domain\Contracts;
use Modules\AdminAccess\Domain\ValueObjects\AdminId;
interface InstallationInterface {
    public function isInstalled() : bool;
    public function isInstalledByDB(bool $lockForUpdate = false) : bool;
    public function claimsInstallation(AdminId $claimedBy) : bool;
    public function markInstalled (AdminId $installedBy) : bool;
    public function forgetCache(): void;
}