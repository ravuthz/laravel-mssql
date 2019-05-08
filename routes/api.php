<?php

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

// Route::get('/', function () {
//     return ['api' => 'ok'];
// });

// Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');

// Route::group(['middleware' => 'has.code'], function () {
//     Route::apiResource('rooms', 'RoomController');
//     Route::apiResource('schedules', 'ScheduleController');
// });

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('schedules', 'ScheduleController@index');
// Route::get('schedules/{id}', 'ScheduleController@show');
});
