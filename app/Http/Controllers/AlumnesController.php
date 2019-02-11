<?php

namespace App\Http\Controllers;

use App\Alumne;
use App\Http\Requests\AlumneIndex;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlumnesController extends Controller
{
    public function index(AlumneIndex $request)
    {

        $alumnes = map_collection(Alumne::orderBy('created_at','desc')->get());
        $uri= '/api/v1/alumnes';
     return view('alumnes',compact('alumnes', 'uri'));


    }
}
