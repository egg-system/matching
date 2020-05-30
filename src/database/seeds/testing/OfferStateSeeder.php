<?php

namespace Database\Seeds\Testing;

use App\Models\OfferState;
use Illuminate\Database\Seeder;

class OfferStateSeeder extends Seeder
{
    private const DATA = [
        [
            'name' => '未返答'
        ],
        [
            'name' => '承諾'
        ],
        [
            'name' => '辞退'
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = self::DATA;
        foreach ($datas as $data) {
            OfferState::firstOrCreate($data);
        }
    }
}
