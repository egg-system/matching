<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MatchingCondition;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(MatchingCondition::class, function (Faker $faker) {
    return [
        'user_type' => 'App\Models\Trainer',
        'user_id' => 1, // create時に上書きする
        'occupation_id' => 1,
        'area_id' => 1,
        'price' => ['max' => "{$faker->numberBetween(6, 10)}0000", 'min' => "{$faker->numberBetween(1, 5)}0000"],
        'work_time' => ['time' => $faker->time('H:00'), 'week' => $faker->randomElement(['月', '火', '水', '木', '金', '土', '日'])],
    ];
});
