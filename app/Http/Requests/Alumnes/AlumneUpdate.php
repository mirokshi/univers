<?php

namespace App\Http\Requests\Alumnes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AlumneUpdate extends FormRequest
{

    public function authorize()
    {
        return Auth::user()->can('alumnes.update');
    }

    public function rules()
    {
        return [
            'name' => 'required'
            //'name' => 'required|unique_with:alumnes,surname',
            //'surname' => 'required',
        ];
    }
}
