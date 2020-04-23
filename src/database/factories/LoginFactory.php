<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Login;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(Login::class, function (Faker $faker) {
    return [
        'email' => $faker->email,
        'password' => Hash::make('password')
    ];
});
