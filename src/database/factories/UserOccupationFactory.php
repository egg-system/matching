<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\UserOccupation;
use Faker\Generator as Faker;

$factory->define(UserOccupation::class, function (Faker $faker) {
    return [
        'occupation_id' => $faker->numberBetween(1, 3),
        'user_id' => $faker->numberBetween(1, 2)
    ];
});
