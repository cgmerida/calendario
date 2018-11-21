<?php

namespace Calendario\Http\Controllers;

use Calendario\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $events = Event::all();
        return view('events.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->all();

        $validacion = $this->validacion($requestData);

        Event::create($requestData);

        return back()->withSuccess(trans('app.success_store'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Calendario\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Calendario\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Calendario\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $requestData = $request->all();

        $validacion = $this->validacion($requestData);
        
        $event->update($requestData);

        return redirect()->route('events.index')->withSuccess(trans('app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Calendario\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return back()->withSuccess(trans('app.success_destroy'));
    }

    private function validacion(&$requestData)
    {
        $this->validate($request, Event::rules());

        $requestData = $request->all();
        $requestData['start'] .= ':00';
        $requestData['end'] .= ':00';
        $requestData['user_id'] = \Auth::id();

        $event_overlap = Event::where('start', '<', $requestData['start'])
            ->where('end', '>', $requestData['end'])->first();

        if ($event_overlap) {
            return back()->withErrors(['start' => 'Ya existe un evento en este horario'])->withInput();
        }  
    }
}
