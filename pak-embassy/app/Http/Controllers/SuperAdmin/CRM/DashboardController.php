<?php

namespace App\Http\Controllers\SuperAdmin\CRM;

use App\Http\Controllers\Controller;
use App\Models\ActionItem;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Organization;
use App\Services\UserManagement\SkilledIndividualService;
use App\Services\UserManagement\OrganizationService;
use Carbon\Carbon;

class DashboardController extends Controller
{
    protected $skilledIndividualService;
    protected $organizationService;

    public function __construct(
        SkilledIndividualService $skilledIndividualService,
        OrganizationService $organizationService
    ) {
        $this->skilledIndividualService = $skilledIndividualService;
        $this->organizationService = $organizationService;
    }

    private function renderLeadUserRows($leadsUsers, $view = 'super-admin.crm.dashboard.lead_row')
    {
        $rows = '';
        $serialNumber = $leadsUsers instanceof \Illuminate\Pagination\LengthAwarePaginator ? $leadsUsers->firstItem() : 1;

        if ($leadsUsers->count() > 0) {
            foreach ($leadsUsers as $index => $leadsUser) {
                $rows .= view($view, [
                    'user' => $leadsUser,
                    'serialNumber' => $serialNumber + $index
                ])->render();
            }
        } else {
            $rows .= '<tr id="no-record-row"><td colspan="16" class="text-center">No record found</td></tr>';
        }

        return $rows;
    }

    private function renderActionItemRows($actionItems)
    {
        $rows = '';

        if ($actionItems->count() > 0) {
            foreach ($actionItems as $actionItem) {
                $rows .= '<tr>';
                $rows .= '<td class="td-name">' . e($actionItem->event->name ?? '-') . '</td>';
                $rows .= '<td class="td-lead-type">' . e($actionItem->action ?? '-') . '</td>';
                $rows .= '<td class="td-description">' . e($actionItem->description ?? '-') . '</td>';
                $rows .= '<td class="td-assigned-to">' . e($actionItem->assignedUser?->name ?? '-') . '</td>';
                $rows .= '<td class="td-due-date">' . ($actionItem->due_date ? \Carbon\Carbon::parse($actionItem->due_date)->format('d/m/Y') : '-') . '</td>';
                $rows .= '<td class="td-status">' . e($actionItem->status ?? '-') . '</td>';
                $rows .= '<td>' . e($actionItem->comment ?? '-') . '</td>';
                $rows .= '</tr>';
            }
        } else {
            $rows .= '<tr><td colspan="16" class="text-center">No record found</td></tr>';
        }

        return $rows;
    }

    public function index(Request $request)
    {
        $activeUsers = $this->getUsersCount(['customer', 'organization_admin'], true);
        $inActiveUsers = $this->getUsersCount(['customer', 'organization_admin'], false);
        $totalUsers = $activeUsers + $inActiveUsers;

        $organizations =  $this->getUsersCount(['organization_admin'], true);
        $skilledIndividuals = $this->getUsersCount(['customer'], true);
        $totalLeads = $totalUsers;

        $totalMatchMaking = $this->getTotalMatchMaking();
        $totalMeetings = $totalLeads;

        $monthlyCounts = $this->getMonthlyCounts($request);

        if ($request->ajax()) {
            // Check if this is a request for action items (has date filters from/to)
            // or if it's explicitly requesting action items
            if ($request->filled('from') || $request->filled('to') || $request->filled('action_items')) {
                // Only get action items for AJAX requests
                $actionItems = $this->getActionItems($request);
                $rowsHtml = $this->renderActionItemRows($actionItems);
                $pagination = view('components.pagination', ['items' => $actionItems])->render();

                $response = [
                    'success' => true,
                    'html' => $rowsHtml,
                    'pagination' => $pagination,
                    'count' => $actionItems->total(),
                ];
            } else {
                // Only get leads for AJAX requests
                $leadsUsers = $this->getLeadsUsers($request);
                $rowsHtml = $this->renderLeadUserRows($leadsUsers);
                $pagination = view('components.pagination', ['items' => $leadsUsers])->render();

                $response = [
                    'success' => true,
                    'html' => $rowsHtml,
                    'pagination' => $pagination,
                    'count' => $leadsUsers->total(),
                ];
            }

            // If year is requested, include monthlyCounts in response
            if ($request->filled('year')) {
                $response['monthlyCounts'] = $monthlyCounts;
            }

            return response()->json($response);
        }

        // For non-AJAX requests, get both for the view
        $leadsUsers = $this->getLeadsUsers($request);
        $actionItems = $this->getActionItems($request);

        return view('super-admin.crm.dashboard.details', compact(
            'activeUsers',
            'inActiveUsers',
            'totalUsers',
            'organizations',
            'skilledIndividuals',
            'totalLeads',
            'totalMatchMaking',
            'totalMeetings',
            'leadsUsers',
            'monthlyCounts',
            'actionItems'
        ));
    }
    
