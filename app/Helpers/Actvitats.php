<?php

namespace App\Helpers;

use App\Activitat;

if (!function_exists('create_example_simple_activitat')) {

    function create_example_simple_activitat()
    {
        Activitat::create([
            'name' => 'Juan',
            'name_activity' => 'Gutierrez Sanchez',
            'date_start' => '22/10/2000',
            'date_final' => '22/10/2000',
            'course' => '2018-2019',
        ]);
        Activitat::create([
            'name' => 'Carla',
            'name_activity' => 'Garcia Gomez',
            'date_start' => '22/10/2000',
            'date_final' => '22/10/2000',
            'course' => '2018-2019',
        ]);
        Activitat::create([
            'name' => 'Joan',
            'name_activity' => 'Tiscar',
            'date_start' => '22/10/2000',
            'date_final' => '22/10/2000',
            'course' => '2017-2018',
        ]);
        Activitat::create([
            'name' => 'Jose Maria',
            'name_activity' => 'Lopez',
            'date_start' => '22/10/2000',
            'date_final' => '22/10/2000',
            'course' => '2018-2019',
        ]);
        Activitat::create([
            'name' => 'Marc',
            'name_activity' => 'Mestre',
            'date_start' => '22/10/2000',
            'date_final' => '22/10/2000',
            'course' => '2018-2019',
        ]);

    }
}
