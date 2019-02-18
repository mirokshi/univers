<?php

namespace App\Http\Controllers;


use App\Activitat;
use App\Http\Requests\Activitats\ActivitatIndex;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivitatsController extends Controller
{
    public function index(ActivitatIndex $request)
    {
        $activitats = map_collection(Activitat::orderBy('created_at','desc')->get());
        $uri= '/api/v1/activitats/';
     return view('/activitats',compact('activitats', 'uri'));


    }
}
