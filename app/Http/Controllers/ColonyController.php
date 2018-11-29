<?php

namespace Calendario\Http\Controllers;

use Illuminate\Http\Request;
use Calendario\Colony;

class ColonyController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:colonies.index')->only('index');
        $this->middleware('permission:colonies.create')->only(['create', 'store']);
        $this->middleware('permission:colonies.edit')->only(['edit', 'update']);
        $this->middleware('permission:colonies.show')->only('show');
        $this->middleware('permission:colonies.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('colonies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('colonies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Colony::rules());

        $colony = Colony::create($request->all());

        return back()->withSuccess(__('app.success_store'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Colony  $colony
     * @return \Illuminate\Http\Response
     */
    public function show(Colony $colony)
    {
        return view('colonies.show', compact('colony'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Colony  $colony
     * @return \Illuminate\Http\Response
     */
    public function edit(Colony $colony)
    {
        return view('colonies.edit', compact('colony'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Colony  $colony
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Colony $colony)
    {
        $this->validate($request, Colony::rules());
        
        $colony->update($request->all());

        return redirect()->route('colonies.index')->withSuccess(__('app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Colony  $colony
     * @return \Illuminate\Http\Response
     */
    public function destroy(Colony $colony)
    {
        $colony->delete();

        return back()->withSuccess(__('app.success_destroy'));
    }
}
