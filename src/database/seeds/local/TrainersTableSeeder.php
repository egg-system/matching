<?php

namespace Database\Seeds\Local;

use App\Models\Trainer;
use Illuminate\Database\Seeder;

class TrainersTableSeeder extends Seeder
{
    public function run()
    {
        factory(Trainer::class, 20)->create();
    }
}
