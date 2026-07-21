<?php

namespace App\Services;

use App\Models\CoworkingSpace;

class CoworkingSpaceService
{
    public function listing($request)
    {
        $records = $request->per_page ?? 10;
        $sortBy = $request->sort_by ?? 'id';
        $sortOrder = $request->sort_order ?? 'desc';

        return CoworkingSpace::applyFilter($request)
            ->orderBy($sortBy, $sortOrder)
            ->paginate($records)
            ->withQueryString();
    }

}
