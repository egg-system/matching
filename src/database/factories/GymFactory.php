<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Gym;
use App\Models\Login;
use App\Models\MatchingCondition;
use Faker\Generator as Faker;

$factory->define(Gym::class, function (Faker $faker) {
    return [
        'president_name' => $faker->name,
        'tel' => $faker->phoneNumber,
        'staff_count' => $faker->numberBetween(),
        'customer_count' => $faker->numberBetween(),
        'requirements' => [],
    ];
});

$factory->afterCreating(Gym::class, function ($gym): void {
    $gymMorph = [
        'user_type' => Gym::class,
        'user_id' => $gym->id,
    ];
    factory(Login::class)->create($gymMorph);
    factory(MatchingCondition::class)->create($gymMorph);
});
