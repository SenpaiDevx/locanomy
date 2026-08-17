<?php

namespace Modules\AdminAccess\Infrastructure\Security;

use Modules\AdminAccess\Domain\Contracts\RoleManagerInterface;
use Modules\AdminAccess\Domain\ValueObjects\AdminId;
use Modules\AdminAccess\Domain\ValueObjects\RoleName;
use Modules\AdminAccess\Infrastructure\Persistence\Eloquent\Models\Admin;

final class SpatieRoleManager implements RoleManagerInterface
{
     public function assignRole(AdminId $adminId, RoleName $roleName): void
    {
        Admin::findOrFail($adminId->value())->assignRole($roleName->value());
    }

    public function hasRole(AdminId $adminId, RoleName $roleName): bool
    {
        return Admin::findOrFail($adminId->value())->hasRole($roleName->value());
    }

    public function hasPermission(AdminId $adminId, string $permissionName): bool
    {
        return Admin::findOrFail($adminId->value())->hasPermissionTo($permissionName);
    }
}