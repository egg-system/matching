<?php

namespace App\Models;

use App\Models\MatchingCondition;
use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{
    protected $fillable = [
        'name',
    ];

    public function occupations()
    {
        return $this->belongsToMany(
            MatchingCondition::class,
            'matching_condition_occupations',
            'matching_condition_id',
            'user_id'
        )->withTimestamps();
    }

    public function getImageAttribute()
    {
        $image = '';
        if ($this->name === 'フィットネス') {
            $image = '/images/users-register/fitness_icon.jpg';
        } elseif ($this->name === 'ジム') {
            $image = '/images/users-register/gym_icon2.jpg';
        } elseif ($this->name === 'パーソナル') {
            $image = '/images/users-register/personal_trainer_icon.jpg';
        }
        return $image;
    }
}
