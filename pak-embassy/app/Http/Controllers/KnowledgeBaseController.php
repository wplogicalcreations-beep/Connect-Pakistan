<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKnowledgeRequest;
use App\Http\Requests\UpdateKnowledgeRequest;
use App\Models\Status;
use App\Services\SuperAdmin\KnowledgeBaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KnowledgeBaseController extends Controller
{
    protected $knowledgeBaseService;

    public function __construct(KnowledgeBaseService $knowledge_base_service)
    {
        $this->knowledgeBaseService = $knowledge_base_service;
    }

    private function renderKnowledgeBaseRows($knowledgeBases, $view = 'super-admin.knowledge-base.single-know-row')
    {
        $rows = '';
        $serialNumber = $knowledgeBases instanceof \Illuminate\Pagination\LengthAwarePaginator ? $knowledgeBases->firstItem() : 1;

        if ($knowledgeBases->count() > 0) {
            foreach ($knowledgeBases as $index => $knowledgeBase) {
                $rows .= view($view, [
                    'knowledgeBase' => $knowledgeBase,
                    'serialNumber' => $serialNumber + $index
                ])->render();
            }
        } else {
            $rows .= '<tr id="no-record-row"><td colspan="16" class="text-center">No record found</td></tr>';
        }

        return $rows;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $knowledgeBases = $this->knowledgeBaseService->getAll($request);

        if ($request->ajax()) {
            $rowsHtml = $this->renderKnowledgeBaseRows($knowledgeBases);
            $pagination = view('components.pagination', ['items' => $knowledgeBases])->render();

            return response()->json([
                'success' => true,
                'html' => $rowsHtml,
                'pagination' => $pagination,
                'count' => $knowledgeBases->total(),
            ]);
        }

        return view('super-admin.knowledge-base.index', compact('knowledgeBases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('super-admin.knowledge-base.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKnowledgeRequest $request)
    {
        DB::beginTransaction();

        try {
            $knowledgeBase = $this->knowledgeBaseService->store($request->all());

            DB::commit();
            return response()->json([
                'message' => 'Knowledge base saved successfully',
                'data' => $knowledgeBase
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $knowledgeBase = $this->knowledgeBaseService->getById($id);
        return view('super-admin.knowledge-base.detail', compact('knowledgeBase'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $knowledgeBase = $this->knowledgeBaseService->getById($id);
        return view('super-admin.knowledge-base.create', compact('knowledgeBase'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id, UpdateKnowledgeRequest $request)
    {
        DB::beginTransaction();

        try {
            // Only use validated data
            $validatedData = $request->validated();

            // Update via service
            $knowledgeBase = $this->knowledgeBaseService->update((int) $id, $validatedData);

            DB::commit();

            return response()->json([
                'message' => 'Knowledge base updated successfully',
                'data' => []
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            return response()->json(['error' => 'Knowledge base not found'], 404);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update only the status of the knowledge base.
     */
    public function updateStatus(string $id, Request $request)
    {
        try {
            $request->validate([
                'status_id' => 'required|integer'
            ]);

            $knowledgeBase = $this->knowledgeBaseService->getById($id);
            
            if (!$knowledgeBase) {
                return response()->json(['error' => 'Knowledge base not found'], 404);
            }

            // Convert 0/1 to actual status IDs
            // 1 = active, 0 = inactive
            $statusId = $request->status_id == 1 
                ? Status::getStatusIdBySlug('active')
                : Status::getStatusIdBySlug('inactive');

            if (!$statusId) {
                return response()->json(['error' => 'Invalid status'], 422);
            }

            $knowledgeBase->status_id = $statusId;
            $knowledgeBase->save();

            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully',
                'status_id' => $knowledgeBase->status_id
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();

        try {

            $this->knowledgeBaseService->delete((int) $id);

            DB::commit();

            return response()->json([
                'message' => 'Knowledge base deleted successfully',
                'id' => $id
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            return response()->json(['error' => 'Knowledge base not found'], 404);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
