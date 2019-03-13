<?php

namespace App\Http\Controllers\Api;

use App\Alumne;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChangeAlumnesController extends  Controller{

    public function destroy(Request $request, Alumne $alumne)
    {
        $alumne->change=false;
        $alumne->save();
    }
    public function store(Request $request, Alumne $alumne)
    {
        $alumne->change = true;
        $alumne->save();

    }
}
