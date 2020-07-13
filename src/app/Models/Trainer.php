<?php

namespace App\Models;

class Trainer extends User
{
    protected $fillable = [
        'tel',
        'pr_comment',
        'now_work_area_id',
        'now_work_style',
    ];

    protected $with = ['login'];
}
