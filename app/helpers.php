<?php

use App\Alumne;
use App\User;


if (!function_exists('create_primary_user')){
    function create_primary_user() {
        $user = User::where('email','mirokshirojas@tortosa.cat')->first();
        if (!$user) {

            $user =User::firstOrCreate ([
                'name' => 'Mirokshi Rojas',
                'email' => 'mirokshirojas@tortosa.cat',
                'password' => bcrypt(env('PRIMARY_USER_PASSWORD', 'secret'))
            ]);
            $user->admin = true;
            $user->save();
        }
    }
}

if (!function_exists('map_collection')){
    function  map_collection($collection){
        return $collection -> map(function ($item){
            return $item->map();
        });
    }
}

if (! function_exists('map_simple_collection')) {
    function map_simple_collection($collection)
    {
        return $collection->map(function($item) {
            return $item->mapSimple();
        });
    }
}

if (!function_exists('create_example_simple_alumne')){
    function create_example_simple_alumne(){
        Alumne::create([
            'name'=>'Juan',
            'surname' =>'Gutierrez Sanchez',
            'birthdate' =>'22/10/2000',
            'age' =>'19',
            'school' =>'IES EBRE',
            'course' => '2018-2019',
            'school_course'=>'CFGS',
            'sex'=>'home',
            'phone'=>'616531219'
        ]);
        Alumne::create([
            'name'=>'Carla',
            'surname' =>'Garcia Gomez',
            'birthdate' =>'22/10/2000',
            'age' =>'19',
            'school' =>'IES EBRE',
            'course' => '2018-2019',
            'school_course'=>'CFGS',
            'sex'=>'dona',
            'phone'=>'987654321'
        ]);
        Alumne::create([
            'name'=>'Joan',
            'surname' =>'Tiscar',
            'birthdate' =>'22/10/2000',
            'age' =>'20',
            'school' =>'IES EBRE',
            'course' => '2017-2018',
            'school_course'=>'CFGS',
            'sex'=>'home',
            'phone'=>'123456789'
        ]);
        Alumne::create([
            'name'=>'Jose Maria',
            'surname' => 'Lopez',
            'birthdate' =>'22/10/2000',
            'age' =>'20',
            'school' =>'IES EBRE',
            'course' => '2018-2019',
            'school_course'=>'CFGS',
            'sex'=>'altre',
            'phone'=>'777888999'
        ]);
        Alumne::create([
            'name'=>'Marc',
            'surname' =>'Mestre',
            'birthdate' =>'22/10/2000',
            'age' =>'23',
            'school' =>'IES EBRE',
            'course' => '2018-2019',
            'school_course'=>'CFGS',
            'sex'=>'home',
            'phone'=>'616531219'
        ]);
        Alumne::create([
            'name'=>'Martha',
            'birthdate' =>'22/10/2000',
            'age' =>'20',
            'school' =>'IES EBRE',
            'course' => '2018-2019',
            'school_course'=>'CFGS',
            'sex'=>'dona',
            'phone'=>'6564445152'
        ]);

        Alumne::create([
            'name' => 'Laura',
            'surname' => 'Aarabou del Sol',
            'age' => '6',
            'school' => 'Temple',
            'school_course' => '1r',
        ]);
        $user =factory(User::class)->create();

        Alumne::create([
            'name' => 'Lorena',
            'surname' => ' del Sol',
            'age' => '6',
            'school' => 'Temple',
            'school_course' => '1r',
            'user_id' => $user->id
        ]);

    }
}
