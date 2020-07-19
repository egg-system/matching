<?php

namespace Database\Seeds\Testing;

use App\Models\UserOccupation;
use Illuminate\Database\Seeder;

class UserOccupationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gym = factory(UserOccupation::class)->create();
    }
}
