<?php

namespace App\Http\Controllers\SuperAdmin\ACL;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\DepartmentService;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    protected $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    private function renderRoleRows($departments, $view = 'super-admin.Acl.departments.department-individual-row')
    {
        $rows = '';
        $serialNumber = $departments instanceof \Illuminate\Pagination\LengthAwarePaginator ? $departments->firstItem() : 1;

        if ($departments->count() > 0) {
            foreach ($departments as $index => $department) {
                $rows .= view($view, [
                    'department' => $department,
                    'serialNumber' => $serialNumber + $index
                ])->render();
            }
        } else {
            $rows .= '<tr id="no-record-row"><td colspan="16" class="text-center">No record found</td></tr>';
        }

        return $rows;
    }

    public function index(Request $request)
    {
        try {
            $departments = $this->departmentService->getAll($request);

            if ($request->ajax()) {
                $rowsHtml = $this->renderRoleRows($departments);
                $pagination = view('components.pagination', ['items' => $departments])->render();

                return response()->json([
                    'success' => true,
                    'html' => $rowsHtml,
                    'pagination' => $pagination,
                    'count' => $departments->total(),
                ]);
            }

            return view('super-admin.Acl.departments.index', compact('departments'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'name' => 'required|string|unique:departments,name,NULL,id,deleted_at,NULL',
            ]);
            $department = $this->departmentService->create($request->name);
            
            // Get total count of departments to calculate serial number
            // Use the same query logic as getAll but without pagination to get accurate count
            $departments = $this->departmentService->getAll($request);
            $serialNumber = $departments->total();
            
            $row = view('super-admin.Acl.departments.department-individual-row', [
                'department' => $department,
                'serialNumber' => $serialNumber
            ])->render();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Department added successfully!',
                'row' => $row
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to create department', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'name' => 'required|string|unique:departments,name,' . $id . ',id,deleted_at,NULL',
            ]);
            $department = $this->departmentService->update($id, $request->name);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Department updated successfully!',
                'data' => $department
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to update department', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $this->departmentService->delete($id);

            DB::commit();
            return response()->json(['message' => 'Department deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to delete department', 'error' => $e->getMessage()], 500);
        }
    }
}
