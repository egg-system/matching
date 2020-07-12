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
        'tel' => $faker->phoneNumber,
        'pr_comment' => $faker->text,
        'now_work_area_id' => 1,
        'now_work_style' => 1,
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
