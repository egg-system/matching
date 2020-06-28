<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MatchingCondition;
use Faker\Generator as Faker;

$factory->define(MatchingCondition::class, function (Faker $faker) {
    return [
        'occupation_id' => 1,
        'area_id' => 1,
        'price' => [
            'max' => "{$faker->numberBetween(6, 10)}0000",
            'min' => "{$faker->numberBetween(1, 5)}0000",
        ],
        'work_time' => [
            'time' => $faker->time('H:00'),
            'week' => $faker->randomElement(['月', '火', '水', '木', '金', '土', '日']),
        ],
    ];
});
