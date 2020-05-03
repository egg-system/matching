<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Area;
use App\Models\Gym;
use App\Models\Occupation;
use Faker\Generator as Faker;

$factory->define(Gym::class, function (Faker $faker) {
    return [
        'name' =>  $faker->company,
        'president_name' => $faker->name,
        'tel' => $faker->phoneNumber,
        'staff_count' => $faker->numberBetween(),
        'customer_count' => $faker->numberBetween(),
        'requirements' => [],
    ];
});
