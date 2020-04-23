<?php

namespace Database\Seeds\Production;

use App\Models\Occupation;
use Illuminate\Database\Seeder;

class OccupationsTableSeeder extends Seeder
{
    private const DATA = [
        [
            'name' => 'パーソナル'
        ],
        [
            'name' => 'ボクシング'
        ],
        [
            'name' => 'フィットネス'
        ]
    ];

    public function run()
    {
        $datas = self::DATA;
        foreach ($datas as $data) {
            Occupation::firstOrCreate($data);
        }
    }
}
