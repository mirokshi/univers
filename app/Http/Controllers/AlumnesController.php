<?php

namespace App\Http\Controllers;

use App\Alumne;

use App\Http\Requests\Alumnes\AlumneIndex;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlumnesController extends Controller
{
    public function index(AlumneIndex $request)
    {
    $alumnes = map_collection(Alumne::orderBy('created_at','desc')->get());
            $uri= '/api/v1/alumnes/';
        //if (Auth::user()->can('alumnes.manage')){
        //    $alumnes = map_collection(Alumne::orderBy('created_at','desc')->get());
        //    $uri= '/api/v1/alumnes/';
        //}else{
        //    $alumnes = map_collection($request->user()->);
        //    $uri= '/api/v1/alumnes/';
        //}

        $users=map_collection(User::all());
        //TODO ACTIVITATS
     return view('alumnes',compact('alumnes','users', 'uri'));


    }
}
