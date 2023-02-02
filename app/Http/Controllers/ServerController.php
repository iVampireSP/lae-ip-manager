<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        //
        $servers = (new Server)->simplePaginate(10);

        return view('servers.index', compact('servers'));
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
        //
        $request->validate([
            'name' => 'required',
            'fqdn' => 'required',
            'port' => 'required',
            'username' => 'nullable',
            'password' => 'nullable',
            'status' => 'required',
        ]);

        (new Server)->create($request->all());

        return redirect()->route('servers.index')->with('success', '服务器成功添加。');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        //
        return view('servers.create');
    }

    /**
     * Display the specified resource.
     *
     * @param Server $server
     *
     * @return Application|Factory|View
     */
    public function show(Server $server): View|Factory|Application
    {
        //
        return view('servers.show', compact('server'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Server $server
     *
     * @return Application|Factory|View
     */
    public function edit(Server $server): View|Factory|Application
    {
        //
        return view('servers.edit', compact('server'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Server  $server
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Server $server): RedirectResponse
    {
        //
        // $request->validate([
        //     'name' => 'required',
        //     'fqdn' => 'required',
        //     'port' => 'required',
        //     'status' => 'required',
        // ]);
        $server->update($request->all());

        return back()->with('success', '服务器成功更新。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Server $server
     *
     * @return RedirectResponse
     */
    public function destroy(Server $server): RedirectResponse
    {
        //
        $server->delete();

        return redirect()->route('servers.index')->with('success', '服务器成功删除。');
    }
}
