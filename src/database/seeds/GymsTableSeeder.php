<?php

use App\Models\Gym;
use Illuminate\Database\Seeder;

class GymsTableSeeder extends BaseSeeder
{
    /**
     * 開発環境用
     */
    public function dev()
    {
        factory(Gym::class, 20)->create();
    }

    /**
     * 本番用
     */
    public function production()
    {
    }
}
