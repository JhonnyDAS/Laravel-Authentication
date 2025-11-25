<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class RoleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view-roles', only: ['index', 'show']),
            new Middleware('permission:create-roles', only: ['create', 'store']),
            new Middleware('permission:edit-roles', only: ['edit', 'update']),
            new Middleware('permission:delete-roles', only: ['destroy']),
        ];
    }

    public function index()
    {
        $roles = Role::withCount('permissions', 'users')->paginate(10);
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('-', $permission->name)[1] ?? 'other';
        });
        return view('roles.create', compact('permissions'));
    }

    public function store(StoreRoleRequest $request)
    {
        $role = Role::create(['name' => $request->name]);

        if ($request->has('permissions')) {
            $role->givePermissionTo($request->permissions);
        }

        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully.');
    }

    public function show(Role $role)
    {
        $role->load('permissions', 'users');
        return view('roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('-', $permission->name)[1] ?? 'other';
        });
        $role->load('permissions');
        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update(['name' => $request->name]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        } else {
            $role->syncPermissions([]);
        }

        return redirect()->route('roles.index')
            ->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        // Prevent deletion of ADMIN role
        if ($role->name === 'ADMIN') {
            return redirect()->route('roles.index')
                ->with('error', 'Cannot delete ADMIN role.');
        }

        $role->delete();
        return redirect()->route('roles.index')
            ->with('success', 'Role deleted successfully.');
    }
}
