<?php

use Database\Seeds\Common;
use Database\Seeds\Testing;
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
            $this->seed();
        });
    }

    protected function seed()
    {
        // prodのデータは全環境で使用する
        $this->call(CommonSeeder::class);

        // 開発環境のみ、実行する
        if (App::isLocal()) {
            $this->call(TestingSeeder::class);
        };
    }
}
