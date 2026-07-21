<?php

namespace App\Http\Controllers\SuperAdmin\ACL;

use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    private function renderUserRows($users, $view = 'super-admin.acl.users.user-individual-row')
    {
        $rows = '';
        $serialNumber = $users instanceof \Illuminate\Pagination\LengthAwarePaginator ? $users->firstItem() : 1;

        if ($users->count() > 0) {
            foreach ($users as $index => $user) {
                $rows .= view($view, [
                    'user' => $user,
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
            $users = $this->userService->getAllUsers($request);
            $departments = $this->userService->getDepartments();
            $roles = $this->userService->getRoles();

            if ($request->ajax()) {
                $rowsHtml = $this->renderUserRows($users);
                $pagination = view('components.pagination', ['items' => $users])->render();

                return response()->json([
                    'success' => true,
                    'html' => $rowsHtml,
                    'pagination' => $pagination,
                    'count' => $users->total(),
                ]);
            }

            return view('super-admin.Acl.users.index', compact('users', 'departments', 'roles'));
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch users', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(UserRequest $request)
    {
        // Validation is automatically handled by UserRequest
        // If validation fails, Laravel will return 422 with errors
        DB::beginTransaction();
        try {
            $user = $this->userService->createUser($request->validated());
            $row = view('super-admin.Acl.users.user-individual-row', compact('user'))->render();
            DB::commit();
            return response()->json(['success' => true, 'message' => 'User created successfully', 'row' => $row]);
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            // Handle database constraint violations
            if ($e->getCode() == 23000) {
                // Duplicate entry error
                if (str_contains($e->getMessage(), 'users_email_unique')) {
                    return response()->json([
                        'message' => 'The email has already been taken.',
                        'errors' => ['email' => ['The email has already been taken.']]
                    ], 422);
                }
                if (str_contains($e->getMessage(), 'users_phone_unique')) {
                    return response()->json([
                        'message' => 'The phone number has already been taken.',
                        'errors' => ['phone' => ['The phone number has already been taken.']]
                    ], 422);
                }
            }
            return response()->json(['message' => 'Failed to create user', 'error' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to create user', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(UserRequest $request, $id)
    {
        // Validation is automatically handled by UserRequest
        // If validation fails, Laravel will return 422 with errors
        DB::beginTransaction();
        try {
            $user = $this->userService->updateUser($id, $request->validated());
            DB::commit();
            
            // Format response data to match what JavaScript expects
            $data = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'nid' => $user->nid, // Full NID for data attribute, will be masked in JS
                'department_id' => $user->department_id,
                'department_name' => $user->department?->name ?? 'N/A',
                'role' => $user->roles->first()?->name ?? 'N/A',
            ];
            
            return response()->json(['success' => true, 'message' => 'User updated successfully', 'data' => $data]);
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            // Handle database constraint violations
            if ($e->getCode() == 23000) {
                // Duplicate entry error
                if (str_contains($e->getMessage(), 'users_email_unique')) {
                    return response()->json([
                        'message' => 'The email has already been taken.',
                        'errors' => ['email' => ['The email has already been taken.']]
                    ], 422);
                }
                if (str_contains($e->getMessage(), 'users_phone_unique')) {
                    return response()->json([
                        'message' => 'The phone number has already been taken.',
                        'errors' => ['phone' => ['The phone number has already been taken.']]
                    ], 422);
                }
            }
            return response()->json(['message' => 'Failed to update user', 'error' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to update user', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $this->userService->deleteUser($id);
            DB::commit();
            return response()->json(['message' => 'User deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to delete user', 'error' => $e->getMessage()], 500);
        }
    }
}