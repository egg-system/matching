<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Login;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Login::class, function (Faker $faker) {
    static $user_id = 1;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => Carbon::now(),
        'password' => config('database.seeds.default.password', Str::random(10)),
        'user_type' => 'App\Models\Trainer',
        'user_id' => $user_id++,
        'remember_token' => Str::random(10),
    ];
});
