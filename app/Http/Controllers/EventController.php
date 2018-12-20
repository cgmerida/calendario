<?php

namespace Calendario\Http\Controllers;

use Calendario\Activity;
use Calendario\Colony;
use Calendario\Event;
use Calendario\Unity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Calendario\Contingency;
use Calendario\Attendance;

class EventController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:events.index')->only('index');
        $this->middleware('permission:events.create')->only(['create', 'store']);
        $this->middleware('permission:events.edit')->only(['edit', 'update']);
        $this->middleware('permission:events.show')->only('show');
        $this->middleware('permission:events.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = [
            "Pendiente" => "Pendiente",
            "Agendado" => "Agendado",
            "Realizado" => "Realizado",
            "Rechazado" => "Rechazado",
            "No Realizado" => "No Realizado",
        ];
        $contingencies = Contingency::all();

        return view('events.index', compact('statuses', 'contingencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unities = Unity::pluck('name', 'id')->prepend('Seleccione una unidad', "");

        $activities = [0 => 'Seleccione unidad'];

        $zones = Colony::orderBy('zone', 'asc')->pluck('zone', 'zone')
            ->prepend('Seleccione una zona', "");

        $colonies = [0 => 'Seleccione zona'];

        return view('events.create', compact('unities', 'activities', 'zones', 'colonies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $this->validacion($request);

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
        $unities = Unity::pluck('name', 'id');

        $activities = $event->activity()->pluck('name', 'id');

        $zones = Colony::pluck('zone', 'zone');

        $colonies = $event->colony()->pluck('name', 'id');

        $event->unity_id = $event->activity->unity_id;

        $event->zone = $event->colony->zone;

        return view('events.show', compact('event', 'unities', 'activities', 'zones', 'colonies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Calendario\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $unities = Unity::pluck('name', 'id');

        $activities = $event->activity()->pluck('name', 'id');

        $zones = Colony::pluck('zone', 'zone');

        $colonies = $event->colony()->pluck('name', 'id');

        $event->unity_id = $event->activity->unity_id;

        $event->zone = $event->colony->zone;

        return view('events.edit', compact('event', 'unities', 'activities', 'zones', 'colonies'));
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

        $this->validacion($requestData);

        $event->update($requestData);

        return redirect()->route('events.index')->withSuccess(trans('app.success_update'));
    }

    /**
     * Cierra el evento guardando el estatus, la respuesta y las contingencias.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Calendario\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function close(Request $request, Event $event)
    {
        $event->status = $request->status;
        
        $event->response = $request->response;

        if($request->attendance && $request->attendance >= 1){
            $event->attendance()->create(['attendance' => $request->attendance]);
        }

        $event->contingencies()->sync($request->contingencies);

        $event->save();

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

    private function validacion($request)
    {
        $this->validate($request, Event::rules());

        $requestData = $request->all();
        $requestData['start'] .= ':00';
        $requestData['end'] .= ':00';
        $requestData['user_id'] = \Auth::id();

        $event_overlap = Event::where('start', '<', $requestData['start'])
            ->where('end', '>', $requestData['end'])->first();

        if ($event_overlap) {
        }

        // Valida que los eventos no se sobre pongan
        $event_overlap = Event::whereRaw('? between start and end', [$requestData['start']])
            ->orWhereRaw('? between start and end', [$requestData['end']])->count();

        if ($event_overlap >= 2) {
            return back()->withErrors(['start' => 'Solo se pueden atender 2 eventos en el mismo horario'])
                ->withInput();
        }

        // Valida que los eventos no sean creados sino es con 5 días de anticipación.
        $diff = Carbon::parse(Carbon::now())->diffInDays($requestData['start']);

        if ($diff < 4) {
            return back()->withErrors(['start' => 'El evento debe ser creado con al menos 5 días de anticipación'])
                ->withInput();
        }

        return $requestData;
    }
}
