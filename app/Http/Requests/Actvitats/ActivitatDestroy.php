<?php

namespace App\Http\Requests\Activitats;

use Illuminate\Foundation\Http\FormRequest;

class ActivitatDestroy extends FormRequest
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
