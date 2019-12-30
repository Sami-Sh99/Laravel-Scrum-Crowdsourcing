<?php

use Faker\Generator as Faker;

$factory->define(App\Workshop::class, function (Faker $faker) {
    return [
        'key'=>$faker->unique()->userName(),
        'required_participants'=>rand(10,50),
        'description'=>$faker->realText(rand(10, 30)),
    ];
});
