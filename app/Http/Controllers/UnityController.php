<?php

namespace Calendario\Http\Controllers;

use Calendario\Unity;
use Illuminate\Http\Request;

class UnityController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:unities.index')->only('index');
        $this->middleware('permission:unities.create')->only(['create', 'store']);
        $this->middleware('permission:unities.edit')->only(['edit', 'update']);
        $this->middleware('permission:unities.show')->only('show');
        $this->middleware('permission:unities.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('unities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Unity::rules());

        $unity = Unity::create($request->all());

        return back()->withSuccess(__('app.success_store'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unity  $unity
     * @return \Illuminate\Http\Response
     */
    public function show(Unity $unity)
    {
        return view('unities.show', compact('unity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unity  $unity
     * @return \Illuminate\Http\Response
     */
    public function edit(Unity $unity)
    {
        return view('unities.edit', compact('unity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unity  $unity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unity $unity)
    {
        $this->validate($request, Unity::rules());

        $unity->update($request->all());

        return redirect()->route('unities.index')->withSuccess(__('app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unity  $unity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unity $unity)
    {
        $unity->delete();

        return back()->withSuccess(__('app.success_destroy'));
    }
}
