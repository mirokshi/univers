<?php

namespace App\Http\Requests\Alumnes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserAlumneIndex extends FormRequest
{

    public function authorize()
    {
        return Auth::user()->can('user.alumnes.index');
    }

    public function rules()
    {
        return [
//          'name'=> 'required'
        ];
    }
}
