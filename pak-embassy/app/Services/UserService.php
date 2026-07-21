<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Department;
use Spatie\Permission\Models\Role;

class UserService
{
    public function getAllUsers($request)
    {
        $records = $request->per_page ?? 10;
        $sortBy = $request->sort_by ?? 'id';
        $sortOrder = $request->sort_order ?? 'desc';

        return User::with(['department', 'roles'])
            ->whereDoesntHave('roles', function ($query) {
                $query->whereIn('name', ['super_admin', 'customer', 'organization_admin']);
            })->applyFilter($request)
            ->orderBy($sortBy, $sortOrder)
            ->paginate($records)
            ->withQueryString();
    }

    public function createUser(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'nid' => $data['nid'],
            'department_id' => $data['department_id'],
            'is_active' => 1,
        ]);

        if (isset($data['role'])) {
            $user->assignRole($data['role']);
        }

        return $user->load(['department', 'roles']);
    }

    public function updateUser($id, array $data)
    {
        $user = User::findOrFail($id);

        $user->update([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'nid' => $data['nid'],
            'department_id' => $data['department_id'],
            'is_active' => $data['is_active'] ?? $user->is_active,
        ]);

        if (isset($data['role'])) {
            $user->syncRoles([$data['role']]);
        }

        return $user->load(['department', 'roles']);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }

    public function getDepartments()
    {
        return Department::orderBy('name', 'asc')->get();
    }

    public function getRoles()
    {
        return Role::whereNotIn('name', ['super_admin', 'customer', 'organization_admin'])
            ->orderBy('name', 'asc')
            ->get();
    }

    public function getUser($id)
    {
        $user = User::find($id);
        return $user;
    }
}