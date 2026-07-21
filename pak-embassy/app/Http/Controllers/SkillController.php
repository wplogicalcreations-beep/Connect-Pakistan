<?php

namespace App\Http\Controllers;

use App\Helpers\GeneralHelper;
use App\Http\Requests\SkillRequest;
use App\Models\Lov;
use App\Models\Skill;
use App\Services\SkillService;
use \Symfony\Component\HttpKernel\Exception\HttpException as Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SkillController extends Controller
{
    private $skillService;

    public function __construct(SkillService $skillService)
    {
        $this->skillService = $skillService;
    }

    public function index(Request $request)
    {
        try {
            // Get type from request (for filtering by individual/business)
            $type = $request->get('type');
            $skills = $this->skillService->getSkills($request, $type);

            if ($request->ajax()) {
                $rowsHtml = $this->renderSkillRows($skills); // Blade partial rendering
                $pagination = view('components.pagination', ['items' => $skills])->render();

                return response()->json([
                    'success' => true,
                    'html' => $rowsHtml,
                    'pagination' => $pagination,
                    'count' => $skills->total(),
                ]);
            }
            return view('super-admin.lov.skills.index', compact('skills', 'type'));
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
            return $this->failure(
                $exception->getMessage(),
                method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500
            );
        }
    }


    /**
     * Show the signup-form for creating a new resource.
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SkillRequest $request)
    {
        try {
            // Create skill
            $skill = $this->skillService->create($request);

            // Fetch skills filtered by type if provided
            $type = $request->get('type') ?? $skill->type;
            $query = Skill::orderBy('id', 'DESC');
            if ($type) {
                $query->where('type', $type);
            }
            $skills = $query->get();

            // Render Blade rows
            $rowHtml = $this->renderSkillRows($skills);

            return response()->json([
                'success' => true,
                'html' => $rowHtml,
                'skill' => $skill,
                'message' => 'Skill created successfully!',
            ]);

        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
            return $this->failure(
                $exception->getMessage(),
                method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Skill $skill)
    {
        //
    }

    /**
     * Show the signup-form for editing the specified resource.
     */
    public function edit(Skill $skill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skill $skill)
    {
        try {
            // Handle status toggle update (AJAX from toggle switch)
            if ($request->has('status_id') || $request->has('is_active')) {
                $status = $request->input('status_id') ?? $request->input('is_active');
                $skill->is_active = $status;
                $skill->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Status updated successfully',
                    'skill' => $skill
                ]);
            }

            // Handle regular form update
            $skillRequest = SkillRequest::createFrom($request);
            $skillRequest->setContainer(app());
            $skillRequest->validateResolved();

            // Update the skill
            $skill = $this->skillService->update($skillRequest, $skill);

            // Fetch updated skills list filtered by type
            $type = $request->get('type') ?? $skill->type;
            $query = Skill::orderBy('id', 'DESC');
            if ($type) {
                $query->where('type', $type);
            }
            $skills = $query->get();

            // Render Blade rows
            $rowHtml = $this->renderSkillRows($skills);

            return response()->json([
                'success' => true,
                'skill' => $skill,
                'html' => $rowHtml,
            ]);

        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        try {
            $skill->delete();
            return response()->json([
                'delete' => true,
                'message' => 'Skill deleted successfully!'
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->failure(
                $exception->getMessage(),
                $exception->getStatusCode()
            );
        }
    }

    private function renderSkillRows($skills, $view = 'super-admin.lov.skills.single-skill-row')
    {
        $rows = '';
        $serialNumber = $skills instanceof \Illuminate\Pagination\LengthAwarePaginator ? $skills->firstItem() : 1;

        foreach ($skills as $index => $skill) {
            $rows .= view($view, [
                'skill' => $skill,
                'serialNumber' => $serialNumber + $index
            ])->render();
        }

        return $rows;
    }

}
