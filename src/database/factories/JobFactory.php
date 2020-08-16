<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Job;
use Faker\Generator as Faker;

$factory->define(Job::class, function (Faker $faker) {
    return [
        'gym_id' => 1,
        'job_content' => [
            'job_title' => $faker->realText($maxNbChars = 10, $indexSize = 2),
            'job_headline' => $faker->realText($maxNbChars = 10, $indexSize = 2),
            'job_image' => $faker->imageUrl($width = 640, $height = 480, $category = null, $randomize = true, $word = null, $gray = false),
            'job_description' => $faker->realText($maxNbChars = 50, $indexSize = 2),
            'desired_person' => $faker->realText($maxNbChars = 50, $indexSize = 2),
        ],
        'requirements_number' => $faker->randomNumber($nbDigits = 5),
    ];
});
