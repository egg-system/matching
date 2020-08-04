<?php

namespace App\Models;

class Gym extends User
{
    protected $fillable = [
        'profiles',
        'tel',
        'prefecture_id',
        'gym_url',
        'description',
    ];

    protected $casts = [
        'profiles' => 'json',
    ];
}
