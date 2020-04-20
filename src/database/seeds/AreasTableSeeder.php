<?php

use App\Models\Area;

class AreasTableSeeder extends BaseSeeder
{
    private $table = 'areas';

    /**
     * 開発環境用
     */
    public function dev()
    {
        factory(Area::class, 20)->create();
    }

    /**
     * 本番用
     */
    public function production()
    {
    }
}
