<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntitatsController extends Controller
{
    public function index()
    {
        return view('entitats');
    }
}
