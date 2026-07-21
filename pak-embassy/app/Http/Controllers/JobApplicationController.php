<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobApplicationRequest;
use App\Models\Department;
use App\Models\JobApplication;
use App\Models\JobPost;
use App\Models\Lov;
use App\Models\LovType;
use App\Services\DepartmentService;
use App\Services\JobApplicationService;
use App\Services\JobPostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobApplicationController extends Controller
{

    private $jobApplicationService;
    private $departmentService;

    public function __construct(JobApplicationService $jobApplicationService, DepartmentService $departmentService)
    {
        $this->jobApplicationService    = $jobApplicationService;
        $this->departmentService        = $departmentService;
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
    public function create(JobPost $job)
    {
        // $departments = Lov::ofType(LovType::WORK_DOMAIN)->get();
        $departments = Department::all();
        $user = Auth::user();
        return view('user-dashboard.job-board.job-apply', compact('job', 'user', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(JobApplicationRequest $request)
    {
        try {
            $jobApplictaion = $this->jobApplicationService->storeJobApplictaion($request);
            return response()->json([
                'success' => true,
                'message' => 'Application submitted successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(JobApplication $jobApplication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobApplication $jobApplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobApplication $jobApplication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobApplication $jobApplication)
    {
        //
    }
}
