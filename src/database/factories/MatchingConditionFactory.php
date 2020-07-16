<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MatchingCondition;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(MatchingCondition::class, function (Faker $faker) {
    return [
        'occupation_id' => 1,
        'area_id' => 1,
        'worktime_week' => 1,
        'holiday_work' => 1,
        'weekday_work' => 1,
        'adjust' => 1,
        'changing_jobs' => 1,
    ];
});
