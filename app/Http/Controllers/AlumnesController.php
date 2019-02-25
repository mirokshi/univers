<?php

namespace App\Http\Controllers;

use App\Activitat;
use App\Alumne;

use App\Http\Requests\Alumnes\AlumneIndex;
use App\Http\Requests\Alumnes\UserAlumneIndex;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlumnesController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->can('alumnes.manage')){
            $alumnes = map_collection(Alumne::orderBy('created_at','desc')->get());
            $uri= '/api/v1/alumnes/';
        }else{
            $alumnes = map_collection($request->user()->alumnes);
            $uri= '/api/v1/alumnes/';
        }

        $users=map_collection(User::all());
        //$activitats = map_collection(Activitat::all());
        //TODO ACTIVITATS
     return view('alumnes',compact('alumnes','users', 'uri'));


    }
}
