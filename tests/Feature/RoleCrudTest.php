<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use function Pest\Laravel\{actingAs, get, post, put, delete};

beforeEach(function () {
    // Create permissions
    $permissions = [
        'view-roles',
        'create-roles',
        'edit-roles',
        'delete-roles',
        'view-users',
        'create-users', // Add some other permissions to test assignment
    ];

    foreach ($permissions as $permission) {
        Permission::firstOrCreate(['name' => $permission]);
    }

    // Create ADMIN role and assign permissions
    $adminRole = Role::firstOrCreate(['name' => 'ADMIN']);
    $adminRole->givePermissionTo($permissions);

    $this->admin = User::factory()->create();
    $this->admin->assignRole('ADMIN');

    $this->regularUser = User::factory()->create();
});

test('admin can view roles list', function () {
    actingAs($this->admin)
        ->get('/roles')
        ->assertOk();
});

test('admin can create role with permissions', function () {
    actingAs($this->admin)
        ->post('/roles', [
            'name' => 'Manager',
            'permissions' => ['view-users', 'create-users'],
        ])
        ->assertRedirect('/roles');

    $this->assertDatabaseHas('roles', ['name' => 'Manager']);

    $role = Role::findByName('Manager');
    expect($role->hasPermissionTo('view-users'))->toBeTrue();
    expect($role->hasPermissionTo('create-users'))->toBeTrue();
});

test('admin can update role permissions', function () {
    $role = Role::create(['name' => 'Editor']);

    actingAs($this->admin)
        ->put("/roles/{$role->id}", [
            'name' => 'Senior Editor',
            'permissions' => ['view-users'],
        ])
        ->assertRedirect('/roles');

    $this->assertDatabaseHas('roles', ['name' => 'Senior Editor']);

    $role->refresh();
    expect($role->hasPermissionTo('view-users'))->toBeTrue();
});

test('admin cannot delete ADMIN role', function () {
    $adminRole = Role::findByName('ADMIN');

    actingAs($this->admin)
        ->delete("/roles/{$adminRole->id}")
        ->assertRedirect('/roles')
        ->assertSessionHas('error');

    $this->assertDatabaseHas('roles', ['name' => 'ADMIN']);
});

test('admin can delete other roles', function () {
    $role = Role::create(['name' => 'Test Role']);

    actingAs($this->admin)
        ->delete("/roles/{$role->id}")
        ->assertRedirect('/roles');

    $this->assertDatabaseMissing('roles', ['id' => $role->id]);
});

test('non-admin cannot manage roles', function () {
    actingAs($this->regularUser)
        ->get('/roles')->assertForbidden();

    post('/roles', ['name' => 'Hacker'])->assertForbidden();
});
