<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Occupation;
use Faker\Generator as Faker;

$factory->define(Occupation::class, function (Faker $faker) {
    return [
        'name' => $faker->colorName,
    ];
});
