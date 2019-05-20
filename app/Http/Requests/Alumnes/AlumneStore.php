<?php

namespace App\Http\Requests\Alumnes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AlumneStore extends FormRequest
{

    public function authorize()
    {
        return Auth::user()->can('alumnes.store');
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:alumnes,name',
            'surname' => 'required|unique:alumnes,surname'
        ];
    }
}
