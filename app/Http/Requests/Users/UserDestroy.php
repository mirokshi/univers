<?php

namespace App\Http\Requests\Alumnes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserDestroy extends FormRequest
{

    public function authorize()
    {
        Auth::user()->can('entitats.destroy');
    }

    public function rules()
    {
        return [
//          'name'=> 'required'
        ];
    }
}
