<?php

namespace App\Http\Controllers;


use App\Http\Requests\Alumnes\UserAlumneIndex;
use App\Http\Requests\Alumnes\UserIndex;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $users=map_collection(User::all());
        $uri= '/api/v1/users/';
        //return map_collection(User::orderBy('created_at','desc')->get());

        return view('/users',compact('users', 'uri'));

    }

}
