<?php

namespace App\Http\Controllers\Api;


use App\Alumne;
use App\Http\Controllers\Controller;
use App\Http\Requests\AlumneDestroy;
use App\Http\Requests\AlumneIndex;
use App\Http\Requests\AlumneShow;
use App\Http\Requests\AlumneStore;
use App\Http\Requests\AlumneUpdate;

class AlumnesController extends Controller
{
    public function index(AlumneIndex $request)
    {
        return map_collection(Alumne::orderBy('created_at','desc')->get());
    }

    public function show(AlumneShow $request, Alumne $alumne)
    {
        return $alumne->map();
    }

    //CREATE
    public function store(AlumneStore $request)
    {
        $alumne = new Alumne();
        $alumne->name  = $request->name;
        $alumne->surname = $request->surname;
        $alumne->birthdate = $request->birthdate;
        $alumne->age = $request->age;
        $alumne->school = $request->school;
        $alumne->course = $request->course;
        $alumne->school_course = $request->school_course;
        $alumne->sex = $request->sex;
    }

    //ELIMINAR
    public function destroy(AlumneDestroy $request, Alumne $alumne)
    {
        $alumne->delete();
        return $alumne;
    }

    //MODIFICAR
    public function update(AlumneUpdate $request, Alumne $alumne)
    {
        $alumne->name = $request->name;
        $alumne->surname = $request->surname;
        $alumne->birthdate = $request->birthdate;
        $alumne->age = $request->age;
        $alumne->school = $request->school;
        $alumne->course = $request->course;
        $alumne->school_course = $request->school_course;
        $alumne->sex = $request->sex;
        $alumne->save();
        return $alumne->map();
    }
}
