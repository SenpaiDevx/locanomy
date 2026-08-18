<?php

namespace Modules\AdminAccess\Infrastructure\Persistence\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * Not auto-run by any ServiceProvider on purpose — seeding is an
 * operator decision (which permissions exist, what they're named),
 * not something that should silently fire on every deploy. Run once via
 * `php artisan db:seed --class="Modules\AdminAccess\Infrastructure\Persistence\Seeders\AdminRolesAndPermissionsSeeder"`
 * after Spatie's own package migrations have run — see the README.
 *
 * Deliberately minimal: 'super-admin' gets a blanket Gate::before bypass
 * (see AdminAccessServiceProvider::boot()), so it needs no permissions
 * assigned to it directly. 'admin' — the role RegisterAdminAction
 * assigns to every ordinary self-registered account — starts with none,
 * which is exactly why the register endpoint requires the
 * 'create-admins' permission: a freshly self-registered admin can sign
 * in, but can't create more admins until a super-admin grants them
 * that permission (or a broader role) explicitly.
 *
 * 'view-admins' and 'manage-admins' (added when the admin-management
 * CRUD was merged in from a second implementation): kept as two
 * permissions rather than one so a future limited role — e.g. a
 * support lead who should be able to *see* the admin roster but not
 * deactivate or delete accounts — can be granted read access without
 * write access. 'manage-admins' covers update/deactivate/reactivate/
 * delete as one permission rather than four, since in practice nobody
 * asked for a role that could deactivate but not delete, and four
 * near-identical permissions would be speculative granularity.
 */
final class AdminRolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        Role::firstOrCreate(['name' => config('admin_access.roles.super_admin'), 'guard_name' => 'admin']);
        Role::firstOrCreate(['name' => config('admin_access.roles.default'), 'guard_name' => 'admin']);

        Permission::firstOrCreate(['name' => 'create-admins', 'guard_name' => 'admin']);
        Permission::firstOrCreate(['name' => 'view-admins', 'guard_name' => 'admin']);
        Permission::firstOrCreate(['name' => 'manage-admins', 'guard_name' => 'admin']);
    }
}