<?php

use Illuminate\Support\Facades\DB;

class OccupationsTableSeeder extends BaseSeeder
{
    private $table = 'occupations';

    /**
     * 開発環境用
     */
    public function dev()
    {
        DB::table($this->table)->insert([
            [
                'name' => 'パーソナル'
            ],
            [
                'name' => 'ボクシング'
            ],
            [
                'name' => 'フィットネス'
            ],
            [
                'neme' => 'etc'
            ]
        ]);
    }

    /**
     * 本番用
     */
    public function production()
    {
        DB::table($this->table)->insert(
            [
                'name' => 'パーソナル'
            ],
            [
                'name' => 'ボクシング'
            ],
            [
                'name' => 'フィットネス'
            ],
            [
                'neme' => 'etc'
            ]
        );
    }
}
