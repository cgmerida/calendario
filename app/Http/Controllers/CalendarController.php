<?php

namespace Calendario\Http\Controllers;

use Calendario\Event;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return $events;
    }

    public function store(Request $request)
    {
        $requestData = $request->all();

        $validacion = $this->validacion($requestData);
        if($validacion){
            return $validacion;
        }

        $event = Event::create($requestData);

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
        if($validacion){
            return $validacion;
        }

        $event->update($requestData);

        return response()->json([
            'message' => 'Se ha actualizado correctamente',
            'event' => $event,
            'status' => 'ok',
        ]);
    }

    public function validacion(&$requestData)
    {
        if (!$requestData['start'] || !$requestData['end']) {
            return response([
                'message' => 'Ingrese la hora de inicio y la hora de fin',
                'status' => 'bad',
            ]);
        }

        $requestData['start'] = date("Y-m-d H:i:s", strtotime($requestData['date']
            . " " . $requestData['start']));
        $requestData['end'] = date("Y-m-d H:i:s", strtotime($requestData['date']
            . " " . $requestData['end']));

        $requestData['user_id'] = \Auth::id();

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
    }
}
