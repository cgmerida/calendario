<?php

namespace Calendario\Http\Controllers;

use Calendario\Colony;
use Calendario\Event;
use Calendario\Unity;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function calendar()
    {
        $unities = Unity::pluck('name', 'id')->prepend('Seleccione una unidad', "");

        $activities = ['' => 'Seleccione unidad'];

        $zones = Colony::pluck('zone', 'zone')->prepend('Seleccione una zona', "");

        $colonies = ['' => 'Seleccione zona'];

        return view('calendar.calendar', compact('unities', 'activities', 'zones', 'colonies'));
    }

    public function index(Request $request)
    {
        $events = null;

        if ($request->start && $request->end) {
            $events = Event::where('start', '>=', $request->start . ' 00:00:00')
                ->where('end', '<=', $request->end . ' 00:00:00')
                ->with(['colony', 'activity.unity'])->get();
        } else {
            $events = Event::with(['colony', 'activity.unity'])->get();
        }
        return $events;
    }

    public function store(Request $request)
    {
        $requestData = $request->all();

        $validacion = $this->validacion($requestData);
        if ($validacion) {
            return $validacion;
        }

        $event = Event::create($requestData);

        $event->activity->unity;

        return response()->json([
            'message' => 'Se ha creado correctamente',
            'event' => $event,
            'status' => 'ok',
        ]);
    }

    public function update(Request $request, Event $event)
    {
        $requestData = $request->all();

        $validacion = $this->validacion($requestData);
        if ($validacion) {
            return $validacion;
        }

        $event->update($requestData);
        
        $event->activity->unity;

        return response()->json([
            'message' => 'Se ha actualizado correctamente',
            'event' => $event,
            'status' => 'ok',
        ]);
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return response()->json([
            'message' => 'Se elimino el evento',
            'status' => 'ok',
        ]);
    }

    public function validacion(&$requestData)
    {
        //valida que tenga hora de inicio y hora de fin
        if (!$requestData['start'] || !$requestData['end']) {
            return response([
                'message' => 'Ingrese la hora de inicio y la hora de fin',
                'status' => 'bad',
            ]);
        }

        // Concatena la hora de inicio y la hora de fin a el día seleccionado en el calendario
        $requestData['start'] = date("Y-m-d H:i:s", strtotime($requestData['date']
            . " " . $requestData['start']));
        $requestData['end'] = date("Y-m-d H:i:s", strtotime($requestData['date']
            . " " . $requestData['end']));

        // Agrega al usuario que modifica o crea el evento
        $requestData['user_id'] = \Auth::id();

        // Valida toda la data
        $validator = \Validator::make($requestData, Event::rules());

        $errors = $validator->errors();
        if ($validator->fails()) {
            return response([
                'message' => str_replace(
                    ['start', 'end'], ['inicio', 'fin'],
                    join('<br>', $errors->all())
                ),
                'status' => 'bad',
            ]);
        }

        // Valida que los eventos no se sobre pongan
        $event_overlap = Event::whereRaw('? between start and end', [$requestData['start']])
            ->orWhereRaw('? between start and end', [$requestData['end']])->count();

        if ($event_overlap == 2) {
            return response()->json([
                'message' => 'Solo se pueden atender 2 eventos en el mismo horario.',
                'status' => 'bad',
            ]);
        }

        // Valida que los eventos no sean creados sino es con 5 días de anticipación.
        $diff = Carbon::parse(Carbon::now())->diffInDays($requestData['start']);

        if ($diff < 4) {
            return response()->json([
                'message' => 'El evento debe ser creado con al menos 5 días de anticipación',
                'status' => 'bad',
            ]);
        }
    }

    public function deleteBtn(Event $event)
    {
        return view('calendar.partials.delete-btn', compact('event'));
    }
}
