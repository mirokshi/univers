<?php

namespace App\Http\Controllers;

use App\Http\Requests\Alumnes\UserIndex;
use App\User;

class UsersController extends Controller
{
    public function index(UserIndex $request)
    {
        $users=map_collection(User::all());
        $uri= '/api/v1/users/';
        //return map_collection(User::orderBy('created_at','desc')->get());

        return view('/users',compact('users', 'uri'));

    }

}
