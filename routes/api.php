<?php

use App\Http\Controllers\Api\ActivitatsController;
use App\Http\Controllers\Api\AdminUserController;
use App\Http\Controllers\Api\AlumnesActivitats;
use App\Http\Controllers\Api\AlumnesController;
use App\Http\Controllers\Api\ChangeAlumnesController;
use App\Http\Controllers\Api\UsersController;
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

    Route::delete('/v1/change_alumne/{alumne}','\\'.ChangeAlumnesController::class.'@destroy');
    Route::post('/v1/change_alumne/{alumne}','\\'.ChangeAlumnesController::class.'@store');

    Route::delete('/v1/admin_user/{user}','\\'.AdminUserController::class.'@destroy');
    Route::post('/v1/admin_user/{user}','\\'.AdminUserController::class.'@store');

    Route::get('/v1/activitats', '\\'.ActivitatsController::class.'@index');
    Route::get('/v1/activitats/{actvitat}', '\\'.ActivitatsController::class.'@show');
    Route::post('/v1/activitats', '\\'.ActivitatsController::class.'@store');
    Route::delete('/v1/activitats/{actvitat}', '\\'.ActivitatsController::class.'@destroy');
    Route::put('/v1/activitats/{actvitat}', '\\'.ActivitatsController::class.'@update');

    Route::get('/v1/users', '\\'.UsersController::class.'@index');
    Route::get('/v1/users/{user}', '\\'.UsersController::class.'@show');
    Route::post('/v1/users', '\\'.UsersController::class.'@store');
    Route::delete('/v1/users/{user}', '\\'.UsersController::class.'@destroy');
    Route::put('/v1/users/{user}', '\\'.UsersController::class.'@update');

    //AlumnesActvitats
    Route::put('/v1/alumnes/{alumne}/activitats/','\\'.AlumnesActivitats::class.'@update');
    Route::delete('/v1/alumnes/{alumne}/activitats/{activitat}','\\'.AlumnesActivitats::class.'@destroy');
    Route::post('/v1/alumnes/{alumne}/activiats','\\'.AlumnesActivitats::class.'@store');
});
