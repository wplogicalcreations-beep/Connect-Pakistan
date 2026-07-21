<?php

namespace App\Services\SuperAdmin\Reports;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
use App\Models\JobPost;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\CoworkingSpace;
use Illuminate\Pagination\LengthAwarePaginator;

class ReportsManagementService
{
    public function getUsersAndOrganizations(Request $request)
    {
        $records = $request->per_page ?? 10;
        $sortBy = $request->sort_by ?? 'id';
        $sortOrder = $request->sort_order ?? 'desc';

        // paginate directly on query
        $users = User::query()
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
            ->applyFilter($request)
            ->orderBy($sortBy, $sortOrder)
            ->paginate($records);

        // transform paginated items
        $result = $users->through(function ($user) {
            $userData = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone ?? null,
                'status' => $user->status ?? 'active',
                'created_at' => $user->created_at ?? null,
            ];

            if ($user->hasRole('customer')) {
                $userData['user_type'] = 'Skilled Individual';
            } elseif ($user->hasRole('organization_admin')) {
                $userData['user_type'] = 'Organization';
                $organization = Organization::where('ceo_email', $user->email)->first();
                $userData['organization'] = $organization ? [
                    'id' => $organization->id,
                    'name' => $organization->name,
                    'ceo_email' => $organization->ceo_email
                ] : null;
            }

            return $userData;
        });

        return $result;
    }

    public function getJobPosts(Request $request)
    {
        // You can customize the perPage value (default to 10 if not passed)
        $records = $request->per_page ?? 10;
        $sortBy = $request->sort_by ?? 'id';
        $sortOrder = $request->sort_order ?? 'desc';

        $jobs = JobPost::with('organization')
            ->withCount('applications')
            ->applyFilter($request)
            ->orderBy($sortBy, $sortOrder)
            ->paginate($records);

        // Transform the paginated data
        $jobs->getCollection()->transform(function ($job) {
            return [
                'id' => $job->id,
                'company_name' => $job->organization?->name ?? '-',
                'location' => $job->location ?? '-',
                'post_date' => $job->posted_date ?? null,
                'total_applicants' => $job->applications_count ?? 0,
                'deadline' => $job->expiry_date ?? null,
                'status' => $job->status?->name ?? 'active',
            ];
        });

        return $jobs;
    }


    public function getEvents(Request $request)
    {
        // Default 10 per page, allow override via ?per_page=20
        $records = $request->per_page ?? 10;
        $sortBy = $request->sort_by ?? 'id';
        $sortOrder = $request->sort_order ?? 'desc';

        $events = Event::applyFilter($request)
            ->orderBy($sortBy, $sortOrder)
            ->paginate($records);

        // Transform the paginated collection
        $events->getCollection()->transform(function ($event) {
            return [
                'id' => $event->id,
                'name' => $event->name ?? '-',
                'type' => $event->event_type ?? '-',
                'registered_users' => $event->registrations_count ?? 0,
                'event_date' => $event->start_date ?? null,
                'start_time' => $event->start_time ?? null,
                'end_time' => $event->end_time ?? null,
                'status' => $event->status?->name ?? 'active',
            ];
        });

        return $events;
    }

    public function getCoWorkingSpaces(Request $request)
    {
        // Default 10 per page, but allow override via query param
        $perPage = $request->get('per_page', 10);

        $records = $request->per_page ?? 10;
        $sortBy = $request->sort_by ?? 'id';
        $sortOrder = $request->sort_order ?? 'desc';

        $spaces = CoworkingSpace::applyFilter($request)
            ->orderBy($sortBy, $sortOrder)
            ->paginate($records);

        // Transform only the paginated collection
        $spaces->getCollection()->transform(function ($assignment) {
            return [
                'id' => $assignment->id,
                'assignee_name' => $assignment->name ?? '-',
                'assignee_type' => $assignment->space_type ?? '-',
                'head_count' => $assignment->people ?? 0,
                'space_name' => $assignment->name ?? '-',
                'rental' => $assignment->month_rentals ?? '-',
                'location' => $assignment->location ?? '-',
                'duration' => $assignment->duration ?? '-',
                'phone' => $assignment->phone ?? '-',
            ];
        });

        return $spaces;
    }


    public function getMatchMakingReport(Request $request)
    {
        $records = $request->per_page ?? 10;
        $sortBy = $request->sort_by ?? 'id';
        $sortOrder = $request->sort_order ?? 'desc';

        $customers = User::where('is_active', 1)
            ->role('customer')
            ->with(['lovs', 'skills', 'industry_area'])
            ->applyFilter($request)
            ->orderBy($sortBy, $sortOrder)
            // ->paginate($records);
            ->get();

        $organizations = Organization::where('is_verified', 1)->get();
        $matches = collect();

        foreach ($customers as $customer) {
            $custDomainIds = $customer->lovs->where('pivot.lov_type_id', 4)->pluck('id')->toArray();
            $custSkillIds  = $customer->skills->pluck('id')->toArray();
            $customerIndustry = $customer->industry_area?->first()?->name;

            if (empty($custDomainIds) && empty($custSkillIds)) {
                continue;
            }

            foreach ($organizations as $org) {
                if (!$org->ceo_email) {
                    continue;
                }

                $orgCeo = User::where('email', $org->ceo_email)
                    ->where('is_active', 1)
                    ->with(['lovs', 'skills'])
                    ->first();

                if (!$orgCeo) {
                    continue;
                }

                $orgDomainIds = $orgCeo->lovs->where('pivot.lov_type_id', 4)->pluck('id')->toArray();
                $orgSkillIds  = $orgCeo->skills->pluck('id')->toArray();

                $domainMatches = array_intersect($custDomainIds, $orgDomainIds);
                $skillMatches  = array_intersect($custSkillIds, $orgSkillIds);

                $score = count($domainMatches) + count($skillMatches);

                if ($score <= 0) {
                    continue;
                }

                $matchedDomainNames = $customer->lovs
                    ->where('pivot.lov_type_id', 4)
                    ->whereIn('id', $domainMatches)
                    ->pluck('name')
                    ->toArray();

                $matchedSkillNames = $customer->skills
                    ->whereIn('id', $skillMatches)
                    ->pluck('name')
                    ->toArray();

                $custTotal = max(1, count($custDomainIds) + count($custSkillIds));
                $orgTotal  = max(1, count($orgDomainIds)  + count($orgSkillIds));
                $maxPossible = max($custTotal, $orgTotal);

                $percent = (int) round(($score / $maxPossible) * 100);

                $matches->push([
                    'individual_name' => $customer->name,
                    'company_name'    => $org->name,
                    'skill_match'     => $percent . '%',
                    'industry'        => $customerIndustry ?? '-',
                    'domain'          => !empty($matchedSkillNames) ? implode(', ', $matchedSkillNames) : '-',
                    'match_date'      => now()->format('d/m/Y'),
                    'status'          => ($customer->is_active && $org->is_verified) ? 'Active' : 'Inactive',
                    'score'           => $score,
                ]);
            }
        }

        // Sort by score descending
        $matches = $matches->sortByDesc('score')->values();

        // Remove score from final response
        $matches = $matches->map(function ($item) {
            unset($item['score']);
            return $item;
        });

        // Manual pagination
        $perPage = $request->get('per_page', 10);
        $page = LengthAwarePaginator::resolveCurrentPage();
        $paginated = new LengthAwarePaginator(
            $matches->forPage($page, $perPage),
            $matches->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return $paginated;
    }
}
