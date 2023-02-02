<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\JsonResponse;

class RegionController extends Controller
{
    //

    public function __invoke(): JsonResponse
    {
        $regions = Region::with('pools')->get();

        return $this->success($regions);
    }
}
