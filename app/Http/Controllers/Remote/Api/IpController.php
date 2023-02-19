<?php

namespace App\Http\Controllers\Remote\Api;

use App\Http\Controllers\Controller;
use App\Models\Ip;
use Illuminate\Http\JsonResponse;

class IpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $ips = Ip::where('user_id', auth('api')->id())->get();

        return $this->success($ips);
    }

    /**
     * Display the specified resource.
     *
     * @param Ip $ip
     *
     * @return JsonResponse
     */
    public function show(Ip $ip)
    {
        if ($ip->user_id != auth('api')->id()) {
            return $this->forbidden('你没有权限查看此 IP。');
        }

        return $this->success($ip);
    }
}
