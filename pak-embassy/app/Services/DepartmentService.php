<?php

namespace App\Services;

use App\Models\Department;

class DepartmentService
{
    public function getAll($request)
    {
        $records = $request->per_page ?? 10;
        $sortBy = $request->sort_by ?? 'id';
        $sortOrder = $request->sort_order ?? 'desc';

        return Department::applyFilter($request)
            ->orderBy($sortBy, $sortOrder)
            ->paginate($records)
            ->withQueryString();
    }

    public function create(string $name)
    {
        return Department::create(['name' => $name]);
    }

    public function update(int $id, string $name)
    {
        $department = Department::findOrFail($id);
        $department->update(['name' => $name]);

        return $department;
    }

    public function delete(int $id)
    {
        $department = Department::findOrFail($id);
        
        return $department->delete();
    }
}