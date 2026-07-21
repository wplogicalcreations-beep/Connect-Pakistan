<?php

namespace App\Services;

use App\Models\JobPost;

class JobBoardService
{
    public function getAllJobs($request)
    {
        $records = $request->per_page ?? 10;
        $sortBy = $request->sort_by ?? 'id';
        $sortOrder = $request->sort_order ?? 'desc';

        return JobPost::with(['organization', 'applications', 'status'])
            ->applyFilter($request)
            ->with(['status'])
            ->orderBy($sortBy, $sortOrder)
            ->paginate($records)
            ->withQueryString();
    }

    public function update($request)
    {
        $job = JobPost::findOrFail($request->job_id);
        $job->status_id = $request->status_id;
        $job->save();

        return $job;
    }
}