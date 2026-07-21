<?php

namespace App\Http\Controllers;

use App\Services\CoworkingSpaceService;
use Illuminate\Http\Request;

class CoworkingSpaceController extends Controller
{
    private $coworkingSpaceService;

    public function __construct(CoworkingSpaceService $coworkingSpaceService)
    {
        $this->coworkingSpaceService = $coworkingSpaceService;
    }
    public function index(Request $request)
    {
        $coworkingSpaces = $this->coworkingSpaceService->listing($request);
        if ($request->ajax()) {
            return response()->json([
                'html' => view('user-dashboard.job-board.partials.jobs_list', compact('jobs'))->render(),
                'hasMorePages' => $coworkingSpaces->hasMorePages()
            ]);
        }
        return view('user-dashboard.job-board.discover-job', compact('jobs'));
    }
}
