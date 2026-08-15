<?php

namespace Modules\AdminAccess\Domain\Contracts;

use Modules\AdminAccess\Domain\ValueObjects\{AdminId, RoleName};
interface RoleManagerInterface
{
    public function assignRole(AdminId $adminId, RoleName $roleName): void;

    public function hasRole(AdminId $adminId, RoleName $roleName): bool;

    public function hasPermission(AdminId $adminId, string $permissionName): bool;
}