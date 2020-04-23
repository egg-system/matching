<?php

namespace Database\Seeds\Local;

use App\Models\Gym;
use Illuminate\Database\Seeder;

class GymsTableSeeder extends Seeder
{
    public function run()
    {
        factory(Gym::class, 20)->create();
    }
}
