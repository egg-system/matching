<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Area;
use App\Models\Gym;
use App\Models\Login;
use App\Models\MatchingCondition;
use App\Models\Occupation;
use Faker\Generator as Faker;

$factory->define(Gym::class, function (Faker $faker) {
    return [
        'president_name' => $faker->name,
        'tel' => $faker->phoneNumber,
        'staff_count' => $faker->numberBetween(),
        'prefecture_id' => $faker->numberBetween(1, 47),
        'cities' => $faker->city,
        'street_address' => $faker->streetAddress,
        'gym_url' => $faker->url,
        'comment' => $faker->realText($maxNbChars = 50, $indexSize = 2),
        'charge' => $faker->realText($maxNbChars = 50, $indexSize = 2),
        'requirements_number' => $faker->randomNumber($nbDigits = 5),
        'pay' => [
            'max' => "{$faker->numberBetween(6, 10)}0000",
            'min' => "{$faker->numberBetween(1, 5)}0000"
        ],
        'experience' => $faker->randomNumber($nbDigits = 2),
    ];
});

$factory->afterCreating(Gym::class, function ($gym) {
    $gymMorph = [
        'user_type' => Gym::class,
        'user_id' => $gym->id,
    ];
    factory(Login::class)->create($gymMorph);
    factory(MatchingCondition::class)->create($gymMorph);
});
