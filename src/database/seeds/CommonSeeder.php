<?php

use Database\Seeds\Common;
use Illuminate\Database\Seeder;

class CommonSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            Common\AreasTableSeeder::class,
            Common\OccupationsTableSeeder::class,
        ]);
    }
}
