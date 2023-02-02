<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pool;
use Illuminate\Http\Request;

class PoolController extends Controller
{
    //

    public function __invoke(Request $request)
    {

        $pools = Pool::with('region');

        if ($request->filled('region_id')) {
            $pools->where('region_id', $request->region_id);
        }

        return $this->success($pools);
    }
}
