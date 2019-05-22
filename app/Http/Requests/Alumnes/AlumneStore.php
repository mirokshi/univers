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
            'name' => 'required'
            //'name' => 'required|unique_with:alumnes,surname',
            //'surname' => 'required',
            //'name' => 'unique:alumnes,name'.$this->get('id').',id,surname'.$this->get('surname')
        ];
    }
}
