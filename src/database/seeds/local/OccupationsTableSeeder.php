<?php

namespace Database\Seeds\Local;

use App\Models\Occupation;
use Illuminate\Database\Seeder;

class OccupationsTableSeeder extends Seeder
{
    public function run()
    {
        factory(Occupation::class, 3)->create();
    }
}
