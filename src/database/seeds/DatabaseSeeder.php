<?php

use Database\Seeds\Common;
use Database\Seeds\Testing;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    const Testing = [
        Testing\AreasTableSeeder::class,
        Testing\GymsTableSeeder::class,
        Testing\TrainersTableSeeder::class,
        Testing\OfferStateSeeder::class,
    ];

    const COMMON = [
        Common\OccupationsTableSeeder::class
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $this->seed();
        });
    }

    protected function seed()
    {
        // prodのデータは全環境で使用する
        $this->call(self::COMMON);

        // 本番では実行しない
        if (App::isProduction()) {
            return;
        };
        $this->call(self::Testing);
    }
}
