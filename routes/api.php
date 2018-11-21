<?php

use Illuminate\Http\Request;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('events', function () {
    return datatables(Calendario\Event::all())
        ->addColumn('btn', 'events.actions')
        ->editColumn('start', function ($events) {
            return $events->start ? with(new Carbon($events->start))->format('d/m/Y H:i:s') : '';
        })
        ->editColumn('end', function ($events) {
            return $events->end ? with(new Carbon($events->end))->format('d/m/Y H:i:s') : '';
        })
        ->rawColumns(['btn'])
        ->make(true);
});

Route::get('users', function () {
    return datatables(Calendario\User::latest('updated_at')->get())
        ->addColumn('btn', 'users.partials.actions')
        ->rawColumns(['btn'])
        ->toJson();
});