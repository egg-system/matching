<?php

namespace Database\Seeds\Testing;

use App\Models\OfferState;
use Illuminate\Database\Seeder;

class OfferStateSeeder extends Seeder
{
    private const DATA = [
        [
            'name' => 'エントリー',
            'trainer_send_mail' => 1,
            'gym_send_mail' => 1
        ],
        [
            'name' => 'オファー',
            'trainer_send_mail' => 1,
            'gym_send_mail' => 1
        ],
        [
            'name' => '内定',
            'trainer_send_mail' => 1,
            'gym_send_mail' => 0
        ],
        [
            'name' => '内定承諾',
            'trainer_send_mail' => 1,
            'gym_send_mail' => 1
        ],
        [
            'name' => '内定辞退',
            'trainer_send_mail' => 0,
            'gym_send_mail' => 1
        ],
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
