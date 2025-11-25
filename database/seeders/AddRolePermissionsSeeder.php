<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AddRolePermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'view-roles',
            'create-roles',
            'edit-roles',
            'delete-roles',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $adminRole = Role::where('name', 'ADMIN')->first();
        if ($adminRole) {
            $adminRole->givePermissionTo($permissions);
        }
    }
}
