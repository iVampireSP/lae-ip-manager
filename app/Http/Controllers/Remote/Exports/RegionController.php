<?php

namespace App\Http\Controllers\Remote\Exports;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $regions = Region::with('pools');

        foreach ($request->only(['id', 'region_id']) as $field) {
            if ($request->has($field)) {
                $regions->where($field, 'like', '%' . $request->input($field) . '%');
            }
        }

        $regions = $regions->get();

        return $this->success($regions);
    }
}
