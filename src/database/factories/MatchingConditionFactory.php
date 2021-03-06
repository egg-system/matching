<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MatchingCondition;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(MatchingCondition::class, function (Faker $faker) {
    return [
        // area_idの1は選択できないようにしている
        'area_id' => 2,
        'weekly_worktime' => 1,
        'can_work_holiday' => true,
        'can_work_weekday' => true,
        'can_adjust' => true,
    ];
});

$factory->afterCreating(MatchingCondition::class, function ($matchingCondition) {
    $matchingCondition->occupations()->attach(2);
});
