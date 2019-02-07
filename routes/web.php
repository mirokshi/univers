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

use App\Http\Controllers\AlumnesController;
use App\Http\Controllers\EntitatsController;

Route::get('/', function () {
    return view('layouts.welcome');
});

Route::get('/alumnes', '\\'.AlumnesController::class.'@index');

Route::get('/entitats', '\\'.EntitatsController::class.'@index');


Route::get('/prueva', function () {
    $rows = array_map('str_getcsv', file('/home/mirokshi/code/mirokshi/univers/files/csvcopia.csv'));
    $header = array_shift($rows);
    $csv = array();
    foreach ($rows as $row) {
        $csv[] = array_combine($header, $row);
    }
    return $csv;


});
