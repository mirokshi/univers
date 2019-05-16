<?php

namespace App\Http\Requests\Alumnes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserStore extends FormRequest
{

    public function authorize()
    {
        return  Auth::user()->can('entitats.store');;
    }

    public function rules()
    {
        return [
          'name'=> 'required'
        ];
    }
}
