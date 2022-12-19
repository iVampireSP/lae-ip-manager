<?php

namespace App\Http\Controllers\Remote\Exports;

use App\Http\Controllers\Controller;
use App\Models\Host;
use Illuminate\Http\Request;

class HostController extends Controller
{

    public function index(Request $request)
    {
        $hosts = Host::thisUser($request->user_id)->with('ip')->get();
        return $this->success($hosts);
    }

    public function update(Request $request, Host $host)
    {
        $host->load('ip');

        $from_module = $request->header('X-Module');

        $host->ip->module_id = $from_module;
        $host->ip->module_host_id = $request->module_host_id;
        $host->ip->mac = $request->mac;
        $host->ip->hostname = $request->hostname;
        $host->ip->description = $request->description;

        $host->ip->save();

        return $this->success($host);
    }

    public function destroy(Host $host)
    {
        $host->load('ip');

        $host->ip->module_id = null;
        $host->ip->module_host_id = null;
        $host->ip->mac = null;
        $host->ip->hostname = null;
        $host->ip->description = null;

        $host->ip->save();

        return $this->success();
    }
}
