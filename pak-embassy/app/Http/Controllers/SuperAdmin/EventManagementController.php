<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Services\EventManagementService;
use App\Services\ActionItemService;
use App\Http\Requests\EventManagementRequest;
use App\Models\Event;
use App\Models\ActionItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EventManagementController extends Controller
{
    protected $eventService;
    protected $actionItemService;

    public function __construct(EventManagementService $eventService, ActionItemService $actionItemService)
    {
        $this->eventService = $eventService;
        $this->actionItemService = $actionItemService;
    }

    private function renderEventRows($events, $view = 'super-admin.events.single-event-row')
    {
        $rows = '';
        $serialNumber = $events instanceof \Illuminate\Pagination\LengthAwarePaginator ? $events->firstItem() : 1;

        if ($events->count() > 0) {
            foreach ($events as $index => $event) {
                $rows .= view($view, [
                    'event' => $event,
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
            $events = $this->eventService->getAllEvents($request);

            if ($request->ajax()) {
                $rowsHtml = $this->renderEventRows($events);
                $pagination = view('components.pagination', ['items' => $events])->render();

                return response()->json([
                    'success' => true,
                    'html' => $rowsHtml,
                    'pagination' => $pagination,
                    'count' => $events->total(),
                ]);
            }

            return view('super-admin.events.index', compact('events'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function viewEvent(Event $event)
    {
        try {
            $event->load('attendees.user');
            return view('super-admin.events.view', compact('event'));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            $statusCode = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500;
            return $this->failure($exception->getMessage(), $statusCode);
        }
    }

    public function saveMinutes(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            DB::commit();
            $this->eventService->storeMinutes($request->event_mom_detail, $id);

            return response()->json(['success' => true ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function viewMinutes(Event $event)
    {
        return response()->json([
            'minutes' => $event->fresh()->event_mom_detail ?? null
        ]);
    }


    public function getEventForm()
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

        return view('super-admin.events.event-form', compact('domains', 'status', 'individuals', 'organizations', 'embassies'));
    }

    public function store(EventManagementRequest $request)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validated();
            $this->eventService->store($validatedData, $request->selected_emails);
            DB::commit();

            return redirect()->route('events.index')
                ->with('success', 'Event created successfully.');
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create event. Please try again.');
        }
    }

    public function getEditEventForm($id)
    {
        $event = $this->eventService->getEventData($id);
        $domains = $this->eventService->getDomains();
        $statuses = $this->eventService->getActiveAndClosedStatuses();
        
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

        // Get existing attendees and categorize them
        $event->load('attendees.user.roles');
        $existingIndividuals = [];
        $existingOrganizations = [];
        $existingEmbassies = [];

        foreach ($event->attendees as $attendee) {
            if ($attendee->user) {
                $userRoles = $attendee->user->roles->pluck('name')->toArray();
                if (in_array('customer', $userRoles)) {
                    $existingIndividuals[] = $attendee->user_id;
                } elseif (in_array('organization_admin', $userRoles)) {
                    $existingOrganizations[] = $attendee->user_id;
                } elseif (!in_array('super_admin', $userRoles)) {
                    $existingEmbassies[] = $attendee->user_id;
                }
            }
        }

        return view('super-admin.events.edit-event-form', compact('event', 'domains', 'statuses', 'individuals', 'organizations', 'embassies', 'existingIndividuals', 'existingOrganizations', 'existingEmbassies'));
    }

    public function update(EventManagementRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validated();
            $this->eventService->update($validatedData, $id);
            DB::commit();

            return redirect()->route('events.index')
                ->with('success', 'Event updated successfully.');
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update event. Please try again.');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $this->eventService->deleteEvent($id);
            DB::commit();
            return response()->json(['message' => 'Event deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to delete Event', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get action items for an event
     */
    public function getActionItems(Request $request, Event $event)
    {
        try {
            $actionItems = $this->actionItemService->getActionItemsByEvent($event->id, $request);
            
            // Fetch users for dropdown
            $users = User::whereHas('roles', function($query) {
                $query->whereIn('name', ['customer', 'organization_admin']);
            })
            ->where('is_active', true)
            ->orderBy('name')
            ->get(['id', 'name', 'email']);
            
            // Prepare action items data for JavaScript
            $actionItemsData = $actionItems->mapWithKeys(function($item) {
                return [$item->id => [
                    'id' => $item->id,
                    'action' => $item->action,
                    'description' => $item->description,
                    'assigned_to' => $item->assigned_to,
                    'due_date' => $item->due_date ? \Carbon\Carbon::parse($item->due_date)->format('Y-m-d') : '',
                    'status' => $item->status,
                    'comment' => $item->comment
                ]];
            });
            
            // Always return view for action items page
            return view('super-admin.events.action-items', compact('event', 'actionItems', 'users', 'actionItemsData'));
        } catch (\Exception $e) {
            Log::error('Failed to get action items: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to load action items.');
        }
    }

    /**
     * Store a new action item
     */
    public function storeActionItem(Request $request, Event $event)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'action' => 'required|string|max:255',
                'description' => 'nullable|string',
                'assigned_to' => 'nullable|exists:users,id',
                'due_date' => 'nullable|date',
                'status' => 'nullable|in:pending,in_progress,completed,cancelled',
                'comment' => 'nullable|string',
            ]);

            $validated['event_id'] = $event->id;
            $actionItem = $this->actionItemService->store($validated);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Action item created successfully',
                'actionItem' => $actionItem
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create action item: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update an action item
     */
    public function updateActionItem(Request $request, ActionItem $actionItem)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'action' => 'sometimes|string|max:255',
                'description' => 'nullable|string',
                'assigned_to' => 'nullable|exists:users,id',
                'due_date' => 'nullable|date',
                'status' => 'sometimes|in:pending,in_progress,completed,cancelled',
                'comment' => 'nullable|string',
            ]);

            $actionItem = $this->actionItemService->update($actionItem, $validated);
            
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Action item updated successfully',
                'actionItem' => $actionItem
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to update action item: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Delete an action item
     */
    public function deleteActionItem(ActionItem $actionItem)
    {
        DB::beginTransaction();
        try {
            $this->actionItemService->delete($actionItem);
            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Action item deleted successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to delete action item: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
