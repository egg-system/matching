<?php

declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Area;
use Faker\Generator as Faker;

$factory->define(Area::class, function (Faker $faker) {
    return [
        'name' => $faker->streetName,
    ];
});
