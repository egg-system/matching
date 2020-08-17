<?php

namespace App\Models;

use App\Models\Login;
use App\Models\Job;
use App\Models\MatchingCondition;

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

    protected $with = ['job', 'login'];

    public function login()
    {
        return $this->morphOne(Login::class, 'user');
    }

    public function matchingCondition()
    {
        return $this->morphOne(MatchingCondition::class, 'user');
    }

    public function job()
    {
        return $this->hasOne(Job::class);
    }
}
