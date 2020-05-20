<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gym extends Model
{
    protected $fillable = [
        'name',
        'president_name',
        'tel',
        'staff_count',
        'customer_count',
        'requirements',
    ];

    protected $casts = [
        'requirements' => 'json',
    ];

    public function login()
    {
        return $this->morphOne(Login::class, 'user');
    }

    public function matchingCondition()
    {
        return $this->morphOne(MatchingCondition::class, 'user');
    }
}
