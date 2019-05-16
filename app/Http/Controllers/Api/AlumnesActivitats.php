<?php

namespace App\Http\Controllers\Api;

use App\Activitat;
use App\Alumne;
use App\Http\Controllers\Controller;
use App\Http\Requests\AlumnesActivitatsDestroy;
use App\Http\Requests\AlumnesActivitatsStore;
use App\Http\Requests\AlumnesActivitatsUpdate;
use Carbon\Carbon;

class AlumnesActivitats extends Controller{


    public function store(AlumnesActivitatsStore $request, Alumne $alumne)
    {
        $oldAlumne =  $alumne->mapSimple();
        $alumne->syncActivitats($request->all());
        $alumne->save();
        return $alumne->map();
    }

    public function update(AlumnesActivitatsUpdate $request, Alumne $alumne)
    {
        $mappedActivitats = collect($request->activitats)->map(function ($activitat){
            if (is_int($activitat)) {
                return $activitat;
            } else {
               return Activitat::create([
                   'name' => $activitat,
                   'date_start' => Carbon::now(),
                   'date_final' => Carbon::tomorrow(),
                   'course' => date('Y').'-'.(date('Y')+1)
               ])->id;
           }
        });

        $alumne->addActivitats(Activitat::find($mappedActivitats));
    }

    public function destroy(AlumnesActivitatsDestroy $request, Alumne $alumne, Activitat $activitat)
    {
        $alumne->mapSimple();
        $alumne->removeActivitat($activitat);
        return $alumne->map();
    }

}
