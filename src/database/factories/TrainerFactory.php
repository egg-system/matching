<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Area;
use App\Models\Occupation;
use App\Models\Trainer;
use App\Models\Login;
use App\Models\MatchingCondition;
use Faker\Generator as Faker;

$factory->define(Trainer::class, function (Faker $faker) {
    return [
        'now_work_area_id' => 1,
        'now_work_style' => 1,
        'carrer' => [
            [
                'gym_name' => $faker->realText($maxNbChars = 10, $indexSize = 2),
                'enrollment' => ['start' => '2019/01', 'end' => '2019/12', 'ongoing' => '0'],
                'comment' => $faker->realText($maxNbChars = 50, $indexSize = 2)
            ],
            [
                'gym_name' => $faker->realText($maxNbChars = 10, $indexSize = 2),
                'enrollment' => ['start' => '2020/01', 'end' => '', 'ongoing' => '1'],
                'comment' => $faker->realText($maxNbChars = 50, $indexSize = 2)
            ]
        ],
        'display_name' => $faker->name,
    ];
});

$factory->afterCreating(Trainer::class, function ($trainer) {
    $trainerMorph = [
        'user_type' => Trainer::class,
        'user_id' => $trainer->id,
    ];
    factory(Login::class)->create($trainerMorph);
    factory(MatchingCondition::class)->create($trainerMorph);
});
