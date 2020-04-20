<?php

use App\Models\Trainer;

class TrainersTableSeeder extends BaseSeeder
{
    /**
     * 開発環境用
     */
    public function dev()
    {
        factory(Trainer::class, 20)->create();
    }

    /**
     * 本番用
     */
    public function production()
    {
    }
}
