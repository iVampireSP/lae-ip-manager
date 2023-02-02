<?php

namespace App\Http\Controllers\Remote\Exports;

use App\Http\Controllers\Controller;
use App\Models\Pool;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PoolController extends Controller
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
        //

        $pools = Pool::with('region');

        foreach ($request->only(['id', 'region_id']) as $field) {
            if ($request->has($field)) {
                $pools->where($field, 'like', '%' . $request->input($field) . '%');
            }
        }

        $pools = $pools->get();

        return $this->success($pools);
    }
}
