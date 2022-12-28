<?php

namespace App\Http\Controllers\Remote\Exports;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //

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
