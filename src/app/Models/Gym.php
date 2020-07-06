<?php

namespace App\Models;

class Gym extends User
{
    protected $fillable = [
        'president_name',
        'tel',
        'staff_count',
        'customer_count',
        'requirements',
    ];

    protected $casts = [
        'requirements' => 'json',
    ];
}
