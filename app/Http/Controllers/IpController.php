<?php

namespace App\Http\Controllers;

use App\Models\Ip;
use Illuminate\Http\Request;

class IpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ip = Ip::query();

        // 根据任意字段搜索
        foreach ($request->all() as $field) {
            if ($request->has($field)) {
                $ip->where($field, 'like', '%' . $request->input($field) . '%');
            }
        }

        $ips = $ip->with('pool')->paginate(100);

        return view('ips.index', compact('ips'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ip  $ip
     * @return \Illuminate\Http\Response
     */
    public function show(Ip $ip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ip  $ip
     * @return \Illuminate\Http\Response
     */
    public function edit(Ip $ip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ip  $ip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ip $ip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ip  $ip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ip $ip)
    {
        //
    }
}
