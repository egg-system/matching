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
        'profiles' => [
            'president_name' => $faker->realText($maxNbChars = 10, $indexSize = 2),
            'staff_count' => $faker->numberBetween(),
            'cities' => $faker->city,
            'street_address' => $faker->streetAddress
        ],
        'tel' => $faker->phoneNumber,
        'prefecture_id' => $faker->numberBetween(1, 47),
        'gym_url' => $faker->url,
        'description' => $faker->realText($maxNbChars = 50, $indexSize = 2),
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
