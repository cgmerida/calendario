<?php

namespace Calendario\Http\Controllers;

use Calendario\Activity;
use Calendario\Unity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:activities.index')->only('index');
        $this->middleware('permission:activities.create')->only(['create', 'store']);
        $this->middleware('permission:activities.edit')->only(['edit', 'update']);
        $this->middleware('permission:activities.show')->only('show');
        $this->middleware('permission:activities.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('activities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unities = Unity::pluck('name', 'id');
        return view('activities.create', compact('unities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $activity = Activity::create($request->all());
        return back()->withSuccess(__('app.success_store'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        $unities = Unity::pluck('name', 'id');
        return view('activities.show', compact('activity', 'unities'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        $unities = Unity::pluck('name', 'id');
        return view('activities.edit', compact('activity', 'unities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        $activity->update($request->all());
        return redirect()->route('activities.index')->withSuccess(__('app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();

        return back()->withSuccess(__('app.success_destroy'));
    }
}
