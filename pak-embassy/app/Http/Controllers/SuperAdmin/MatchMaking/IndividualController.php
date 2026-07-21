<?php

namespace App\Http\Controllers\SuperAdmin\MatchMaking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Organization;
use App\Services\EventManagementService;
use App\Services\UserManagement\SkilledIndividualService;

class IndividualController extends Controller
{
    protected $eventService;

    public function __construct(EventManagementService $eventService)
    {
        $this->eventService = $eventService;
    }

    private function renderIndividualRows($users, $view = 'super-admin.match-making.individual.single-match-making-individual-row')
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
            $records = $request->per_page ?? 10;
            $sortBy = $request->sort_by ?? 'id';
            $sortOrder = $request->sort_order ?? 'desc';

            $users = User::with(['lovs' => function($query) {
                        $query->wherePivot('lov_type_id', 4);
                    }, 'skills'])
                    ->where('is_active', 1)
                    ->whereHas('roles', function($query) {
                        $query->where('name', 'customer');
                    })
                    ->applyFilter($request)
                    ->orderBy($sortBy, $sortOrder)
                    ->paginate($records);

            if ($request->ajax()) {
                $rowsHtml = $this->renderIndividualRows($users);
                $pagination = view('components.pagination', ['items' => $users])->render();

                return response()->json([
                    'success' => true,
                    'html' => $rowsHtml,
                    'pagination' => $pagination,
                    'count' => $users->total(),
                ]);
            }

            return view('super-admin.match-making.individual.index', compact('users'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function viewMatchMaking($id)
    {
        $user = User::with(['skills', 'lovs', 'images', 'individualProfile'])->findOrFail($id);
        $userSkillIds = $user->skills->pluck('id')->toArray();
        $userLovIds = $user->lovs->where('pivot.lov_type_id', 4)->pluck('id')->toArray();
        $calculateMatchScore = function ($itemSkillIds, $itemLovIds) use ($userSkillIds, $userLovIds) {
            $skillMatches = count(array_intersect($userSkillIds, $itemSkillIds));
            $lovMatches = count(array_intersect($userLovIds, $itemLovIds));
            return $skillMatches + $lovMatches;
        };
        $recommended = collect();
        $organizations = Organization::where('is_verified', 1)
            ->orderBy('id', 'desc')
            ->get();
        foreach ($organizations as $org) {
            if (!$org->ceo_email) continue;
            $orgCeo = User::where('email', $org->ceo_email)
                ->where('is_active', 1)
                ->with(['skills', 'lovs', 'images'])
                ->first();
            if (!$orgCeo) continue;
            $orgSkillIds = $orgCeo->skills->pluck('id')->toArray();
            $orgLovIds = $orgCeo->lovs->where('pivot.lov_type_id', 4)->pluck('id')->toArray();
            $score = $calculateMatchScore($orgSkillIds, $orgLovIds);
            if ($score > 0) {
                $org->match_score = $score;
                $org->ceo = $orgCeo;
                $recommended->push($org);
            }
        }
        $customers = User::where('is_active', 1)
            ->where('id', '!=', $user->id)
            ->whereHas('roles', fn($q) => $q->where('name', 'customer'))
            ->with(['skills', 'lovs', 'images'])
            ->get();
        foreach ($customers as $customer) {
            $customerSkillIds = $customer->skills->pluck('id')->toArray();
            $customerLovIds = $customer->lovs->where('pivot.lov_type_id', 4)->pluck('id')->toArray();
            $score = $calculateMatchScore($customerSkillIds, $customerLovIds);
            if ($score > 0) {
                $customer->match_score = $score;
                $recommended->push($customer);
            }
        }
        $recommended = $recommended->sortByDesc('match_score')->values();

        return view('super-admin.match-making.individual.view-match-making-company', compact('user', 'recommended'));
    }

    public function getPrivateEventForm(Request $request)
    {
        $domains = $this->eventService->getDomains();
        $status = $this->eventService->getStatus();
        // Fetch individuals (users with 'customer' role)
        $individuals = User::whereHas('roles', function($query) {
            $query->where('name', 'customer');
        })
        ->where('is_active', true)
        ->orderBy('name')
        ->get(['id', 'name', 'email']);
    
        // Fetch organizations (users with 'organization_admin' role)
        $organizations = User::whereHas('roles', function($query) {
            $query->where('name', 'organization_admin');
        })
        ->where('is_active', true)
        ->orderBy('name')
        ->get(['id', 'name', 'email']);

        // Fetch embassy users (users NOT having customer, organization_admin, or super_admin roles)
        $embassies = User::whereDoesntHave('roles', function($query) {
            $query->whereIn('name', ['customer', 'organization_admin', 'super_admin']);
        })
        ->where('is_active', true)
        ->orderBy('name')
        ->get(['id', 'name', 'email']);
    
        $selectedEmails = collect($request->input('selected_emails'))->filter()->values();
        $usersWithImages = collect();
        if ($selectedEmails->isNotEmpty()) {
            $users = User::whereIn('email', $selectedEmails)->get();
            foreach ($users as $user) {
                if ($user->hasRole('customer')) {
                    $image = $user->images->first()->path ?? 'images/default.png';
                } elseif ($user->hasRole('organization-admin')) {
                    $organization = Organization::where('ceo_email', $user->email)->first();
                    $image = $organization->images->first()->path ?? 'images/default.png';
                } else {
                    $image = 'images/default.png';
                }
                $usersWithImages->push([
                    'name' => $user->name,
                    'email' => $user->email,
                    'image' => $image,
                ]);
            }
        }

        return view('super-admin.events.event-form', $selectedEmails->isNotEmpty()
            ? compact('domains', 'status', 'usersWithImages', 'individuals', 'organizations', 'embassies')
            : compact('domains', 'status', 'individuals', 'organizations', 'embassies'));
    }
}
