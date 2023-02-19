<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $pools = Pool::with('region')->get();

        return view('pools.index', compact('pools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        $regions = Region::all();

        return view('pools.create', compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'pool' => 'required|string|unique:pools,pool|max:255',
            'gateway' => 'string|max:255|ip',
            'region_id' => 'required|integer|exists:regions,id',
            'nameservers' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        try {
            $ip = $this->validateIp($request->input('pool'), $request->input('gateway'), $request->input('nameservers'));
        } catch (IpException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }


        (new Pool)->create([
            'pool' => $request->input('pool'),
            'netmask' => $ip['netmask'],
            'cidr' => $ip['cidr'],
            'gateway' => $request->input('gateway'),
            'region_id' => $request->input('region_id'),
            'nameservers' => $ip['nameservers'],
            'description' => $request->input('description'),
            'type' => $ip['type'],
        ]);

        return redirect()->route('pools.index')->with('success', '地址池创建成功。');
    }

    /**
     * Display the specified resource.
     *
     * @param Pool $pool
     *
     * @return void
     */
    public function show(Pool $pool): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Pool $pool
     *
     * @return Application|Factory|View
     */
    public function edit(Pool $pool): View|Factory|Application
    {
        //

        $regions = Region::all();

        return view('pools.edit', compact('regions', 'pool'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Pool    $pool
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Pool $pool): RedirectResponse
    {
        //

        $request->validate([
            'pool' => 'required|string|unique:pools,pool,' . $pool->id . '|max:255',
            'gateway' => 'string|max:255|ip',
            'region_id' => 'required|integer|exists:regions,id',
            'nameservers' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        try {
            $ip = $this->validateIp($request->input('pool'), $request->input('gateway'), $request->input('nameservers'));
        } catch (IpException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }


        $pool->update([
            'pool' => $request->input('pool'),
            'netmask' => $ip['netmask'],
            'cidr' => $ip['cidr'],
            'gateway' => $request->input('gateway'),
            'region_id' => $request->input('region_id'),
            'nameservers' => $ip['nameservers'],
            'description' => $request->input('description'),
            'type' => $ip['type'],
        ]);

        return redirect()->route('pools.index')->with('success', '地址池更新成功。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Pool $pool
     *
     * @return RedirectResponse
     */
    public function destroy(Pool $pool): RedirectResponse
    {
        $count = $pool->ips()->count();

        if ($count > 0) {
            return redirect()->back()->with('error', '这个地址池中还有 ' . $count . ' 个 IP 地址，无法删除。');
        }

        return redirect()->route('pools.index')->with('success', '地址池删除成功。');
    }


    /**
     * @throws IpException
     */
    public function validateIp($pool, $gateway, string|array|null $nameservers = []): array
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
            'netmask' => $block->getMask()->humanReadable(),
            'cidr' => $cidr,
        ];
    }


    public function show_generate(Pool $pool): Factory|View|Application
    {
        return view('pools.generate', compact('pool'));
    }

    public function run_generate(Request $request, Pool $pool): RedirectResponse
    {
        $request->validate(['count' => 'required|integer|min:1|max:1000']);

        dispatch(new GenerateIpJob($pool, $request->input('count')));

        return redirect()->route('ips.index')->with('success', "正在后台生成 {$request->input('count')} 个 在此子网内的 IP 地址。");
    }
}
