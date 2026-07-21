<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'is_active',
    ];
    public function scopeApplyFilter($query, $request)
    {
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('status')) {
            $query->where('is_active', $request->status);
        }
        // Only filter by type if it's a valid skill type ('individual' or 'business')
        // Don't filter if type is 'skills' (which is the LOV type slug, not skill type)
        // We already filter by type in SkillService::getSkills(), so we skip it here
        // to avoid conflicts with URL parameter 'type=skills'
        if ($request->filled('type') && in_array($request->type, ['individual', 'business'])) {
            $query->where('type', $request->type);
        }
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }

        return $query;
    }

    /**
     * Scope to filter by type
     */
    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }

}
