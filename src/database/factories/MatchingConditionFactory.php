<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MatchingCondition;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(MatchingCondition::class, function (Faker $faker) {
    return [
        'area_id' => 1,
        'weekly_worktime' => 1,
        'can_work_holiday' => true,
        'can_work_weekday' => true,
        'hope_adjust_worktime' => true,
        'is_considering_change_job' => true,
        'can_adjust_to_trainer' => true,
    ];
});

$factory->afterCreating(MatchingCondition::class, function ($matchingCondition) {
    $matchingCondition->occupation()->attach(2);
});