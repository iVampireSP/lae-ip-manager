<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Region;

class RegionController extends Controller
{
    //

    public function __invoke()
    {
        $regions = Region::with('pools')->get();

        return $this->success($regions);
    }
}
