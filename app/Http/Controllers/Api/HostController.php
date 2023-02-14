<?php

namespace App\Http\Controllers\Api;

use App\Actions\HostAction;
use App\Exceptions\HostActionException;
use App\Http\Controllers\Controller;
use App\Models\Host;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HostController extends Controller
{
    public function index(): JsonResponse
    {
        // dd($request);
        $hosts = (new Host)->thisUser()->get();
        return $this->success($hosts);
    }

    /**
     * @throws HostActionException
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'pool_id' => 'required|integer|exists:pools,id',
        ]);

        $hostAction = new HostAction();

        $host = $hostAction->create($request->all());

        return $this->created($host);
    }

    public function show(Host $host): JsonResponse
    {
        $this->isUser($host);

        return $this->success($host);
    }

    public function isUser(Host $host)
    {
        // return $host->user_id == Auth::id();

        if (auth('api')->id() !== null) {
            if ($host->user_id !=auth('api')->id()) {
                abort(403);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Host    $host
     *
     * @return JsonResponse
     */
    public function update(Request $request, Host $host): JsonResponse
    {
        $this->isUser($host);

        // 排除 request 中的一些参数
        $request_only = $request->except(['id', 'user_id', 'host_id', 'price', 'managed_price', 'suspended_at', 'created_at', 'updated_at']);

        $hostAction = new HostAction();

        $host = $hostAction->update($host, $request_only);

        return $this->updated($host);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Host $host
     *
     * @return JsonResponse
     */
    public function destroy(Host $host): JsonResponse
    {
        $this->isUser($host);

        // 具体删除逻辑
        $hostAction = new HostAction();

        try {
            $hostAction->destroy($host);
        } catch (HostActionException $e) {
            $this->error($e->getMessage());
        }

        return $this->deleted($host);
    }
}
