<?php

namespace App\Http\Requests\Alumnes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AlumneIndex extends FormRequest
{

    public function authorize()
    {
        return Auth::user()->can('alumnes.index');
    }

    public function rules()
    {
        return [
          //'name'=> 'required'
        ];
    }
}
