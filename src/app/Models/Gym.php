<?php

namespace App\Models;

class Gym extends User
{
    protected $fillable = [
        'basic_profile',
        'tel',
        'prefecture_id',
        'gym_url',
        'comment',
    ];

    protected $casts = [
        'basic_profile' => 'json',
    ];
}
