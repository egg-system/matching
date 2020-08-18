<?php

namespace Database\Seeds\Common;

use App\Models\Occupation;
use Illuminate\Database\Seeder;

class OccupationsTableSeeder extends Seeder
{
    private const DATA = [
        [
            'id' => Occupation::PERSONAL,
            'name' => 'パーソナル',
        ],
        [
            'id' => Occupation::GYM,
            'name' => 'ジム'
        ],
        [
            'id' => Occupation::FITNESS,
            'name' => 'フィットネス'
        ]
    ];

    public function run()
    {
        $datas = self::DATA;
        foreach ($datas as $data) {
            Occupation::updateOrCreate([
                'id' => $data['id']
            ], [
                'name' => $data['name']
            ]);
        }
    }
}
