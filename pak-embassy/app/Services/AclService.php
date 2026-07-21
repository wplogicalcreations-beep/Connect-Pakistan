<?php

namespace App\Services;

use App\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Module;

class AclService
{
    public function getRolesWithPermissions($request)
    {
        $records = $request->per_page ?? 10;
        $sortBy = $request->sort_by ?? 'id';
        $sortOrder = $request->sort_order ?? 'desc';

        $excludedRoles = ['super_admin', 'customer', 'organization_admin'];

        $query = Role::with('permissions')
            ->whereNotIn('name', $excludedRoles);

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        return $query->orderBy($sortBy, $sortOrder)
                    ->paginate($records);
    }

    public function createRole(string $name)
    {
        return Role::create(['name' => $name, 'guard_name' => 'web', 'status' => 1]);
    }

    public function updateRole(int $id, string $name, $status)
    {
        $role = Role::findOrFail($id);
        $role->update(['name' => $name, 'status' => $status]);

        return $role;
    }

    public function deleteRole(int $id)
    {
        $role = Role::findOrFail($id);
        
        return $role->delete();
    }

    public function getRolesAndPermissions(?Role $role = null): array
    {
        $roles = Role::whereNotIn('name', ['super_admin', 'organization_admin', 'customer'])
            ->orderBy('name')
            ->where('status', 1)
            ->get();
        $modules = Module::with('permissions')->get();
        $rolePermissions = $role
            ? $role->permissions->pluck('id')->toArray()
            : [];

        return compact('roles', 'modules', 'rolePermissions');
    }

    public function assignPermissionsToRole($role, array $permissions)
    {
        $role = Role::where('name', $role)->first();
        $role->syncPermissions($permissions);

        return $role->load('permissions');
    }
}