    protected function getUsersCount(array $roles, bool $active = true): int
    {
        $query = User::whereHas('roles', fn($q) => $q->whereIn('name', $roles));
        return $active ? $query->active()->count() : $query->where('is_active', 0)->count();
    }

    protected function getTotalMatchMaking(): int
    {
        $customers = $this->getUsersWithRelations('customer');
        $organizations = Organization::where('is_verified', 1)->get();
        return $this->calculateMatchMaking($customers, $organizations);
    }

    protected function calculateMatchMaking($customers, $organizations): int
    {
        $matchedPairs = 0;

        foreach ($customers as $customer) {
            $custDomainIds = $this->getUserDomainIds($customer);
            $custSkillIds = $customer->skills->pluck('id')->toArray();

            if (empty($custDomainIds) && empty($custSkillIds)) continue;

            foreach ($organizations as $org) {
                if (!$org->ceo_email) continue;

                $orgCeo = User::where('email', $org->ceo_email)
                    ->where('is_active', 1)
                    ->with(['lovs', 'skills'])
                    ->first();

                if (!$orgCeo) continue;

                $orgDomainIds = $this->getUserDomainIds($orgCeo);
                $orgSkillIds = $orgCeo->skills->pluck('id')->toArray();

                if (count(array_intersect($custDomainIds, $orgDomainIds)) + count(array_intersect($custSkillIds, $orgSkillIds)) > 0) {
                    $matchedPairs++;
                }
            }
        }

        return $matchedPairs;
    }

    protected function getLeadsUsers(Request $request)
    {
        $records = $request->per_page ?? 10;
        $sortBy = $request->sort_by ?? 'id';
        $sortOrder = $request->sort_order ?? 'desc';

        // Valid sort columns for users table
        $validSortColumns = ['id', 'name', 'email', 'phone', 'created_at', 'updated_at'];
        
        // Only use sortBy if it's a valid column, otherwise default to 'id'
        if (!in_array($sortBy, $validSortColumns)) {
            $sortBy = 'id';
        }

        $query = User::query()
            ->role(['customer', 'organization_admin'])
            ->where(function ($query) {
                $query->where(function ($q) {
                    // If role is customer, step should be 5
                    $q->whereHas('roles', function ($roleQuery) {
                        $roleQuery->where('name', 'customer');
                    })->where('step', 5);
                })->orWhere(function ($q) {
                    // If role is organization_admin, step should be 6
                    $q->whereHas('roles', function ($roleQuery) {
                        $roleQuery->where('name', 'organization_admin');
                    })->where('step', 6);
                });
            })
            ->with('work_domain');

        [$from, $to] = $this->parseDateRange($request);

        if ($from && $to) $query->whereBetween('created_at', [$from, $to]);
        elseif ($from) $query->where('created_at', '>=', $from);
        elseif ($to) $query->where('created_at', '<=', $to);

        return $query
                ->applyFilter($request)
                ->orderBy($sortBy, $sortOrder)
                ->paginate($records)
                ->withQueryString();
    }

    protected function getActionItems(Request $request)
    {
        $records = $request->per_page ?? 10;
        $sortBy = $request->sort_by ?? 'id';
        $sortOrder = $request->sort_order ?? 'desc';

        $query = ActionItem::with(['event', 'assignedUser']);
        [$from, $to] = $this->parseDateRange($request);

        if ($from && $to) $query->whereBetween('created_at', [$from, $to]);
        elseif ($from) $query->where('created_at', '>=', $from);
        elseif ($to) $query->where('created_at', '<=', $to);

        // Handle sorting - use subqueries for relationship columns to avoid join conflicts
        if ($sortBy === 'name') {
            // Sort by event name using subquery
            $query->orderByRaw("(SELECT name FROM events WHERE events.id = action_items.event_id) {$sortOrder}");
        } elseif ($sortBy === 'phone') {
            // Sort by assigned user name using subquery
            $query->orderByRaw("(SELECT name FROM users WHERE users.id = action_items.assigned_to) {$sortOrder}");
        } elseif ($sortBy === 'lead-type') {
            // Sort by action
            $query->orderBy('action', $sortOrder);
        } elseif ($sortBy === 'email') {
            // Sort by description
            $query->orderBy('description', $sortOrder);
        } elseif ($sortBy === 'date') {
            // Sort by due_date
            $query->orderBy('due_date', $sortOrder);
        } elseif ($sortBy === 'status') {
            // Sort by status
            $query->orderBy('status', $sortOrder);
        } elseif ($sortBy === 'comment') {
            // Sort by comment
            $query->orderBy('comment', $sortOrder);
        } else {
            // Default sort by id
            $query->orderBy('id', $sortOrder);
        }

        return $query
                ->applyFilter($request)
                ->paginate($records)
                ->withQueryString();
    }

