<?php

declare(strict_types=1);

use Database\Seeds\Common;
use Database\Seeds\Testing;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    const TESTING = [
        Testing\GymsTableSeeder::class,
        Testing\TrainersTableSeeder::class,
        Testing\OfferStateSeeder::class,
    ];

    const COMMON = [
        Common\AreasTableSeeder::class,
        Common\OccupationsTableSeeder::class,
    ];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::transaction(function (): void {
            $this->seed();
        });
    }

    protected function seed(): void
    {
        // prodのデータは全環境で使用する
        $this->call(self::COMMON);

        // 本番では実行しない
        if (App::isProduction()) {
            return;
        }
        $this->call(self::TESTING);
    }
}
