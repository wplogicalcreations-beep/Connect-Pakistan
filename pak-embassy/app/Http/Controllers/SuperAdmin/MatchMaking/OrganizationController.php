<?php

namespace App\Http\Controllers\SuperAdmin\MatchMaking;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lov;

class OrganizationController extends Controller
{
    private function renderOrganizationRows($organizations, $view = 'super-admin.match-making.organization.single-organization-row')
    {
        $rows = '';
        $serialNumber = $organizations instanceof \Illuminate\Pagination\LengthAwarePaginator ? $organizations->firstItem() : 1;

        if ($organizations->count() > 0) {
            foreach ($organizations as $index => $organization) {
                $rows .= view($view, [
                    'organization' => $organization,
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

            $organizations = Organization::where('is_verified', 1)
                                ->applyFilter($request)
                                ->orderBy($sortBy, $sortOrder)
                                ->paginate($records);
            $ceoEmails = $organizations->pluck('ceo_email')->filter()->toArray();
            $ceoUsers = collect();
            if (!empty($ceoEmails)) {
                $ceoUsers = User::whereIn('email', $ceoEmails)
                    ->where('is_active', 1)
                    ->with('skills')
                    ->get()
                    ->mapWithKeys(function ($user) {
                        $user->setRelation('lovs_filtered', $user->lovs()->where('lovs.lov_type_id', 4)->get());
                        return [$user->email => $user];
                    });
            }
            $organizations->transform(function ($org) use ($ceoUsers) {
                $org->ceo = $ceoUsers[$org->ceo_email] ?? null;
                return $org;
            });

            if ($request->ajax()) {
                $rowsHtml = $this->renderOrganizationRows($organizations);
                $pagination = view('components.pagination', ['items' => $organizations])->render();

                return response()->json([
                    'success' => true,
                    'html' => $rowsHtml,
                    'pagination' => $pagination,
                    'count' => $organizations->total(),
                ]);
            }

            return view('super-admin.match-making.organization.index', compact('organizations'));

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function viewMatchMaking($id)
    {
        $organization = Organization::with('images')->findOrFail($id);
        $ceo = User::where('email', $organization->ceo_email)
        ->where('is_active', 1)
        ->with(['lovs'])
        ->first();
        $ceoDomainIds = $ceo?->lovs?->where('lov_type_id', 4)?->pluck('id')?->toArray() ?? []; // domains
        $ceoSkillIds  = $ceo?->lovs?->where('lov_type_id', 2)?->pluck('id')?->toArray() ?? []; // skills
        $serviceDomains = $ceo?->lovs()?->where('lovs.lov_type_id', 4)?->get() ?? collect();
        $recommendedMatches = collect();
        $otherOrganizations = Organization::with('images')
            ->where('is_verified', 1)
        ->where('id', '!=', $organization->id)
            ->get();
        foreach ($otherOrganizations as $org) {
            $orgCeo = User::where('email', $org->ceo_email)
                ->where('is_active', 1)
                ->with(['lovs'])
                ->first();
            if (!$orgCeo) continue;
            $orgDomainIds = $orgCeo->lovs->where('lov_type_id', 4)->pluck('id')->toArray();
            $orgSkillIds  = $orgCeo->lovs->where('lov_type_id', 2)->pluck('id')->toArray();
            $domainMatches = array_intersect($ceoDomainIds, $orgDomainIds);
            $skillMatches  = array_intersect($ceoSkillIds, $orgSkillIds);
            $matchScore = count($domainMatches) + count($skillMatches);
            if ($matchScore > 0) {
                $org->match_score = $matchScore;
                $org->type = 'organization';
                $recommendedMatches->push($org);
            }
        }
        $customers = User::with(['lovs', 'images'])
            ->where('is_active', 1)
            ->whereHas('roles', function ($q) {
                $q->where('name', 'customer');
        })
            ->get();
        foreach ($customers as $customer) {
            $userDomainIds = $customer->lovs->where('lov_type_id', 4)->pluck('id')->toArray();
            $userSkillIds  = $customer->lovs->where('lov_type_id', 2)->pluck('id')->toArray();
            $domainMatches = array_intersect($ceoDomainIds, $userDomainIds);
            $skillMatches  = array_intersect($ceoSkillIds, $userSkillIds);
            $matchScore = count($domainMatches) + count($skillMatches);
            if ($matchScore > 0) {
                $customer->match_score = $matchScore;
                $customer->type = 'user';
                $recommendedMatches->push($customer);
            }
        }
        $recommendedMatches = $recommendedMatches->sortByDesc('match_score')->values();

        return view('super-admin.match-making.organization.view-match-making-company', [
            'organization' => $organization,
            'ceo' => $ceo,
            'recommendedMatches' => $recommendedMatches,
            'serviceDomains' => $serviceDomains,
        ]);
    }
}
