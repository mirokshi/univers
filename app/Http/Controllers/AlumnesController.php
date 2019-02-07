<?php

namespace App\Http\Controllers;

use App\Alumnes;
use Illuminate\Http\Request;

class AlumnesController extends Controller
{
    public function index()
    {
        $alumnes = Alumnes::all();

        return view('alumnes', compact($alumnes));
    }
}
