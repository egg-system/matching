<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Area;
use App\Models\Occupation;
use App\Models\Trainer;
use Faker\Generator as Faker;

$factory->define(Trainer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'tel' => $faker->phoneNumber,
        'occupation_id' => function () {
            return factory(Occupation::class)->create()->id;
        },
        'area_id' => function () {
            return factory(Area::class)->create()->id;
        },
        'pr_comment' => $faker->text,
        'hope_price' => [],
        'hope_work_time' => [],
    ];
});
