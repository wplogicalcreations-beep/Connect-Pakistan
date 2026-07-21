<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobRequest;
use App\Models\Lov;
use App\Models\LovType;
use App\Services\JobPostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JobPostController extends Controller
{

    protected $jobPostService;

    public function __construct(JobPostService $jobPostService)
    {
        $this->jobPostService = $jobPostService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $domains = Lov::ofType(LovType::WORK_DOMAIN)->get();
            return view('company-dashboard.job-board.post-job',compact('domains'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJobRequest $request)
    {
        try {
            $job = $this->jobPostService->store($request);
            $organizationName = auth()->user()->name ?? 'Unknown Organization';
            Log::info('new job "' . $job->title . '" has been posted by ' . $organizationName, ['organization_id' => auth()->user()->id, 'job_id' => $job->id]);
            return redirect()
                ->route('company.jobs.list')
                ->with('success', 'Job has been posted successfully!');;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
