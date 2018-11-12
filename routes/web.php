<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::view('admin', 'admin.dashboard.index')->name('admin.dash');
    Route::resource('users', 'UserController');
    Route::resource('events', 'EventController');

    Route::group(['prefix' => 'calendar', 'as' => 'calendar.'], function () {
        Route::resource('events', 'CalendarController', ['except' => [
            'create', 'show', 'edit',
        ]]);
        Route::get('events/delete-btn/{event}', 'CalendarController@deleteBtn')->name('delete-btn');
    });
    Route::view('calendar', 'calendar.calendar')->name('calendar');
});
