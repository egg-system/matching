<?php

use Database\Seeds\Local;
use Database\Seeds\Production;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    const LOCAL = [
        Local\AreasTableSeeder::class,
        Local\GymsTableSeeder::class,
        Local\LoginTableSeeder::class,
        Local\MatchingConditionsTableSeeder::class,
        Local\OccupationsTableSeeder::class,
        Local\TrainersTableSeeder::class
    ];

    const PROD = [
        Production\OccupationsTableSeeder::class
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $this->call(App::isLocal() ? self::LOCAL : self::PROD);
        });
    }
}
