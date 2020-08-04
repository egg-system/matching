<?php

namespace App\Models;

class Trainer extends User
{
    protected $fillable = [
        'tel',
        'pr_comment',
        'now_work_area_id',
        'now_work_style',
        'carrer',
    ];

    protected $casts = [
        'carrer' => 'json',
    ];

    protected $with = ['login'];
}
