<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $regions = Region::all();

        return view('regions.index', compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('regions.create');
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
            'name' => 'required|string',
            'code' => 'required|string|unique:regions,code',
        ]);

        (new Region)->create([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
        ]);

        return redirect()->route('regions.index')->with('success', '区域创建成功。');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Region $region
     *
     * @return View
     */
    public function edit(Region $region): View
    {
        return view('regions.edit', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Region  $region
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Region $region): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string',
            'code' => 'required|string|unique:regions,code,' . $region->id,
        ]);

        $region->update([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
        ]);

        return redirect()->back()->with('success', '区域更新成功。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Region $region
     *
     * @return RedirectResponse
     */
    public function destroy(Region $region): RedirectResponse
    {
        //

        $region->delete();

        return redirect()->route('regions.index')->with('success', '区域删除成功。');
    }
}
