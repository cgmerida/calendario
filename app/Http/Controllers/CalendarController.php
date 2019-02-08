<?php

namespace Calendario\Http\Controllers;

use Calendario\Colony;
use Calendario\Contingency;
use Calendario\Event;
use Calendario\Unity;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:events.index')->only('calendar');
        $this->middleware('permission:events.create')->only('store');
        $this->middleware('permission:events.edit')->only('update');
        $this->middleware('permission:calendar.show')->only('show');
        $this->middleware('permission:events.destroy')->only('destroy');
    }

    public function calendar()
    {
        $unities = Unity::pluck('name', 'id')->prepend('Seleccione una unidad', "");

        $activities = ['' => 'Seleccione unidad'];

        $zones = Colony::pluck('zone', 'zone')->prepend('Seleccione una zona', "");

        $colonies = ['' => 'Seleccione zona'];

        $statuses = [
            "Realizado" => "Realizado",
            "No Realizado" => "No Realizado",
        ];

        $contingencies = Contingency::all();

        return view('calendar.calendar', compact(
            'unities', 'activities', 'zones',
            'colonies', 'statuses', 'contingencies'
        ));
    }

    public function show()
    {
        $unities = Unity::pluck('name', 'id')->prepend('Seleccione una unidad', "");

        $activities = ['' => 'Seleccione unidad'];

        $zones = Colony::pluck('zone', 'zone')->prepend('Seleccione una zona', "");

        $colonies = ['' => 'Seleccione zona'];

        return view('calendar.show', compact('unities', 'activities', 'zones', 'colonies'));
    }

    public function logistics()
    {
        $unities = Unity::pluck('name', 'id')->prepend('Seleccione una unidad', "");

        $activities = ['' => 'Seleccione unidad'];

        $zones = Colony::pluck('zone', 'zone')->prepend('Seleccione una zona', "");

        $colonies = ['' => 'Seleccione zona'];

        return view('calendar.logistics', compact(
            'unities', 'activities', 'zones', 'colonies'
        ));
    }

    public function index(Request $request)
    {
        $events = null;

        if ($request->start && $request->end) {
            $events = Event::where('start', '>=', $request->start . ' 00:00:00')
                ->where('end', '<=', $request->end . ' 00:00:00');
        } else {
            $events = Event::select('*');
        }

        if (isset($request->logistics) && $request->logistics == true) {
            $events->whereLogistics(true);

            return $events->with(['colony', 'activity.unity'])->get()
                ->each(function ($event) {
                    $event->logisticMap = true;
                });
        }

        return $events->with(['colony', 'activity.unity'])->get();
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validacion = $this->validacion($data);
        if ($validacion) {
            return $validacion;
        }

        $event = Event::create($data);

        $event->activity->unity;

        return response()->json([
            'message' => 'Se ha creado correctamente',
            'event' => $event,
            'status' => 'ok',
        ]);
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->all();

        $validacion = $this->validacion($data);
        if ($validacion) {
            return $validacion;
        }

        $event->update($data);

        $event->activity->unity;

        return response()->json([
            'message' => 'Se ha actualizado correctamente',
            'event' => $event,
            'status' => 'ok',
        ]);
    }

    public function close(Request $request, Event $event)
    {
        $event->status = $request->status;

        $event->response = $request->response;

        if (isset($request->attendance) && $request->attendance >= 1) {
            $event->attendance()->create(['attendance' => $request->attendance]);
        }

        $event->contingencies()->sync($request->contingencies);

        $event->save();

        $event->activity->unity;

        return response()->json([
            'message' => 'Se ha cerrado correctamente',
            'event' => $event,
            'status' => 'ok',
        ]);
    }

    public function schelude(Request $request, Event $event)
    {
        $event->status = "Agendado";

        $event->save();

        $event->activity->unity;

        $event->logisticMap = true;

        return response()->json([
            'message' => 'El evento se ha agendado correctamente',
            'event' => $event,
            'status' => 'ok',
        ]);
    }

    public function reject(Request $request, Event $event)
    {
        $event->status = "Rechazado";

        $event->save();

        $event->activity->unity;

        $event->logisticMap = true;

        return response()->json([
            'message' => 'El evento se ha rechazado correctamente',
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

    public function validacion(&$data)
    {
        //valida que tenga hora de inicio y hora de fin
        if (!$data['start'] || !$data['end']) {
            return response([
                'message' => 'Ingrese la hora de inicio y la hora de fin',
                'status' => 'bad',
            ]);
        }

        // Concatena la hora de inicio y la hora de fin a el día seleccionado en el calendario
        $data['start'] = date("Y-m-d H:i:s", strtotime($data['date']
            . " " . $data['start']));
        $data['end'] = date("Y-m-d H:i:s", strtotime($data['date']
            . " " . $data['end']));

        // Agrega al usuario que modifica o crea el evento
        $data['user_id'] = \Auth::id();

        // Valida toda la data
        $validator = \Validator::make($data, Event::rules());

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

        // Valida que los eventos no sean creados sino es con 15 días de anticipación.
        $diff = Carbon::parse(Carbon::now())->diffInDays($data['start']);

        if ($diff < 14) {
            return response()->json([
                'message' => 'El evento debe ser creado o modificado con al menos 15 días de anticipación',
                'status' => 'bad',
            ]);
        }

        // valida si require logistica la actividad y luego las reglas de logistica.
        if (isset($data['logistics']) && $data['logistics'] == true) {
            // Valida que los eventos no se sobre pongan
            $event_overlap = Event::whereRaw('? between start and end', [$data['start']])
                ->orWhereRaw('? between start and end', [$data['end']])
                ->where('logistics', 1)->count();

            if ($event_overlap >= 2) {
                return response()->json([
                    'message' => 'Solo se pueden atender 2 eventos en el mismo horario si TIENEN logistica.',
                    'status' => 'bad',
                ]);
            }

            $data['status'] = 'Pendiente';
        }
    }

    public function deleteBtn(Event $event)
    {
        return view('calendar.partials.delete-btn', compact('event'));
    }
}
