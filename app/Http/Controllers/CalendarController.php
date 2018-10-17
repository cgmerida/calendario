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
        $requestData['start'] = $requestData['date'] . " " . $requestData['start']->format('H:i:s');
        $requestData['end'] = $requestData['date'] . " " . $requestData['end']->format('H:i:s');
        $validator = \Validator::make($requestData, Event::rules());

        $errors = $validator->errors();
        if ($errors) {
            return response([
                'message' => join('<br>', $errors->all()),
                'status' => 'bad',
            ]);
        }

        Event::create($requestData);

        // return back()->withSuccess(trans('app.success_store'));
        return response()->json([
            'message' => 'Se ha creado correctamente',
            'status' => 'ok',
        ]);
    }
}
