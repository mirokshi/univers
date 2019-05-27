<?php

namespace App\Http\Controllers;

use App\Activitat;
use App\Http\Requests\HomeIndex;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(HomeIndex $request)
    {
        $activitats = map_collection(Activitat::all());
        return view('home',compact('activitats'));
    }
}
