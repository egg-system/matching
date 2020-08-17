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
            'president_name' => $faker->name,
            'staff_number' => $faker->numberBetween(),
            'postal_code' => $faker->postcode,
            'cities' => $faker->city,
            'street_address' => $faker->streetAddress,
        ],
        'prefecture_id' => $faker->numberBetween(1, 47),
        'gym_url' => $faker->url,
    ];
});

$factory->afterCreating(Gym::class, function ($gym, Faker $faker) {
    $gymMorph = [
        'user_type' => Gym::class,
        'user_id' => $gym->id,
    ];

    factory(Login::class)->create(array_merge($gymMorph, [
        'name' => $faker->company,
    ]));
    factory(MatchingCondition::class)->create($gymMorph);
});
