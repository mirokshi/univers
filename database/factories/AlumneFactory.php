<?php

use App\Alumne;
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

$factory->define(Alumne::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'surname' => $faker->word,
        'birthdate' => $faker->date($format='d/m/Y'),
        'age'=>$faker->numberBetween($min=1, $max=99),
        'school'=>$faker->word,
        'course'=> $faker->word,
        'school_course'=>$faker->word,
        'sex' => $faker->word,
        'phone'=>$faker->phoneNumber

    ];
});
