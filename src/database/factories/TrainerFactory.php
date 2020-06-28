<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Login;
use App\Models\MatchingCondition;
use App\Models\Trainer;
use Faker\Generator as Faker;

$factory->define(Trainer::class, function (Faker $faker) {
    return [
        'tel' => $faker->phoneNumber,
        'pr_comment' => $faker->text,
    ];
});

$factory->afterCreating(Trainer::class, function ($trainer): void {
    $trainerMorph = [
        'user_type' => Trainer::class,
        'user_id' => $trainer->id,
    ];
    factory(Login::class)->create($trainerMorph);
    factory(MatchingCondition::class)->create($trainerMorph);
});
