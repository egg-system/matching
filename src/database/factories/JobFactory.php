<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Job;
use Faker\Generator as Faker;

$factory->define(Job::class, function (Faker $faker) {
    return [
        'gym_id' => 1,
        'bussiness_description' => $faker->realText($maxNbChars = 50, $indexSize = 2),
        'requirements_number' => $faker->randomNumber($nbDigits = 5),
        'pay_min' => "{$faker->numberBetween(1, 5)}0000",
        'pay_max' => "{$faker->numberBetween(6, 10)}0000",
        'experience' => $faker->randomNumber($nbDigits = 5),
    ];
});
