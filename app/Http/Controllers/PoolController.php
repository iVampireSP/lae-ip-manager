<?php

namespace App\Http\Controllers;

use PhpIP\IPBlock;
use App\Models\Pool;
use App\Models\Region;
use App\Jobs\GenerateIpJob;
use Illuminate\Http\Request;
use InvalidArgumentException;
use App\Exceptions\IpException;

class PoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pools = Pool::with('region')->get();

        return view('pools.index', compact('pools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = Region::all();

        return view('pools.create', compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'pool' => 'required|string|unique:pools,pool|max:255',
            'gateway' => 'string|max:255|ip',
            'region_id' => 'required|integer|exists:regions,id',
            'nameservers' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0'
        ]);

        try {
            $ip = $this->validateIp($request->pool, $request->gateway, $request->nameservers);
        } catch (IpException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }


        Pool::create([
            'pool' => $request->pool,
            'netmask' => $ip['netmask'],
            'cidr' => $ip['cidr'],
            'gateway' => $request->gateway,
            'region_id' => $request->region_id,
            'nameservers' => $ip['nameservers'],
            'description' => $request->description,
            'type' => $ip['type'],
            'price' => $request->price,
        ]);

        return redirect()->route('pools.index')->with('success', '地址池创建成功。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pool  $pool
     * @return \Illuminate\Http\Response
     */
    public function show(Pool $pool)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pool  $pool
     * @return \Illuminate\Http\Response
     */
    public function edit(Pool $pool)
    {
        //

        $regions = Region::all();

        return view('pools.edit', compact('regions', 'pool'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pool  $pool
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pool $pool)
    {
        //

        $request->validate([
            'pool' => 'required|string|unique:pools,pool,' . $pool->id . '|max:255',
            'gateway' => 'string|max:255|ip',
            'region_id' => 'required|integer|exists:regions,id',
            'nameservers' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0'
        ]);

        try {
            $ip = $this->validateIp($request->pool, $request->gateway, $request->nameservers);
        } catch (IpException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }


        $pool->update([
            'pool' => $request->pool,
            'netmask' => $ip['netmask'],
            'cidr' => $ip['cidr'],
            'gateway' => $request->gateway,
            'region_id' => $request->region_id,
            'nameservers' => $ip['nameservers'],
            'description' => $request->description,
            'type' => $ip['type'],
            'price' => $request->price,
        ]);

        return redirect()->route('pools.index')->with('success', '地址池更新成功。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pool  $pool
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pool $pool)
    {
        //
    }


    public function validateIp($pool, $gateway, string|array|null $nameservers = [])
    {
        // 检测是否是合法的IP/CIDR地址格式

        try {
            $block = IPBlock::create($pool);
        } catch (InvalidArgumentException) {
            throw new IpException('无法识别的 IP/CIDR 地址。');
        }

        $version = $block->getVersion();

        if ($version === 4) {
            $type = 'ipv4';
        } elseif ($version === 6) {
            $type = 'ipv6';
        } else {
            throw new IpException('无法检测到 IP 版本。');
        }

        if (!$block->containsIP($gateway)) {
            throw new IpException('网关地址不在地址池内。');
        }

        if ($nameservers) {
            if (is_string($nameservers)) {
                $nameservers = explode(PHP_EOL, $nameservers);
            }
        }

        $cidr = explode('/', $pool)[1];

        return [
            'block' => $block,
            'type' => $type,
            'nameservers' => $nameservers,
            'netmask' => $block->getMask()->humanReadable(true),
            'cidr' => $cidr,
        ];
    }


    public function show_generate(Pool $pool)
    {
        return view('pools.generate', compact('pool'));
    }

    public function run_generate(Request $request, Pool $pool)
    {
        $request->validate(['count' => 'required|integer|min:1|max:1000']);

        dispatch(new GenerateIpJob($pool, $request->count));

        return redirect()->route('ips.index')->with('success', "正在后台生成 {$request->count} 个 在此子网内的 IP 地址。");
    }
}
