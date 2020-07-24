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
        'holiday_work_is_possible' => true,
        'weekday_work_is_possible' => true,
        'adjust_by_project' => true,
        'changing_jobs_is_considering' => true,
    ];
});

$factory->afterCreating(MatchingCondition::class, function ($matchingCondition) {
    $matchingCondition->occupation()->attach(2);
});