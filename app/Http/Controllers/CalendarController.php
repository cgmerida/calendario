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
        $validate = $this->validate($request, Event::rules());

        $errors = $validate->errors();
        if($errors){
            return JSON.parse($errors);
        }

        Event::create($requestData);

        // return back()->withSuccess(trans('app.success_store'));
        return response()->json([
            'message' => 'Se ha creado correctamente',
            'status' => 'ok',
            'code' => 200
        ]);
    }
}
