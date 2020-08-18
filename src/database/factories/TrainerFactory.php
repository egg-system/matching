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
        'careers' => [
            [
                'gym_name' => $faker->company,
                'start_at' => '2019/01',
                'end_at' => '2019/12',
                'in_office' => false,
                'description' => $faker->realText
            ],
            [
                'gym_name' => $faker->company,
                'start_at' => '2020/01',
                'end_at' => null,
                'in_office' => true,
                'description' => $faker->realText,
            ]
        ],
        'display_name' => $faker->name,
        'is_considering_change_job' => true,
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
