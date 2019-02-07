<?php

namespace App\Http\Controllers;

use App\Alumne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlumnesController extends Controller
{
    public function index(Request $request)
    {
     return view('alumnes');
    }
}
