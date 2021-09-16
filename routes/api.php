<?php

use Illuminate\Support\Facades\Route;

//time
Route::get('time', function () {
    return date('Y-m-d H:i:s');
});

Route::get('test', function () {
    return \Illuminate\Support\Facades\App::environment();
});

Route::post('user', 'UserController@register');
Route::post('user/login', 'UserController@authenticate');
Route::get('open', 'DataController@open');

Route::post('coin', 'CoinController@store');

Route::resource('room-external', 'External\RoomController', ['only' => ['index']])->middleware('external');
Route::resource('schedule-external', 'External\ScheduleController', ['only' => ['store']])->middleware('external');

Route::group(['middleware' => ['jwt.verify', 'throttle:300,1']], function () {
    Route::get('user', 'UserController@getAuthenticatedUser');
    Route::get('user/{id}', 'UserController@show');
    Route::post('user/locale', 'UserController@locale');

    Route::get('closed', 'DataController@closed');

    Route::resource('company', 'CompanyController', ['only' => ['index', 'show', 'store', 'update', 'delete'], 'parameters' => ['company' => 'id']]);
    Route::resource('room', 'RoomController', ['only' => ['index', 'show', 'store', 'update', 'destroy'], 'parameters' => ['weather' => 'id']]);
    Route::resource('schedule', 'ScheduleController', ['only' => ['index', 'show', 'store', 'update', 'destroy'], 'parameters' => ['schedule' => 'id']]);
    Route::resource('timetable', 'TimetableController', ['only' => ['index', 'store', 'update', 'destroy'], 'parameters' => ['timetable' => 'id']]);
    Route::resource('info', 'InfoController', ['only' => ['index', 'show', 'store', 'update', 'destroy'], 'parameters' => ['info' => 'id']]);

});
