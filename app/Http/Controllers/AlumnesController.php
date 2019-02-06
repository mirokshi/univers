<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlumnesController extends Controller
{
    public function index()
    {
        return view('alumnes');
    }
}
