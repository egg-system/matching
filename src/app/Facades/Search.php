<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Search extends Facade
{
    protected static function getFacadeAccessor()
    {
        switch(\Auth::user()->user_type) {
            case \App\Models\Gym::class:
                return \App\Components\GymSearch::class;
            case \App\Models\Trainer::class:
                return \App\Components\TrainerSearch::class;
        }
    }
}