<?php

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', 'RoleController');
    Route::resource('contingencies', 'ContingencyController');
    Route::resource('colonies', 'ColonyController');
    Route::resource('priorities', 'PriorityController');
    Route::resource('unities', 'UnityController');
    Route::resource('activities', 'ActivityController');
    Route::resource('users', 'UserController');
    Route::resource('events', 'EventController');
    Route::post('events/{event}/close', 'EventController@close')->name('events.close');

    Route::view('admin', 'admin.dashboard.index')->name('admin.dash');

    Route::group(['prefix' => 'calendar', 'as' => 'calendar.'], function () {
        Route::get('/', 'CalendarController@calendar')->name('calendar');
        Route::get('show', 'CalendarController@show')->name('show');
        Route::get('logistics', 'CalendarController@logistics')->name('logistics');

        Route::post('{event}/close', 'CalendarController@close')->name('close');
        Route::post('{event}/schelude', 'CalendarController@schelude')->name('schelude');
        Route::post('{event}/reject', 'CalendarController@reject')->name('reject');
        Route::resource('events', 'CalendarController', ['except' => [
            'create', 'show', 'edit',
        ]]);

        Route::get('events/delete-btn/{event}', 'CalendarController@deleteBtn')->name('delete-btn');
    });
});
