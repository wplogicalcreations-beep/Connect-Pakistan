<?php

namespace App\Services;

use App\Models\Skill;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class SkillService
{
    public function getSkills($request, $type = null)
    {
        $records = $request->has('per_page') ? $request->per_page : 10;
        $sortBy = $request->has('sort_by') ? $request->sort_by : 'id';
        $sortOrder = $request->has('sort_order') ? $request->sort_order : 'desc';

        $query = Skill::query();
        
        // Filter by type if provided (this is the skill type: 'individual' or 'business')
        if ($type) {
            $query->where('type', $type);
        }
        
        // Apply filters (name, status, dates, etc.)
        // Note: We skip 'type' filter in applyFilter because:
        // 1. We already filtered by type above
        // 2. The request 'type' might be 'skills' (LOV slug), not skill type
        $query->applyFilter($request);
        
        // Debug: Log the query for troubleshooting
        Log::info('Skills Query', [
            'sql' => $query->toSql(),
            'bindings' => $query->getBindings(),
            'count' => $query->count(),
            'type_param' => $type,
            'request_type' => $request->get('type')
        ]);
        
        return $query->orderBy($sortBy, $sortOrder)
            ->paginate($records)
            ->withQueryString();
    }
    public function create($request)
    {
        $slug = Str::slug( $request->name);
        $skill = Skill::create(array_merge(
            $request->except(['slug']),
            [
                'slug' => $slug,
            ]
        ));
        return $skill;
    }

    public function update($request,$skill)
    {
        $slug = Str::slug( $request->name);
        $skill->update(array_merge($request->all(),
            [
                'slug' => $slug
            ]));
        $skill->save();
        return $skill;
    }
}