    protected function parseDateRange(Request $request): array
    {
        $from = $request->filled('from') ? Carbon::createFromFormat('d-m-Y', $request->from)->startOfDay() : null;
        $to   = $request->filled('to') ? Carbon::createFromFormat('d-m-Y', $request->to)->endOfDay() : null;
        return [$from, $to];
    }

    protected function getMonthlyCounts(Request $request): array
    {
        $year = $request->filled('year') ? (int)$request->year : now()->year;
        $counts = [];

        for ($month = 1; $month <= 12; $month++) {
            $orgsInMonth = Organization::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->count();

            $customersInMonth = User::whereHas('roles', fn($q) => $q->where('name', 'customer'))
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->get();

            $totalLeads = $orgsInMonth + $customersInMonth->count();

            $verifiedOrgsInMonth = Organization::where('is_verified', 1)
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->get();

            $monthlyMatchMaking = $this->calculateMatchMaking($customersInMonth, $verifiedOrgsInMonth);

            $counts[] = [
                'leads' => $totalLeads,
                'matchmakings' => $monthlyMatchMaking,
                'meetings' => $totalLeads,
            ];
        }

        return $counts;
    }

    protected function getUsersWithRelations(string $role)
    {
        return User::active()->role($role)->with(['lovs', 'skills'])->get();
    }
    
    protected function getUserDomainIds(User $user): array
    {
        return $user->lovs->where('pivot.lov_type_id', 4)->pluck('id')->toArray();
    }

    public function view($id, Request $request)
    {
        try {
            $user = User::with('roles')->findOrFail($id);
            
            // Check if user has customer role
            if ($user->hasRole('customer')) {
                // Get skilled individual data
                $skilledIndividual = $this->skilledIndividualService->getSkilledIndividual($id);
                
                if (!$skilledIndividual) {
                    return redirect()->route('dashboard.index')
                        ->with('error', 'Individual not found.');
                }
                
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

                // Render the view directly (stays in CRM context)
                return view('super-admin.individuals.detail', compact('skilledIndividual', 'attendedEvents'));
            }
            
            // Check if user has organization_admin role
            if ($user->hasRole('organization_admin')) {
                // Find organization by user_id or ceo_email
                $organization = Organization::where('user_id', $user->id)
                    ->orWhere('ceo_email', $user->email)
                    ->first();
                
                if (!$organization) {
                    return redirect()->route('dashboard.index')
                        ->with('error', 'Organization not found for this user.');
                }
                
                // Get organization data with relationships
                $organization = $this->organizationService->getOrganization($organization->id);
                
                // Get attended events using the relationship
                $records = $request->per_page ?? 30;
                $sortBy = $request->sort_by ?? 'end_date';
                $sortOrder = $request->sort_order ?? 'desc';
                
                $attendedEvents = $organization->user->attendedEvents()
                    ->applyFilter($request)
                    ->orderBy($sortBy, $sortOrder)
                    ->paginate($records)
                    ->withQueryString();

                if ($request->ajax() && $request->has('tab') && $request->tab === 'attended-events') {
                    $rowsHtml = $this->renderOrganizationAttendedEventRows($attendedEvents);
                    $pagination = view('components.pagination', ['items' => $attendedEvents])->render();

                    return response()->json([
                        'success' => true,
                        'html' => $rowsHtml,
                        'pagination' => $pagination,
                        'count' => $attendedEvents->total(),
                    ]);
                }

                // Render the view directly (stays in CRM context)
                return view('super-admin.organization.detail', compact('organization', 'attendedEvents'));
            }
            
            // If user doesn't have expected roles
            return redirect()->route('dashboard.index')
                ->with('error', 'User does not have a valid role for viewing details.');
                
        } catch (\Exception $e) {
            return redirect()->route('dashboard.index')
                ->with('error', 'Failed to view lead: ' . $e->getMessage());
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

    private function renderOrganizationAttendedEventRows($events)
    {
        $rows = '';
        if ($events->count() > 0) {
            foreach ($events as $event) {
                $rows .= view('super-admin.organization.partials.single-attended-event-row', [
                    'event' => $event
                ])->render();
            }
        } else {
            $rows .= '<tr id="no-record-row"><td colspan="7" class="text-center">No attended events found</td></tr>';
        }
        return $rows;
    }
}