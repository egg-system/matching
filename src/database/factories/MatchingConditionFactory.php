<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MatchingCondition;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(MatchingCondition::class, function (Faker $faker) {
    return [
        'area_id' => 1,
        'worktime_week' => 1,
        'holiday_work' => true,
        'weekday_work' => true,
        'adjust' => true,
        'changing_jobs' => true,
    ];
});

$factory->afterCreating(MatchingCondition::class, function ($matchingCondition) {
    $matchingCondition->occupation()->attach(2);
});