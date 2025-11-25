<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions for Users module
        $userPermissions = [
            'view-users',
            'create-users',
            'edit-users',
            'delete-users',
        ];

        // Create permissions for Clients module
        $clientPermissions = [
            'view-clients',
            'create-clients',
            'edit-clients',
            'delete-clients',
        ];

        // Create permissions for Products module
        $productPermissions = [
            'view-products',
            'create-products',
            'edit-products',
            'delete-products',
        ];

        // Combine all permissions
        $allPermissions = array_merge($userPermissions, $clientPermissions, $productPermissions);

        // Create all permissions
        foreach ($allPermissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create ADMIN role and assign all permissions
        $adminRole = Role::create(['name' => 'ADMIN']);
        $adminRole->givePermissionTo($allPermissions);

        $this->command->info('Roles and permissions created successfully!');
    }
}
