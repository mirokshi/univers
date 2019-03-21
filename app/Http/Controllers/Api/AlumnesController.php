<?php

namespace App\Http\Controllers\Api;


use App\Alumne;
use App\Http\Controllers\Controller;
use App\Http\Requests\Alumnes\AlumneDestroy;
use App\Http\Requests\Alumnes\AlumneIndex;
use App\Http\Requests\Alumnes\AlumneShow;
use App\Http\Requests\Alumnes\AlumneStore;
use App\Http\Requests\Alumnes\AlumneUpdate;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $alumne->age = $request->age = calculateYears($alumne->birhdate);
        $alumne->school = $request->school;
        $alumne->course = $request->course =date('Y').'-'.(date('Y')+1);
        $alumne->school_course = $request->school_course;
        $alumne->sex = $request->sex;
        $alumne->phone = $request->phone;
        $alumne->change = $request->change ? true : false;
        $alumne->user_id = $request->user_id;
        $alumne->save();
        return $alumne->map();
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
        $alumne->course = $request->course =date('Y').'-'.(date('Y')+1);
        $alumne->school_course = $request->school_course;
        $alumne->sex = $request->sex;
        $alumne->phone = $request->phone;
        $alumne->change = $request->change ? true : false;
        $alumne->user_id = $request->user_id;
        $alumne->save();
        return $alumne->map();
    }
}
