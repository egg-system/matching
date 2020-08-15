<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{
    protected $fillable = [
        'name',
    ];

    public function occupation()
    {
        return $this->belongsToMany(
            Occupation::class,
            'user_occupations',
            'occupation_id',
            'user_id'
        )->withTimestamps();
    }

    public function getImageAttribute()
    {
        $image = '';
        if ($this->name === 'フィットネス') {
            $image = '/images/users-register/fitness_icon.jpg';
        } elseif ($this->name === 'ジム') {
            $image = '/images/users-register/gym_trainer_icon.jpg';
        } elseif ($this->name === 'パーソナル') {
            $image = '/images/users-register/personal_trainer_icon.jpg';
        }
        return $image;
    }
}
