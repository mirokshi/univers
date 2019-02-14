<?php
namespace App\Http\Controllers\Auth;


use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginAltController
{
    public function login(Request $request)
    {

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return redirect('/');
        }
        if (Hash::check($request->password, $user->password)) {
            return redirect('/');
        };
        //Loggin
        Auth::login($user);

        return redirect('/home');
    }
}
