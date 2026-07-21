<?php

namespace App\Http\Controllers\SuperAdmin\ACL;

use App\Services\AclService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Role;

class AclController extends Controller
{
    protected $aclService;

    public function __construct(AclService $aclService)
    {
        $this->aclService = $aclService;
    }

    private function renderRoleRows($roles, $view = 'super-admin.Acl.roles.roles-individual-row')
    {
        $rows = '';
        $serialNumber = $roles instanceof \Illuminate\Pagination\LengthAwarePaginator ? $roles->firstItem() : 1;

        if ($roles->count() > 0) {
            foreach ($roles as $index => $role) {
                $rows .= view($view, [
                    'role' => $role,
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
            $roles = $this->aclService->getRolesWithPermissions($request);

            if ($request->ajax()) {
                $rowsHtml = $this->renderRoleRows($roles);
                $pagination = view('components.pagination', ['items' => $roles])->render();

                return response()->json([
                    'success' => true,
                    'html' => $rowsHtml,
                    'pagination' => $pagination,
                    'count' => $roles->total(),
                ]);
            }

            return view('super-admin.Acl.roles.index', compact('roles'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function storeRole(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required|unique:roles,name',
            ]);

            $role = $this->aclService->createRole($request->name);
            $row = view('super-admin.Acl.roles.roles-individual-row', compact('role'))->render();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Role created successfully',
                'row' => $row
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to create role',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function updateRole(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'name' => 'required|unique:roles,name,' . $id,
            ]);

            $role = $this->aclService->updateRole($id, $request->name, $request->status);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Role updated successfully',
                'data' => $role
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to update role',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function deleteRole($id)
    {
        DB::beginTransaction();
        try {
            $this->aclService->deleteRole($id);

            DB::commit();
            return response()->json([
                'message' => 'Role deleted successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to delete role',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function assignPermissionsForm(Role $role)
    {
        try {
            $data = $this->aclService->getRolesAndPermissions($role);

            return view('super-admin.Acl.roles.__form', $data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function assignPermissions(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'role' => 'required|exists:roles,name',
                'permissions' => 'required|array',
            ]);

            $role = $this->aclService->assignPermissionsToRole($request->role, $request->permissions);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Permissions assigned successfully',
                'data' => $role
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to assign permissions',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getPermissions(Request $request)
    {
        $role = Role::where('name', $request->role)->first();
        if (!$role) {
            return response()->json(['error' => 'Role not found'], 404);
        }
        $permissions = $role->permissions()->select('id', 'name')->get();
        
        return response()->json([
            'permissions' => $permissions
        ]);
    }
}