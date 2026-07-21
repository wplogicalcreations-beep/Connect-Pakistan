<?php

namespace App\Services\SuperAdmin;

use App\Models\CoworkingSpace;
use App\Models\Event;
use App\Models\Lead;
use App\Models\Lov;
use App\Models\LovType;
use App\Models\Organization;
use App\Models\User;
use Carbon\Carbon;

class DashboardService
{

    public function getDashboardData($request)
    {
        $employeeInfo = $this->employeeInfo();
        $eventsCount = $this->eventsCount();
        $coworkingSpacesCount = $this->coworkingSpacesCount();
        $events = $this->eventList();
        $diasporaByLevel = $this->diasporaByLevel();
        $diasporaByAbility = $this->diasporaByAbility();
        $leads = $this->leads();
        $companiesDisporaMonthlyCounts = $this->companiesDisporaMonthlyCounts($request);
        $matchmaking = $this->getMatchmakingStats();


        return [
            'employee_info' => $employeeInfo,
            'events_count' => $eventsCount,
            'coworking_spaces_count' => $coworkingSpacesCount,
            'diaspora_by_level'  => $diasporaByLevel,
            'diasporaByAbility'  => $diasporaByAbility,
            'companiesDisporaMonthlyCounts' => $companiesDisporaMonthlyCounts,
            'leads' => $leads,
            'events' => $events,
            'matchmaking' => $matchmaking
        ];
    }

    public function employeeInfo()
    {
        $totalEmployees = User::active()->withRoles(['organization_admin', 'customer'])->count();
        $individuals = User::active()->withRoles(['customer'])->count();
        $organizations = User::active()->withRoles(['organization_admin'])->count();

        return [
            'total_employees' => $totalEmployees,
            'individuals' => $individuals,
            'organizations' => $organizations,
        ];
    }

    public function eventsCount()
    {
        $events = Event::count();
        return $events;
    }

    public function coworkingSpacesCount()
    {
        $coworkingSpaces = CoworkingSpace::count();
        return $coworkingSpaces;
    }

    public function diasporaByLevel()
    {
        $totalIndividualUsers = User::active()->withRoles(['customer'])->count(); // Or User::active()->count() if you have a scope
        $levels = Lov::whereHas('lovType', function ($query) {
            $query->where('slug', LovType::LEVEL);
        })
            ->withCount(['users as user_count' => function ($q) {
                $q->active()->withRoles(['customer']); // apply your active scope + role filter
            }])
            ->get()
            ->map(function ($level) use ($totalIndividualUsers) {
                $percentage = $totalIndividualUsers > 0 ? round(($level->user_count / $totalIndividualUsers) * 100, 2) : 0;

                return [
                    'level_name' => $level->name,
                    'percentage' => $percentage,
                    'count' => $level->user_count,
                ];
            });
        return $levels;
    }

    public function diasporaByAbility()
    {
        return Lov::whereHas('lovType', function ($query) {
            $query->where('slug', LovType::INFLUENCE_ABILITY);
        })
            ->withCount(['users as user_count' => function ($q) {
                $q->active()->withRoles(['customer']); // apply your active scope + role filter
            }])
            ->get()
            ->map(function ($ability) {
                return [
                    'ability_name' => $ability->name,
                    'percentage'   => $ability->user_count,
                ];
            });
    }

    public function companiesDisporaMonthlyCounts($request)
    {
        $currentYear = now()->year ?? $request->year;

        $users = User::active()->with(['roles'])
            ->whereYear('created_at', $currentYear)
            ->whereHas('roles', fn($q) => $q->whereIn('name', ['customer', 'organization_admin']))
            ->get();

        // Filter by month using Carbon (Collections-compatible way)
        return collect(range(1, 12))->map(function ($month) use ($users) {
            $monthUsers = $users->filter(fn($user) => $user->created_at->month == $month);

            return [
                'month' => $month,
                'individual' => $monthUsers->filter(fn($u) => $u->hasRole('customer'))->count(),
                'organization_admin' => $monthUsers->filter(fn($u) => $u->hasRole('organization_admin'))->count(),
            ];
        });
    }


    public function eventList()
    {
        $events = Event::all();
        return $events;
    }

    public function leads()
    {
        $matureLeadsCount = 0;
        $pendingLeadsCount = User::active()->withRoles(['organization_admin', 'customer'])->count();

        $leads = Lead::count() ?: ($matureLeadsCount + $pendingLeadsCount);

        return [
            'leads' => $leads,
            'matureLeadsCount' => $matureLeadsCount,
            'pendingLeadsCount' => $pendingLeadsCount,
        ];
    }

    public function getMatchmakingStats()
    {
        $currentYear = Carbon::now()->year;

        $individuals = User::active()->withRoles(['customer'])
            ->with(['skills:id,name', 'work_domain:id,name'])
            ->get();

        $organizations = User::active()->withRoles(['organization_admin'])
            ->with(['skills:id,name', 'work_domain:id,name'])
            ->get();

        $matches = collect();

        foreach ($individuals as $individual) {
            $indSkills = $individual->skills->pluck('id')->toArray();
            $indDomains = $individual->work_domain->pluck('id')->toArray();

            foreach ($organizations as $organization) {
                $orgSkills = $organization->skills->pluck('id')->toArray();
                $orgDomains = $organization->work_domain->pluck('id')->toArray();

                $skillMatches = array_intersect($indSkills, $orgSkills);
                $domainMatches = array_intersect($indDomains, $orgDomains);

                if (!empty($skillMatches) || !empty($domainMatches)) {
                    $matches->push([
                        'individual_id'   => $individual->id,
                        'organization_id' => $organization->id,
                        'matched_skills'  => $skillMatches,
                        'matched_domains' => $domainMatches,
                        'created_at'      => $individual->created_at,
                    ]);
                }
            }
        }

        // ✅ Yearly total
        $yearlyTotal = $matches->whereBetween('created_at', [
            Carbon::create($currentYear, 1, 1),
            Carbon::create($currentYear, 12, 31),
        ])->count();

        // ✅ Monthly counts (Jan–Dec, fill missing with 0)
        $monthlyStats = collect(range(1, 12))->mapWithKeys(function ($month) use ($matches, $currentYear) {
            $count = $matches->filter(function ($match) use ($month, $currentYear) {
                return Carbon::parse($match['created_at'])->year == $currentYear &&
                    Carbon::parse($match['created_at'])->month == $month;
            })->count();

            return [Carbon::create()->month($month)->format('M') => $count];
        });
        return [
            'year' => $currentYear,
            'total_matches' => $yearlyTotal,
            'monthly_breakdown' => $monthlyStats,
        ];
    }
}
