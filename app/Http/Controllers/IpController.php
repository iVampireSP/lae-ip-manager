<?php

namespace App\Http\Controllers;

use App\Models\Ip;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Exceptions\HostActionException;

class IpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return View
     */
    public function index(Request $request): View
    {
        $ip = Ip::query();

        // 根据任意字段搜索
        foreach ($request->all() as $field) {
            if ($request->has($field)) {
                $ip->where($field, 'like', '%' . $request->input($field) . '%');
            }
        }

        $ips = $ip->with('pool')->paginate(100)->withQueryString();

        return view('ips.index', compact('ips'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Ip $ip
     *
     * @return View
     */
    public function edit(Ip $ip): View
    {
        return view('ips.edit', compact('ip'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Ip      $ip
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Ip $ip): RedirectResponse
    {
        $req = $request->only(['mac', 'hostname', 'description', 'host_id', 'blocked', 'module_id', 'user_id']);

        $ip->update($req);

        return redirect()->back()->with('success', 'IP 地址更新成功。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Ip $ip
     *
     * @return RedirectResponse
     */
    public function destroy(Ip $ip): RedirectResponse
    {
        $ip->release();

        return redirect()->back()->with('success', '清除成功。');
    }
}
