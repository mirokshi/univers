<?php

namespace App\Helpers;

use App\Alumne;
use App\User;

if (!function_exists('create_example_alumnes')) {

    function create_example_alumnes()
    {
        $user1 = factory(User::class)->create();
        Alumne::create([
            'name' => 'Jose',
            'surname' => 'Lopez',
            'birthdate' => '22/10/2000',
            'age' => '20',
            'school' => 'IES EBRE',
            'course' => '2018-2019',
            'school_course' => 'CFGS',
            'sex' => 'altre',
            'phone' => '777888999',
            'user_id' => $user1->id
        ]);
        Alumne::create([
            'name' => 'Marc',
            'surname' => 'Mestre',
            'birthdate' => '22/10/2000',
            'age' => '23',
            'school' => 'IES EBRE',
            'course' => '2018-2019',
            'school_course' => 'CFGS',
            'sex' => 'home',
            'phone' => '616531219',
            'user_id' => $user1->id
        ]);
        Alumne::create([
            'name' => 'Martha',
            'surname' => 'Ramirez',
            'birthdate' => '22/10/2000',
            'age' => '20',
            'school' => 'IES EBRE',
            'course' => '2018-2019',
            'school_course' => 'CFGS',
            'sex' => 'dona',
            'phone' => '6564445152',
            'user_id' => $user1->id
        ]);

    }
}
if (!function_exists('create_example_simple_alumne')) {

    function create_example_simple_alumne()
    {
        Alumne::create([
            'name' => 'Juan',
            'surname' => 'Gutierrez Sanchez',
            'birthdate' => '22/10/2000',
            'age' => '19',
            'school' => 'IES EBRE',
            'course' => '2018-2019',
            'school_course' => 'CFGS',
            'sex' => 'home',
            'phone' => '616531219'
        ]);
        Alumne::create([
            'name' => 'Carla',
            'surname' => 'Garcia Gomez',
            'birthdate' => '22/10/2000',
            'age' => '19',
            'school' => 'IES EBRE',
            'course' => '2018-2019',
            'school_course' => 'CFGS',
            'sex' => 'dona',
            'phone' => '987654321'
        ]);
        Alumne::create([
            'name' => 'Joan',
            'surname' => 'Tiscar',
            'birthdate' => '22/10/2000',
            'age' => '20',
            'school' => 'IES EBRE',
            'course' => '2017-2018',
            'school_course' => 'CFGS',
            'sex' => 'home',
            'phone' => '123456789'
        ]);

    }

}
