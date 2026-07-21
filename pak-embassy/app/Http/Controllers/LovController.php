<?php

namespace App\Http\Controllers;

use App\Http\Requests\LovRequest;
use App\Models\Lov;
use App\Models\LovType;
use App\Models\Skill;
use App\Services\LovService;
use App\Services\SkillService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use \Symfony\Component\HttpKernel\Exception\HttpException as Exception;

class LovController extends Controller
{
    private $lovService;
    private $skillService;

    public function __construct(LovService $lovService, SkillService $skillService)
    {
        $this->lovService = $lovService;
        $this->skillService = $skillService;
    }

    /**
     * Display category page with all LOV types for that category
     */
    public function categoryIndex(Request $request, $category)
    {
        try {
            // Validate category
            $validCategories = ['individual', 'business', 'embassy'];
            if (!in_array($category, $validCategories)) {
                abort(404, 'Invalid category');
            }

            $lovTypes = $this->lovService->getLovTypesByCategory($category);
            
            // Add "Skills" as a special option for Individual category
            if ($category === 'individual') {
                $lovTypes->push((object)[
                    'name' => 'Skills',
                    'slug' => 'skills',
                    'category' => $category,
                    'is_skill' => true // Flag to identify it's a skill, not a LOV
                ]);
            }
            
            $lovs = null;
            $skills = null;
            $isSkillsView = false;
            
            // Get selected type from request, default to first type if not provided
            $selectedType = $request->get('type', $lovTypes->first()?->slug);
            
            // Check if selected type is "skills" for Individual category
            if ($category === 'individual' && $selectedType === 'skills') {
                // For Individual category, show skills when "Skills" is selected
                $isSkillsView = true;
                $skills = $this->skillService->getSkills($request, 'individual');
            } elseif ($category === 'business' && ($selectedType === 'service-skills' || $selectedType === 'skills')) {
                // For Business category, show skills when "Service Skills" is selected
                // Also handle case where 'skills' is passed instead of 'service-skills'
                $isSkillsView = true;
                $skills = $this->skillService->getSkills($request, 'business');
            } elseif ($selectedType) {
                // Fetch LOVs for other cases
                $lovs = $this->lovService->getLovsByCategoryAndType($request, $category, $selectedType);
            }

            if ($request->ajax()) {
                if ($isSkillsView && $skills) {
                    // Render skills rows
                    $rowsHtml = $this->renderSkillRows($skills);
                    $pagination = view('components.pagination', ['items' => $skills])->render();
                    return response()->json([
                        'success' => true,
                        'html' => $rowsHtml,
                        'pagination' => $pagination
                    ]);
                } elseif ($selectedType && $lovs && !$isSkillsView) {
                    $viewPath = 'super-admin.lov.category.single-row';
                    $rowsHtml = renderLovRows($lovs, $viewPath, $selectedType);
                    $pagination = view('components.pagination', ['items' => $lovs])->render();
                    return response()->json([
                        'success' => true,
                        'html' => $rowsHtml,
                        'pagination' => $pagination
                    ]);
                }
            }

            // Normal page load
            $viewPath = $this->getCategoryViewPath($category);
            return view($viewPath, compact('lovs', 'skills', 'lovTypes', 'category', 'selectedType', 'isSkillsView'));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->failure($exception->getMessage(), $exception->getStatusCode());
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $type)
    {
        try {
            $lovs = $this->lovService->getLovsByType($request, $type);

            if ($request->ajax()) {
                $rows = '';
                $rowsHtml = renderLovRows($lovs, 'super-admin.lov.level.single-level-row', $type);
                $pagination = view('components.pagination', ['items' => $lovs])->render();
                return response()->json([
                    'success' => true,
                    'html' => $rowsHtml,
                    'pagination' => $pagination
                ]);
            }

            // Normal page load
            return view('super-admin.lov.level.index', compact('lovs', 'type'));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->failure($exception->getMessage(), $exception->getStatusCode());
        }
    }

    /**
     * Get view path for category (now using single unified view)
     */
    private function getCategoryViewPath(string $category): string
    {
        return 'super-admin.lov.category.index';
    }

    /**
     * Get view path for category row (now using single unified view)
     */
    private function getViewPathForCategory(string $category): string
    {
        return 'super-admin.lov.category.single-row';
    }

    /**
     * Render skill rows (similar to SkillController)
     */
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

    /**
     * Show the signup-form for creating a new resource.
     */
    public function create(Request $request, $type)
    {

    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(LovRequest $request, $type)
    {
        try {
            $lov = $this->lovService->store($request, $type);
            
            // Get category from lov type
            $lovType = LovType::where('slug', $type)->first();
            $category = $lovType?->category ?? 'individual';
            
            // Use the same paginated method as the listing to maintain pagination state
            $lovs = $this->lovService->getLovsByCategoryAndType($request, $category, $type);
            
            $viewPath = 'super-admin.lov.category.single-row';
            $rowHtml = renderLovRows($lovs, $viewPath, $type);
            $pagination = view('components.pagination', ['items' => $lovs])->render();

            return response()->json([
                'success' => true,
                'html' => $rowHtml,
                'pagination' => $pagination,
                'lov' => $lov,
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->failure($exception->getMessage(), $exception->getStatusCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Lov $lov)
    {
        return response()->json([
            'lov' => $lov]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lov $lov)
    {
        try {
            // Handle status toggle update (AJAX from toggle switch)
            if ($request->has('status_id') || $request->has('is_active')) {
                $status = $request->input('status_id') ?? $request->input('is_active');
                $lov->is_active = $status;
                $lov->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Status updated successfully',
                    'lov' => $lov
                ]);
            }

            // Handle regular form update
            $lovRequest = LovRequest::createFrom($request);
            $lovRequest->setContainer(app());
            $lovRequest->validateResolved();

            $lov = $this->lovService->update($lovRequest, $lov);
            $lovs = Lov::ofType($lov->lovType->slug)->orderBy('id', 'DESC')->get();

            // Get category from lov type
            $category = $lov->lovType->category ?? 'individual';
            $viewPath = 'super-admin.lov.category.single-row';
            
            // ✅ Row update HTML
            $rowHtml = renderLovRows($lovs, $viewPath, $lov->lovType->slug);

            return response()->json([
                'success' => true,
                'lov' => $lov,
                'html' => $rowHtml,
            ]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->failure($exception->getMessage(), $exception->getStatusCode());
        }
    }
    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Lov $lov)
    {
        try {
            $lov->delete();
            return response()->json(['success' => true]);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->failure($exception->getMessage(), $exception->getStatusCode());
        }
    }
}

function renderLovRows($lovs, $view = 'super-admin.lov.level.single-level-row', $type = null)
{
    $rows = '';
    $serialNumber = $lovs instanceof \Illuminate\Pagination\LengthAwarePaginator ? $lovs->firstItem() : 1;

    foreach ($lovs as $index => $lov) {
        $rows .= view($view, [
            'lov' => $lov,
            'serialNumber' => $serialNumber + $index,
            'type' => $type
        ])->render();
    }

    return $rows;
}
