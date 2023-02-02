<?php

namespace App\Http\Controllers\Remote\Exports;

use App\Http\Controllers\Controller;
use App\Models\Host;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HostController extends Controller
{

    public function index(Request $request): JsonResponse
    {
        $hosts = Host::with('ip');

        foreach ($request->only(['id', 'region_id', 'user_id', 'host_id', 'status']) as $field) {
            if ($request->has($field)) {
                $hosts->where($field, 'like', '%' . $request->input($field) . '%');
            }
        }

        $hosts = $hosts->get();

        return $this->success($hosts);
    }

    public function update(Request $request, Host $host): JsonResponse
    {
        $request->validate([
            'mac' => 'string|max:255',
            'description' => 'string|max:255',
            'hostname' => 'string|max:255',
            'module_host_id' => 'integer',
        ]);

        $host->load('ip');

        $from_module = $request->header('X-Module');

        $host->ip->module_id = $from_module;
        $host->ip->module_host_id = $request->input('module_host_id');
        $host->ip->mac = $request->input('mac');
        $host->ip->hostname = $request->input('hostname');
        $host->ip->description = $request->input('description');

        $host->ip->save();

        return $this->success($host);
    }

    public function destroy(Host $host): JsonResponse
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
