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
        'name' =>  $faker->company,
        'president_name' => $faker->name,
        'tel' => $faker->phoneNumber,
        'staff_count' => $faker->numberBetween(),
        'customer_count' => $faker->numberBetween(),
        'requirements' => [],
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
