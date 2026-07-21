<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Services\SuperAdmin\CoworkingSpaceService;
use App\Http\Requests\StoreCoworkingSpaceRequest;
use App\Models\CoworkingSpace;
use Symfony\Component\HttpKernel\Exception\HttpException  as Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CoworkingSpaceController extends Controller
{
    protected $coworkingSpaceService;

    public function __construct(CoworkingSpaceService $coworkingSpaceService)
    {
        $this->coworkingSpaceService = $coworkingSpaceService;
    }

    public function renderCoworkingSpaceRows($coWorkingSpaces, $view = 'super-admin.co-working-space.single-space-row')
    {
        $rows = '';
        $serialNumber = $coWorkingSpaces instanceof \Illuminate\Pagination\LengthAwarePaginator ? $coWorkingSpaces->firstItem() : 1;

        if ($coWorkingSpaces->count() > 0) {
            foreach ($coWorkingSpaces as $index => $space) {
                $rows .= view($view, [
                    'space' => $space,
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
        $coWorkingSpaces = $this->coworkingSpaceService->getAll($request);

        if ($request->ajax()) {
            $rowsHtml = $this->renderCoworkingSpaceRows($coWorkingSpaces);
            $pagination = view('components.pagination', ['items' => $coWorkingSpaces])->render();

            return response()->json([
                'success' => true,
                'html' => $rowsHtml,
                'pagination' => $pagination,
                'count' => $coWorkingSpaces->total(),
            ]);
        }

        return view('super-admin.co-working-space.index', compact('coWorkingSpaces'));
    }

    public function show(CoworkingSpace $space)
    {
        try {
            return view('super-admin.co-working-space.work-space-detail', compact('space'));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->failure($exception->getMessage(), $exception->getStatusCode());
        }
    }

    public function showEnquiry($id)
    {
        $enquiry = $this->coworkingSpaceService->getSpaceRequestById($id);

        // Return Blade as JSON
        $html = view('super-admin.co-working-space.enquiry', compact('enquiry'))->render();

        return response()->json(['html' => $html]);
    }

    public function store(StoreCoworkingSpaceRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->coworkingSpaceService->store($request->validated());

            DB::commit();

            return redirect()
                ->route('co-working-space.index')
                ->with('success', 'Coworking space created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withErrors(['error' => 'Something went wrong: ' . $e->getMessage()])
                ->withInput();
        }
    }

    private function renderRequestRows($requests, $view = 'super-admin.co-working-space.single-space-request-row')
    {
        $rows = '';
        $serialNumber = $requests instanceof \Illuminate\Pagination\LengthAwarePaginator ? $requests->firstItem() : 1;

        if ($requests->count() > 0) {
            foreach ($requests as $index => $space) {
                $rows .= view($view, [
                    'request' => $space,
                    'serialNumber' => $serialNumber + $index
                ])->render();
            }
        } else {
            $rows .= '<tr id="no-record-row"><td colspan="16" class="text-center">No record found</td></tr>';
        }

        return $rows;
    }

    private function renderSpaceSpecificRequestRows($requests, $view = 'super-admin.co-working-space.single-space-specific-request-row')
    {
        $rows = '';
        $serialNumber = $requests instanceof \Illuminate\Pagination\LengthAwarePaginator ? $requests->firstItem() : 1;

        if ($requests->count() > 0) {
            foreach ($requests as $index => $request) {
                $rows .= view($view, [
                    'request' => $request,
                    'serialNumber' => $serialNumber + $index
                ])->render();
            }
        } else {
            $rows .= '<tr id="no-record-row"><td colspan="9" class="text-center">No record found</td></tr>';
        }

        return $rows;
    }

    public function spacesRequestIndex(Request $request)
    {
        $requests = $this->coworkingSpaceService->getSpacesRequest($request);

        if ($request->ajax()) {
            $rowsHtml = $this->renderRequestRows($requests);
            $pagination = view('components.pagination', ['items' => $requests])->render();

            return response()->json([
                'success' => true,
                'html' => $rowsHtml,
                'pagination' => $pagination,
                'count' => $requests->total(),
            ]);
        }

        return view('super-admin.co-working-space.co-working-space-requests', compact('requests'));
    }

    public function acceptEnquiry($id)
    {
        $this->coworkingSpaceService->acceptEnquiry($id);

        return redirect()->back()->with('success', 'Enquiry accepted successfully!');
    }

    public function rejectEnquiry($id)
    {
        $this->coworkingSpaceService->rejectEnquiry($id);

        return redirect()->back()->with('success', 'Enquiry rejected successfully!');
    }

    public function inReviewEnquiry($id)
    {
        $this->coworkingSpaceService->inReviewEnquiry($id);

        return redirect()->back()->with('success', 'Enquiry in review successfully!');
    }

    public function spaceRequests(CoworkingSpace $space, Request $request)
    {
        try {
            $requests = $this->coworkingSpaceService->getRequestsBySpace($space->id, $request);

            if ($request->ajax()) {
                $rowsHtml = $this->renderSpaceSpecificRequestRows($requests);
                $pagination = view('components.pagination', ['items' => $requests])->render();

                return response()->json([
                    'success' => true,
                    'html' => $rowsHtml,
                    'pagination' => $pagination,
                    'count' => $requests->total(),
                ]);
            }

            return view('super-admin.co-working-space.space-requests', compact('requests', 'space'));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', 'Failed to load requests: ' . $exception->getMessage());
        }
    }
}