<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    $Roles = array('F','P');
    $randIndex = array_rand($Roles);
    return [
        'Fname' => $faker->firstName($gender ='male'|'female') ,
        'Lname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' =>bcrypt('secret'),
        'remember_token' => str_random(10),
        'role'=>$Roles[$randIndex],
        'photo_link'=>$faker->imageUrl($width = 640, $height = 480),
        'is_verified'=>true,
    ];
});
