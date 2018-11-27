<?php

namespace Calendario\Http\Controllers;

use Illuminate\Http\Request;
use Calendario\Contingency;

class ContingencyController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:contingencies.index')->only('index');
        $this->middleware('permission:contingencies.create')->only(['create', 'store']);
        $this->middleware('permission:contingencies.edit')->only(['edit', 'update']);
        $this->middleware('permission:contingencies.show')->only('show');
        $this->middleware('permission:contingencies.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contingencies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contingencies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Contingency::rules());

        $contingency = Contingency::create($request->all());

        return back()->withSuccess(__('app.success_store'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contingency  $contingency
     * @return \Illuminate\Http\Response
     */
    public function show(Contingency $contingency)
    {
        return view('contingencies.show', compact('contingency'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contingency  $contingency
     * @return \Illuminate\Http\Response
     */
    public function edit(Contingency $contingency)
    {
        return view('contingencies.edit', compact('contingency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contingency  $contingency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contingency $contingency)
    {
        $this->validate($request, Contingency::rules());
        
        $contingency->update($request->all());

        return redirect()->route('contingencies.index')->withSuccess(__('app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contingency  $contingency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contingency $contingency)
    {
        $contingency->delete();

        return back()->withSuccess(__('app.success_destroy'));
    }
}
