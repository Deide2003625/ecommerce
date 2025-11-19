<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = ['Super Admin', 'Admin', 'Gestionnaire', 'Livreur', 'Client'];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['name' => $role, 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
