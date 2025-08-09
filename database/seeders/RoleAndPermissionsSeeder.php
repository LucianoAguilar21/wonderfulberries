<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleSuperAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $roleOperator = Role::firstOrCreate(['name' => 'operator']);
        $roleUser = Role::firstOrCreate(['name' => 'user']);

        Permission::firstOrCreate(['name' => 'create']);
        Permission::firstOrCreate(['name' => 'view']);
        Permission::firstOrCreate(['name' => 'edit']);
        Permission::firstOrCreate(['name' => 'delete']);

        $roleSuperAdmin->givePermissionTo(['create', 'view', 'edit','delete']);
        $roleAdmin->givePermissionTo(['create', 'view', 'edit']);
        $roleOperator->givePermissionTo(['view']);


    }
}
