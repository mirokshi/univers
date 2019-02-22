<?php

namespace App\Http\Requests\Alumnes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AlumneShow extends FormRequest
{

    public function authorize()
    {
        return Auth::user()->can('alumnes.show');
    }

    public function rules()
    {
        return [
          'name'=> 'required'
        ];
    }
}
