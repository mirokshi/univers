<?php

namespace App\Http\Requests\Alumnes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Usershow extends FormRequest
{

    public function authorize()
    {
        Auth::user()->can('entitats.show');
    }

    public function rules()
    {
        return [
//          'name'=> 'required'
        ];
    }
}
