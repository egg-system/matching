<?php

use Database\Seeds\Testing;
use Illuminate\Database\Seeder;

class TestingSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            Testing\GymsTableSeeder::class,
            Testing\TrainersTableSeeder::class,
        ]);
    }
}
