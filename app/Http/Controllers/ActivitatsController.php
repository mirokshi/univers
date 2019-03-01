<?php

namespace App\Http\Controllers;


use App\Activitat;
use App\Http\Requests\Activitats\ActivitatIndex;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivitatsController extends Controller
{
    public function index(ActivitatIndex $request)
    {
        if (Auth::user()->can('activitats.manage')) {
            $activitats = map_collection(Activitat::orderBy('created_at', 'desc')->get());
            $uri = '/api/v1/activitats/';
        }else{
            $activitats = map_collection($request->user()->alumnes);
            $uri = '/api/v1/user/activitats';
        }
        $users=map_collection(User::all());
     return view('/activitats',compact('activitats','users', 'uri'));


    }
}
