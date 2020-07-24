<?php

namespace App\Models;

class Gym extends User
{
    protected $fillable = [
        'profiles',
        'tel',
        'prefecture_id',
        'gym_url',
        'introduction',
    ];

    protected $casts = [
        'profiles' => 'json',
    ];
}
