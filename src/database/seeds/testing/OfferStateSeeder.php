<?php

declare(strict_types=1);

namespace Database\Seeds\Testing;

use App\Models\OfferState;
use Illuminate\Database\Seeder;

class OfferStateSeeder extends Seeder
{
    private const DATA = [
        [
            'name' => '未返答',
        ],
        [
            'name' => '承諾',
        ],
        [
            'name' => '辞退',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datas = self::DATA;

        foreach ($datas as $data) {
            OfferState::firstOrCreate($data);
        }
    }
}
