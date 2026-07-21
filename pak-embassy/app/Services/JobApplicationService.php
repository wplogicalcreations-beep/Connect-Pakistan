<?php

namespace App\Services;

use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobApplicationService
{
    public function storeJobApplictaion($request)
    {
        return DB::transaction(function () use ($request) {
            $validated = $request->validated();

            // Step 1: Create Job Application
            $jobApplication = JobApplication::create([
                'user_id'     => Auth::id(),
                'job_post_id' => $validated['job_post_id'],
                'status_id'   => null,
            ]);
            $path = 'job-applications/' . $jobApplication->id;
            // Step 2: Handle file uploads
            // Step 2: Handle file uploads
            $resumePath = $request->hasFile('resume')
                ? $request->file('resume')->store( $path, 'public')
                : null;

            
             // Image
            if ($request->hasFile('image')) {
                $image = upload_image(auth()->user(), $request->file('image'), $path);
                $jobApplication->images()->save($image);
            }

            // Step 3: Save job application details
            $jobApplicationDetails = $jobApplication->details()->create([
                'department_id'  => $validated['department_id'] ?? null,
                'name'           => trim(($validated['first_name'] ?? '') . ' ' . ($validated['last_name'] ?? '')),
                'email'          => $request->email ?? null,
                'phone'          => $validated['phone'] ?? null,
                'street_address' => $validated['street_address'] ?? null,
                'city'           => $validated['city'] ?? null,
                'state'          => $validated['state'] ?? null,
                'postal_code'    => $validated['postal_code'] ?? null,
                'country'        => $validated['country'] ?? null,
                'linkedin_url'   => $validated['linkedin_url'] ?? null,
                'portfolio_link' => $validated['portfolio_link'] ?? null,
                'skills'         => $validated['skills'] ?? null,
                'resume'         => $resumePath,
            ]);

            $jobApplicationDetails->resume = $resumePath;

            // Step 4: Save Education records (polymorphic)
            if ($request->has('education')) {
                $educationData = collect($request->input('education'))
                    ->map(function ($edu) use ($jobApplication) {
                        return [
                            'educationable_type' => 'App\Models\JobApplication',
                            'educationable_id'   => $jobApplication->id,
                            'degree_type'        => $edu['degree_type'] ?? null,
                            'institution'        => $edu['institution'] ?? null,
                            'degree_name'        => $edu['degree_name'] ?? null,
                            'country_id'         => $edu['country_id'] ?? null,
                            'start_date'         => $edu['start_date'] ?? null,
                            'end_date'           => $edu['end_date'] ?? null,
                            'currently_studying' => filter_var($edu['currently_studying'] ?? false, FILTER_VALIDATE_BOOLEAN),
                            'description'        => $edu['description'] ?? null,
                        ];
                    })->toArray();

                $jobApplication->educations()->createMany($educationData);
            }
            // Step 5: Save Experience records (polymorphic)
            if ($request->has('experience')) {
                $experienceData = collect($request->input('experience'))
                    ->map(function ($exp) use ($jobApplication) {
                        return [
                            'experienceable_type' => 'App\Models\JobApplication',
                            'experienceable_id'   => $jobApplication->id,
                            'job_title'           => $exp['job_title'] ?? null,
                            'job_type'            => $exp['job_type'] ?? null,
                            'company_name'        => $exp['company_name'] ?? null,
                            'your_location'       => $exp['your_location'] ?? null,
                            'company_location'    => $exp['company_location'] ?? null,
                            'country_id'          => $exp['country_id'] ?? null,
                            'start_date'          => $exp['start_date'] ?? null,
                            'end_date'            => $exp['end_date'] ?? null,
                            'currently_working'   => filter_var($exp['currently_working'] ?? false, FILTER_VALIDATE_BOOLEAN),
                            'description'         => $exp['description'] ?? null,
                        ];
                    })->toArray();

                $jobApplication->experiences()->createMany($experienceData);
            }


            return $jobApplication; // Optional: return it if needed
        });
    }

    public function userJobApplication($request)
    {
        $user = Auth::user();
        $job_applications = $user->jobApplications;
        return $job_applications;
    }
}
