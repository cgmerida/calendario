<?php

use Carbon\Carbon;
use Illuminate\Http\Request;

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

Route::get('roles', function () {
    return datatables(Caffeinated\Shinobi\Models\Role::latest('updated_at')->get())
        ->addColumn('actions', 'roles.partials.actions')
        ->rawColumns(['actions'])
        ->toJson();
});

Route::get('colonies', function () {
    return datatables(Calendario\Colony::latest('updated_at')->get())
        ->addColumn('actions', 'colonies.partials.actions')
        ->rawColumns(['actions'])
        ->toJson();
});

Route::get('contingencies', function () {
    return datatables(Calendario\Contingency::latest('updated_at')->get())
        ->addColumn('actions', 'contingencies.partials.actions')
        ->rawColumns(['actions'])
        ->toJson();
});

Route::get('unities', function () {
    return datatables(Calendario\Unity::latest('updated_at')->get())
        ->addColumn('actions', 'unities.partials.actions')
        ->rawColumns(['actions'])
        ->toJson();
});

Route::get('activities', function () {
    return datatables(Calendario\Activity::latest('updated_at')->with('unity')->get())
        ->addColumn('actions', 'activities.partials.actions')
        ->rawColumns(['actions'])
        ->toJson();
});

Route::get('users', function () {
    return datatables(Calendario\User::latest('updated_at')->get())
        ->addColumn('actions', 'users.partials.actions')
        ->rawColumns(['actions'])
        ->toJson();
});

Route::get('events', function () {
    return datatables(Calendario\Event::all())
        ->addColumn('actions', 'events.partials.actions')
        ->editColumn('start', function ($events) {
            return $events->start ? with(new Carbon($events->start))->format('d/m/Y H:i:s') : '';
        })
        ->editColumn('end', function ($events) {
            return $events->end ? with(new Carbon($events->end))->format('d/m/Y H:i:s') : '';
        })
        ->rawColumns(['actions'])
        ->make(true);
});
