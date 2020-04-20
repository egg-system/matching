<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Login;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Login::class, function (Faker $faker) {
    return [
        'email' => $faker->email,
        'password' => Str::random(50)
    ];
});
