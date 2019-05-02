<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AdminUserController extends  Controller{

    public function destroy(Request $request, User $user)
    {
        $user->admin=false;
        $user->save();
    }
    public function store(Request $request, User $user)
    {
        $user->admin = true;
        $user->save();

    }
}
