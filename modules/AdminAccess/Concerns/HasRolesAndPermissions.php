<?php

namespace Modules\AdminAccess\Concerns;

use Modules\AdminAccess\Models\Role;
use Modules\AdminAccess\Models\Permission;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
trait HasRolesAndPermissions
{
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id')
            ->withTimestamps();
    }

    public function getPermissionsAttribute()
    {
        return $this->roles->pluck('permissions')->flatten()->unique('id')->values();
    }

    public function assignRole(mixed $role): self
    {
        $this->roles()->attach($role);
        return $this;
    }

    public function revokeRole(mixed $role): self
    {
        $this->roles()->detach($role);
        return $this;
    }

    public function syncRoles(array $roles): self
    {
        $this->roles()->sync($roles);
        return $this;
    }

    public function hasPermission(string $name): bool
    {
        return $this->permissions->contains('name', $name);
    }

    public function hasAnyPermission(array $names): bool
    {
        return $this->permissions->pluck('name')->intersect($names)->isNotEmpty();
    }
}
