<?php

namespace App\Services;

use App\Models\JobPost;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobPostedNotificationMail;
use App\Models\Status;

class JobPostService
{

    public function job_posts($request)
    {
        $records = $request->per_page ?? 9;
        $sortBy = $request->sort_by ?? 'created_at';
        $sortOrder = $request->sort_order ?? 'desc';

        return JobPost::applyFilter($request)
            ->orderBy($sortBy, $sortOrder)
            ->paginate($records)
            ->withQueryString();
    }

    public function activeJobs($request)
    {
        $records = $request->per_page ?? 9;
        $sortBy = $request->sort_by ?? 'created_at';
        $sortOrder = $request->sort_order ?? 'desc';

        return JobPost::applyFilter($request)
        ->where('status_id',Status::getStatusIdBySlug('active'))
            ->orderBy($sortBy, $sortOrder)
            ->paginate($records)
            ->withQueryString();
    }

    public function jobDetails($id)
    {
        $jobDetails = JobPost::find($id);
        return $jobDetails;
    }

    public function store($request)
    {
        $job = JobPost::create(
            array_merge(
                $request->all(),
                [
                    'organization_id' => auth()->id(),
                    'posted_at' => Carbon::now(),
                    'status_id' => Status::getStatusIdBySlug('active')
                ]
            )
        );

        // Get organization details
        $organization = auth()->user();

        // Log the job posting
        $organizationName = $organization->name ?? 'Unknown Organization';
        Log::info('new job "' . $job->title . '" has been posted by ' . $organizationName, ['organization_id' => auth()->id(), 'job_id' => $job->id]);

        // Send email notification to all super admins
        $this->sendJobPostedNotificationToAdmins($job, $organization);

        return $job;
    }

    private function sendJobPostedNotificationToAdmins(JobPost $job, User $organization = null)
    {
        try {
            // Get all super admin users
            $superAdmins = User::whereHas('roles', function($query) {
                $query->where('name', 'super_admin');
            })->get();

            // Send email to each super admin
            foreach ($superAdmins as $admin) {
                if ($admin->email) {
                    Mail::to($admin->email)
                        ->send(new JobPostedNotificationMail($job, $organization));
                }
            }
        } catch (\Exception $e) {
            // Log error but don't throw exception to prevent breaking the job creation
            Log::error('Failed to send job posted notification to admins: ' . $e->getMessage());
        }
    }
}
