<?php

namespace App\Http\Controllers\Remote\Exports;

use App\Http\Controllers\Controller;
use App\Models\Ip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class IpController extends Controller
{
    public function index()
    {
        $ips = Ip::where('blocked', false)->paginate();

        return $this->success($ips);
    }

    public function show(Ip $ip)
    {
        return $this->success($ip);
    }

    public function next(Request $request)
    {
        return Cache::lock('ip.next', 5)->block(5, function () use ($request) {
            if ($request->method() === 'GET') {
                $ip = Ip::available()->first();

                if (!$ip) {
                    return $this->error('No available IP.');
                }

                return $this->success($ip);
            } else if ($request->method() === 'POST') {
                $module_id = $request->header('X-Module');

                if (!$module_id) {
                    return $this->error('X-Module header is required.');
                }

                $ip = Ip::available()->first();

                if (!$ip) {
                    return $this->error('No available IP.');
                }

                $update = [
                    'module_id' => $request->header('X-Module'),

                ];

                $update = array_merge($update, $request->all());

                $ip->update($update);

                return $this->success($ip);
            }

            return $this->error('Method not allowed.');
        });

    }
}
