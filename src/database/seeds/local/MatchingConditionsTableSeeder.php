<?php

namespace Database\Seeds\Local;

use App\Models\MatchingCondition;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class MatchingConditionsTableSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        MatchingCondition::create([
            'user_type' => 'App\Models\Trainer',
            'user_id' => 1,
            'occupation_id' => 1,
            'area_id' => 1,
            'price' => json_decode('{"max": "20000", "min": "10000"}'),
            'work_time' => json_decode('{"time": "18:00", "week": "月"}'),
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
