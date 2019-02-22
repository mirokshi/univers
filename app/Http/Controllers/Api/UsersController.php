<?php

namespace App\Http\Controllers\Api;



use App\Http\Controllers\Controller;

use App\Http\Requests\Alumnes\UserDestroy;
use App\Http\Requests\Alumnes\UserIndex;
use App\Http\Requests\Alumnes\Usershow;
use App\Http\Requests\Alumnes\UserStore;
use App\Http\Requests\Alumnes\UserUpdate;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(UserIndex $request)
    {
        return map_collection(User::orderBy('created_at','desc')->get());
    }

    public function show(UserShow $request, User $users)
    {
        return $users->map();
    }

    //CREATE
    public function store(UserStore $request)
    {
        $user = new User();
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->save();
        return $user->map();
    }

    //ELIMINAR
    public function destroy(UserDestroy $request, User $users)
    {
        $users->delete();
        return $users;
    }

    //MODIFICAR
    public function update(UserUpdate $request, User $users)
    {
        $users->name  = $request->name;
        $users->save();
        return $users->map();
    }
}
