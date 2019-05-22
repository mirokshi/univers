<?php

namespace App\Http\Requests\Alumnes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserUpdate extends FormRequest
{

    public function authorize()
    {
        Auth::user()->can('entitats.update');
    }

    public function rules()
    {
        return [
          'name'=> 'required'
        ];
    }
}
