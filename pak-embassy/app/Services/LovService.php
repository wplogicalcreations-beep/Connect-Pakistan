<?php
//
//namespace App\Services;
//
//use App\Models\Lov;
//use App\Models\LovType;
//use Illuminate\Support\Str;
//use Illuminate\Http\Request;
//
//class LovService {
//
//    public function getLovsByType($request, $type)
//    {
//        $records = $request->records ?? 10;
//        $lovs = Lov::orderBy('id','DESC')->ofType($type)->paginate($records)->withQueryString();;
//        return $lovs;
//    }
//
//    public function store($request, $type)
//    {
//        $slug = Str::slug( $request->name);
//        $typeId = LovType::idFromSlug($type);
//        $lov = Lov::create(array_merge(
//            $request->all(),
//            [
//                'slug' => $slug,
//                'lov_type_id' => $typeId,
//            ]
//        ));
//        return $lov;
//    }
//
//    public function update($request, $lov)
//    {
//        $slug = Str::slug( $request->name);
//        $lov->update(array_merge($request->all(),
//            [
//                'slug' => $slug
//            ]));
//        $lov->save();
//        return $lov;
//    }
//
//}


namespace App\Services;

use App\Models\Lov;
use App\Models\LovType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class LovService
{

    /**
     * Get LOVs by type with pagination
     */
    public function getLovsByType($request, $type)
    {
        $records = $request->per_page ?? 10;
        $sortBy = $request->sort_by ?? 'id';
        $sortOrder = $request->sort_order ?? 'desc';

        return Lov::ofType($type)
            ->applyFilter($request)
            ->orderBy($sortBy, $sortOrder)
            ->paginate($records)
            ->withQueryString();
    }

    /**
     * Get all LOV types for a specific category
     */
    public function getLovTypesByCategory(string $category)
    {
        return LovType::byCategory($category)->orderBy('name')->get();
    }

    /**
     * Get LOVs by category and type
     */
    public function getLovsByCategoryAndType($request, string $category, string $type)
    {
        $records = $request->per_page ?? 10;
        $sortBy = $request->sort_by ?? 'id';
        $sortOrder = $request->sort_order ?? 'desc';

        // Verify that the type belongs to the category
        $lovType = LovType::where('slug', $type)
            ->where('category', $category)
            ->first();

        if (!$lovType) {
            throw new \Exception("LOV type '{$type}' not found in category '{$category}'");
        }

        return Lov::ofType($type)
            ->applyFilter($request)
            ->orderBy($sortBy, $sortOrder)
            ->paginate($records)
            ->withQueryString();
    }

    /**
     * Filter LOVs + Pagination
     */
    public function filterAndPaginate($request, $type)
    {
        $records = $request->records ?? 10;

        $query = Lov::ofType($type);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return $query->orderBy('id', 'DESC')
            ->paginate($records)
            ->withQueryString();
    }

    /**
     * Store new LOV
     */
    public function store($request, $type)
    {
        $slug = Str::slug($request->name);
        $typeId = LovType::idFromSlug($type);

        return Lov::create(array_merge(
            $request->all(),
            [
                'slug' => $slug,
                'lov_type_id' => $typeId,
            ]
        ));
    }

    /**
     * Update LOV
     */
    public function update($request, $lov)
    {
        $slug = Str::slug($request->name);

        $lov->update(array_merge(
            $request->all(),
            [
                'slug' => $slug
            ]
        ));

        return $lov;
    }

    /**
     * Delete LOV
     */
    public function delete($lov)
    {
        return $lov->delete();
    }
}
