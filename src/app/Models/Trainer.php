<?php

namespace App\Models;

class Trainer extends User
{
    protected $fillable = [
        'tel',
        'pr_comment',
    ];

    protected $with = ['login'];
}
