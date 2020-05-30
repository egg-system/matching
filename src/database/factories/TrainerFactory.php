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
        'name' => $faker->name,
        'tel' => $faker->phoneNumber,
        'pr_comment' => $faker->text,
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
