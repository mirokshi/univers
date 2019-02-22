<?php

namespace App\Http\Controllers;


use App\Http\Requests\Alumnes\UserAlumneIndex;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $users=map_collection(User::orderBy('created_at','desc')->get());
        $uri= '/api/v1/users/';
        return view('/users',compact('users', 'uri'));


    }
}
