<?php

namespace App\Http\Requests\Alumnes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AlumneDestroy extends FormRequest
{

    public function authorize()
    {

        return Auth::user()->can('alumnes.destroy');
    }

    public function rules()
    {
        return [
          //'name'=> 'required'
        ];
    }
}
