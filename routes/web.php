<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['web']], function () {
    Route::view('admin', 'admin.dashboard.index')->name('admin.dash');
    Route::resource('users', 'UserController');
    Route::resource('calendar/events', 'EventController');
    Route::resource('calendar', 'CalendarController');
    Route::view('calendario', 'calendar.calendar');
});
