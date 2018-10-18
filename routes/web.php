<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::view('admin', 'admin.dashboard.index')->name('admin.dash');
    Route::resource('users', 'UserController');
    Route::resource('events', 'EventController');
    Route::resource('calendar/events', 'CalendarController', ['only' => [
        'index', 'store', 'update'
    ]]);
    Route::view('calendar', 'calendar.calendar')->name('calendar');
});
