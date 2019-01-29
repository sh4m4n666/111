<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Patient::class, function (Faker $faker) {

    $gender = $faker->randomElement(['M', 'F']);

    return [
        'name' => $faker->firstName($gender),
        'surname' => $faker->lastName,
        'date_of_birth' => $faker->dateTimeBetween($startDate = '-75 years', $endDate = '-2 years', $timezone = null),
        'gender' => $gender,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'provider_id' => factory('App\User')->create()->id,

    ];
});
