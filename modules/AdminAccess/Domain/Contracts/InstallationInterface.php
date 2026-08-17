<?php

namespace Modules\AdminAccess\Domain\Contracts;

use Modules\AdminAccess\Domain\ValueObjects\AdminId;
interface InstallationInterface {
    public function isInstalled() : bool;
    public function claimInstallationForUpdate(): bool;
    public function markInstalled (AdminId $installedBy) : void;
    public function forgetCache(): void;
}