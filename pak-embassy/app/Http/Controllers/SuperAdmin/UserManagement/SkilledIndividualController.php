<?php

namespace App\Http\Controllers\SuperAdmin\UserManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Individual\StoreIndividualRequest;
use App\Http\Requests\Individual\UpdateIndividualRequest;
use App\Models\Lov;
use App\Models\LovType;
use App\Models\Skill;
use App\Services\UserManagement\SkilledIndividualService;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SkilledIndividualController extends Controller
{
    protected $skilledIndividualService;

    public function __construct(SkilledIndividualService $skilledIndividualService)
    {
        $this->skilledIndividualService = $skilledIndividualService;
    }

    private function renderSkilledIndividualRows($users, $view = 'super-admin.individuals.single-individual-row')
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
            $perPage = $request->get('per_page', 10);

            $users = $this->skilledIndividualService
                ->getSkilledIndividuals($request)
                ->orderBy('id', 'desc')
                ->paginate($perPage);

            if ($request->ajax()) {
                $rowsHtml = $this->renderSkilledIndividualRows($users);
                $pagination = view('components.pagination', ['items' => $users])->render();

                return response()->json([
                    'success' => true,
                    'html' => $rowsHtml,
                    'pagination' => $pagination,
                    'count' => $users->total(),
                ]);
            }

            return view('super-admin.individuals.index', compact('users'));
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to fetch users', 'error' => $e->getMessage()], 500);
        }
    }

    public function create()
    {
        try {
            $levels = Lov::lovsByType(LovType::LEVEL);
            $influence_abilities = Lov::lovsByType(LovType::INFLUENCE_ABILITY);
            $work_domains = Lov::lovsByType(LovType::WORK_DOMAIN);
            $industry_areas = Lov::lovsByType(LovType::INDUSTRY_AREA);
            $skills = Skill::where('is_active', true)->where('type', 'individual')->get();

            return view('super-admin.individuals.create', compact(
                'levels',
                'influence_abilities',
                'work_domains',
                'industry_areas',
                'skills'
            ));
        } catch (\Exception $e) {
            return redirect()->route('skilled_individuals.index')
                ->with('error', 'Failed to load form: ' . $e->getMessage());
        }
    }

    public function store(StoreIndividualRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->skilledIndividualService->store($request);
            DB::commit();

            return response()->json([
                'message' => 'Individual added successfully!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to add individual: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $user = $this->skilledIndividualService->getSkilledIndividual($id);
            
            if (!$user) {
                return redirect()->route('skilled_individuals.index')
                    ->with('error', 'Individual not found');
            }
            
            $levels = Lov::lovsByType(LovType::LEVEL);
            $influence_abilities = Lov::lovsByType(LovType::INFLUENCE_ABILITY);
            $work_domains = Lov::lovsByType(LovType::WORK_DOMAIN);
            $industry_areas = Lov::lovsByType(LovType::INDUSTRY_AREA);
            $skills = Skill::where('is_active', true)->where('type', 'individual')->get();
            
            // Get current selections
            $currentLevel = $user->level->first();
            $currentInfluenceAbility = $user->influence_ability->first();
            $currentIndustryArea = $user->industry_area->first();
            $currentWorkDomain = $user->work_domain->first();
            $currentSkills = $user->skills->pluck('id')->toArray();
            
            // Get additional skills from profile
            $additionalSkills = [];
            if ($user->individualProfile && $user->individualProfile->additional_skills) {
                $additionalSkills = json_decode($user->individualProfile->additional_skills, true) ?? [];
            }
            
            // Get profile image
            $profileImage = $user->images->first();

            return view('super-admin.individuals.edit', compact(
                'user',
                'levels',
                'influence_abilities',
                'work_domains',
                'industry_areas',
                'skills',
                'currentLevel',
                'currentInfluenceAbility',
                'currentIndustryArea',
                'currentWorkDomain',
                'currentSkills',
                'additionalSkills',
                'profileImage'
            ));
        } catch (\Exception $e) {
            return redirect()->route('skilled_individuals.index')
                ->with('error', 'Failed to load edit form: ' . $e->getMessage());
        }
    }

    public function update(UpdateIndividualRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $this->skilledIndividualService->update($request, $id);
            DB::commit();

            return response()->json([
                'message' => 'Individual updated successfully!'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update individual: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'message' => 'Failed to update individual: ' . $e->getMessage()
            ], 500);
        }
    }

    public function invite(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|unique:users,email',
            ]);

            $this->skilledIndividualService->sendInvitation($request->email);

            return response()->json([
                'message' => 'Invitation sent successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to send invitation. Please try again.'
            ], 500);
        }
    }

    public function show($id, Request $request)
    {
        try {
            $skilledIndividual = $this->skilledIndividualService->getSkilledIndividual($id);
            
            // Get attended events using the relationship
            $records = $request->per_page ?? 30;
            $sortBy = $request->sort_by ?? 'end_date';
            $sortOrder = $request->sort_order ?? 'desc';
            
            $attendedEvents = $skilledIndividual->attendedEvents()
                ->applyFilter($request)
                ->orderBy($sortBy, $sortOrder)
                ->paginate($records)
                ->withQueryString();

            if ($request->ajax() && $request->has('tab') && $request->tab === 'attended-events') {
                $rowsHtml = $this->renderAttendedEventRows($attendedEvents);
                $pagination = view('components.pagination', ['items' => $attendedEvents])->render();

                return response()->json([
                    'success' => true,
                    'html' => $rowsHtml,
                    'pagination' => $pagination,
                    'count' => $attendedEvents->total(),
                ]);
            }

            return view('super-admin.individuals.detail', compact('skilledIndividual', 'attendedEvents'));
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch skilled Individual', 'error' => $e->getMessage()], 500);
        }
    }

    private function renderAttendedEventRows($events)
    {
        $rows = '';
        if ($events->count() > 0) {
            foreach ($events as $event) {
                $rows .= view('super-admin.individuals.partials.single-attended-event-row', [
                    'event' => $event
                ])->render();
            }
        } else {
            $rows .= '<tr id="no-record-row"><td colspan="7" class="text-center">No attended events found</td></tr>';
        }
        return $rows;
    }

    public function updateStatus(Request $request)
    {
        DB::beginTransaction();
        try {
            // Manually parse request data if not in input
            $user_id = $request->input('user_id');
            $action = $request->input('action');
            
            // If not in input, try parsing from raw body
            if (!$user_id || !$action) {
                parse_str($request->getContent(), $parsed);
                $user_id = $user_id ?? ($parsed['user_id'] ?? null);
                $action = $action ?? ($parsed['action'] ?? null);
                
                // Merge parsed data into request
                if ($user_id && $action) {
                    $request->merge([
                        'user_id' => $user_id,
                        'action' => $action
                    ]);
                }
            }
            
            // Debug: Log all request data
            Log::info('Update Status Request Data:', [
                'all' => $request->all(),
                'user_id' => $user_id,
                'action' => $action,
                'method' => $request->method(),
                'content_type' => $request->header('Content-Type'),
                'request_body' => $request->getContent()
            ]);
            
            $validated = $request->validate([
                'user_id' => 'required|integer|exists:users,id',
                'action' => 'required|string|in:approve,decline'
            ]);

            $this->skilledIndividualService->updateStatus($validated);
            DB::commit();
            
            $action = $validated['action'];
            $message = $action === 'approve' ? 'Individual approved successfully!' : 'Individual declined successfully!';
            
            return response()->json([
                'success' => true,
                'message' => $message,
                'action' => $action,
                'is_active' => $action === 'approve' ? 1 : 0
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to update skilled Individual',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $this->skilledIndividualService->deleteSkilledIndividual($id);
            DB::commit();
            return response()->json(['message' => 'Skilled Individual deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to delete skilled Individual', 'error' => $e->getMessage()], 500);
        }
    }
}