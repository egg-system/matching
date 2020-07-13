<?php

namespace App\Models;

class Gym extends User
{
    protected $fillable = [
        'president_name',
        'tel',
        'staff_count',
        'prefecture_id',
        'cities',
        'street_address',
        'gym_url',
        'comment',
        'charge',
        'requirements_number',
        'pay',
        'experience',
    ];

    protected $casts = [
        'pay' => 'json',
    ];
}
