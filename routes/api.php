<?php

use App\Http\Controllers\Api\ActivitatsController;
use App\Http\Controllers\Api\AlumnesController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->group(function() {

    Route::get('/v1/alumnes', '\\'.AlumnesController::class.'@index');
    Route::get('/v1/alumnes/{alumne}', '\\'.AlumnesController::class.'@show');
    Route::post('/v1/alumnes', '\\'.AlumnesController::class.'@store');
    Route::delete('/v1/alumnes/{alumne}', '\\'.AlumnesController::class.'@destroy');
    Route::put('/v1/alumnes/{alumne}', '\\'.AlumnesController::class.'@update');

    Route::get('/v1/activitats', '\\'.ActivitatsController::class.'@index');
    Route::get('/v1/activitats/{actvitat}', '\\'.ActivitatsController::class.'@show');
    Route::post('/v1/activitats', '\\'.ActivitatsController::class.'@store');
    Route::delete('/v1/activitats/{actvitat}', '\\'.ActivitatsController::class.'@destroy');
    Route::put('/v1/activitats/{actvitat}', '\\'.ActivitatsController::class.'@update');
});
