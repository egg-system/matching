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
        'occupation_id' => function () {
            return factory(Occupation::class)->create()->id;
        },
        'area_id' => function () {
            return factory(Area::class)->create()->id;
        },
        'staff_count' => $faker->numberBetween(),
        'customer_count' => $faker->numberBetween(),
        'requirements' => [],
        'price' => [],
        'work_time' => [],
    ];
});
