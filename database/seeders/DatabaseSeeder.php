<?php

namespace Database\Seeders;

// use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\AdminAccess\Infrastructure\Persistence\Seeders\AdminRolesAndPermissionsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Only seeds AdminAccess's roles/permissions — no demo/fake admin
     * accounts. The setup wizard (GET/POST /admin/setup) is this
     * application's only supported way to create the first admin; a
     * seeder creating one alongside it would let a fresh install skip the
     * setup wizard's installation-lock claim entirely, undermining the
     * "exactly one bootstrap" guarantee that lock exists to provide.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(AdminRolesAndPermissionsSeeder::class);

    }
} 
