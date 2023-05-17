<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $superAdminRole = Role::create([
            'name' => 'super admin'
        ]);

        $adminRole = Role::create([
            'name' => 'admin'
        ]);

        $managerRole = Role::create([
            'name' => 'manager'
        ]);

        $agentRole = Role::create([
            'name' => 'agent'
        ]);
    }
}
