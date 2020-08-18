<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Job;
use Faker\Generator as Faker;

$factory->define(Job::class, function (Faker $faker) {
    return [
        'gym_id' => 1,
        'title' => $faker->word,
        'main_image_url' => $faker->imageUrl,
        'job_content' => $faker->realText,
        'requirements' => $faker->realText,
        'requirements_number' => $faker->randomNumber,
        'job_info' => [
            [
                'title' => $faker->word,
                'image' => $faker->imageUrl,
                'description' => $faker->realText,
            ]
        ],
    ];
});
