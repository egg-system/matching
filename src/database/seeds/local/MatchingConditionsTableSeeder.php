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

        factory(MatchingCondition::class, 1)->create();

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
