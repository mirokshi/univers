<?php

use App\Activitat;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Activitat::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'category' => $faker->text(10),
        'date_start' => $faker->date($format='d/m/Y'),
        'date_final' => $faker->date($format='d/m/Y'),
        'course' => date('Y').'-'.(date('Y')+1),
    ];
});
