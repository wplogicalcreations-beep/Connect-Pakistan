<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    const JOB_TYPES = [
        "full_time" => "Full Time",
        "part_time" => "Part Time",
        "contract" => "Contract",
        "internship" => "Internship"
    ];

    protected $fillable = [
        'title',
        'organization_id',
        'status_id',
        'description',
        'responsibilities',
        'requirements',
        'min_experience',
        'max_experience',
        'benefits',
        'job_type',
        'work_mode',
        'location',
        'address',
        'embed_map',
        'posted_date',
        'expiry_date',
        'min_salary',
        'max_salary',
        'vacancies',
        'currency',
        'domain_id',
    ];

    public function organization() {
        return $this->belongsTo(User::class, 'organization_id');
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function domain()
    {
        return $this->belongsTo(Lov::class, 'domain_id');
    }

    public function scopeApplyFilter($query, $request)
    {
        // Filter by JobPost fields
        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('description')) {
            $query->where('description', 'like', '%' . $request->description . '%');
        }

        if ($request->filled('responsibilities')) {
            $query->where('responsibilities', 'like', '%' . $request->responsibilities . '%');
        }

        if ($request->filled('requirements')) {
            $query->where('requirements', 'like', '%' . $request->requirements . '%');
        }

        if ($request->filled('min_experience')) {
            $query->where('min_experience', '>=', $request->min_experience);
        }

        if ($request->filled('max_experience')) {
            $query->where('max_experience', '<=', $request->max_experience);
        }

        if ($request->filled('job_type')) {
            $query->where('job_type', $request->job_type);
        }

        if ($request->filled('work_mode')) {
            $query->where('work_mode', $request->work_mode);
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        if ($request->filled('min_salary')) {
            $query->where('min_salary', '>=', $request->min_salary);
        }

        if ($request->filled('max_salary')) {
            $query->where('max_salary', '<=', $request->max_salary);
        }

        if ($request->filled('vacancies')) {
            $query->where('vacancies', $request->vacancies);
        }

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
        }

        // --- Relation Filters ---

        // Filter by Organization name
        if ($request->filled('organization_name')) {
            $query->whereHas('organization', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->organization_name . '%');
            });
        }

        // Filter by Status name
        if ($request->filled('status_name')) {
            $query->whereHas('status', function ($q) use ($request) {
                $q->where('name', $request->status_name);
            });
        }

        // Filter by Domain name
        if ($request->filled('domain_name')) {
            $query->whereHas('domain', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->domain_name . '%');
            });
        }

        return $query;
    }

}
