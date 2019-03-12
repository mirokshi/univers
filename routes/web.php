<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\ActivitatsController;
use App\Http\Controllers\AlumnesController;
use App\Http\Controllers\Auth\LoginAltController;
use App\Http\Controllers\Auth\RegisterAltController;
use App\Http\Controllers\UsersController;

Auth::routes();


Route::get('/', function () {
    return view('layouts.welcome');
});

Route::middleware(['auth'])->group(function() {
    Route::get('/alumnes', '\\'.AlumnesController::class.'@index');

    Route::get('/activitats', '\\'.ActivitatsController::class.'@index');

    Route::get('/entitats', '\\'.UsersController::class.'@index');


    Route::get('/home', function () {
        return view('home');
    });

Route::get('/sparklines', function () {
        return view('sparklines');
    });
});


Route::get('/prueva', function () {
    $rows = array_map('str_getcsv', file('/home/mirokshi/code/mirokshi/univers/files/csvcopia.csv'));
    $header = array_shift($rows);
    $csv = array();
    foreach ($rows as $row) {
        $csv[] = array_combine($header, $row);
    }
    return $csv;

});

Route::post('login_alt', 'Auth\LoginAltController@login');
Route::post('register_alt','Auth\RegisterAltController@register');

