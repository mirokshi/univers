<?php

namespace App\Http\Controllers\Api;

use App\Activitat;
use App\Alumne;
use App\Http\Controllers\Controller;
use App\Http\Requests\AlumnesActivitatsUpdate;

class AlumnesActivitats extends Controller{

    public function update(AlumnesActivitatsUpdate $request, Alumne $alumne)
    {
        $mappedActivitats = collect($request->activitats)->map(function ($activitat){
            if (is_int($activitat)) return $activitat;
           else {
               return Activitat::create([
                   'name' => $activitat,
                   'date_start' => '',
                   'date_final' => '',
                   'course' => date('Y').'-'.(date('Y')+1)
               ])->id;
           }
        });

        $alumne->addActivitats(Activitat::find($mappedActivitats));
    }

}
