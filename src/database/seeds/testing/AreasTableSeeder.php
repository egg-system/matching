<?php

namespace Database\Seeds\Testing;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreasTableSeeder extends Seeder
{
    public function run()
    {
        factory(Area::class, 20)->create();
    }
}
