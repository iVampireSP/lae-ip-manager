<?php

namespace App\Http\Controllers\Remote\Functions;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    //

    public function __invoke()
    {
        $regions = Region::with('pools')->get();

        return $this->success($regions);
    }
}
