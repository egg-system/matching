<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $this->call(
                [
                    AreasTableSeeder::class,
                    OccupationsTableSeeder::class,
                    TrainersTableSeeder::class,
                    GymsTableSeeder::class,
                ]
            );
        });
    }
}
