<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/admin', 'DashboardController@index')->name('admin.dash');
    Route::resource('users', 'UserController');
    Route::resource('events', 'EventController');
});