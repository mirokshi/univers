<?php

namespace App\Http\Controllers\Api;


use App\Activitat;
use App\Http\Controllers\Controller;
use App\Http\Requests\Activitats\ActivitatDestroy;
use App\Http\Requests\Activitats\ActivitatIndex;
use App\Http\Requests\Activitats\ActivitatShow;
use App\Http\Requests\Activitats\ActivitatStore;
use App\Http\Requests\Activitats\ActivitatUpdate;

class ActivitatsController extends Controller
{
    public function index(ActivitatIndex $request)
    {
        return map_collection(Activitat::orderBy('created_at','desc')->get());
    }

    public function show(ActivitatShow $request, Activitat $activitats)
    {
        return $activitats->map();
    }

    //CREATE
    public function store(ActivitatStore $request)
    {
        $activitats = new Activitat();
        $activitats->name  = $request->name;
        $activitats->category = $request->category;
        $activitats->date_start  = $request->date_start;
        $activitats->date_final  = $request->date_final;
        $activitats->course  = $request->course=date('Y').'-'.(date('Y')+1);
        $activitats->user_id = $request->user_id;
        $activitats->save();
        return $activitats->map();
    }

    //ELIMINAR
    public function destroy(ActivitatDestroy $request, Activitat $activitats)
    {
        $activitats->delete();
        return $activitats;
    }

    //MODIFICAR
    public function update(ActivitatUpdate $request, Activitat $activitats)
    {
        $activitats->name  = $request->name;
        $activitats->category = $request->category;
        $activitats->date_start  = $request->date_start;
        $activitats->date_final  = $request->date_final;
        $activitats->course  = $request->course =date('Y').'-'.(date('Y')+1);
        $activitats->user_id = $request->user_id;
        $activitats->save();
        return $activitats->map();
    }
}
