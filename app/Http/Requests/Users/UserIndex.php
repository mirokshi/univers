<?php

namespace App\Http\Requests\Alumnes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserIndex extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
//          'name'=> 'required'
        ];
    }
}