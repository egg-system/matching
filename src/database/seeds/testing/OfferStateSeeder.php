<?php

namespace Database\Seeds\Testing;

use App\Models\OfferState;
use Illuminate\Database\Seeder;

class OfferStateSeeder extends Seeder
{
    private const DATA = [
        [
            'name' => 'エントリー',
            'trainer_notice_flg' => 1,
            'gym_notice_flg' => 1,
            "transition_state" => null,
            "transition_user_type" => 'App\Models\Trainer',
        ],
        [
            'name' => 'オファー',
            'trainer_notice_flg' => 1,
            'gym_notice_flg' => 1,
            "transition_state" => null,
            "transition_user_type" => 'App\Models\Gym',
        ],
        [
            'name' => '内定',
            'trainer_notice_flg' => 1,
            'gym_notice_flg' => 0,
            "transition_state" => '1,2',
            "transition_user_type" => 'App\Models\Gym',
        ],
        [
            'name' => '内定承諾',
            'trainer_notice_flg' => 1,
            'gym_notice_flg' => 1,
            "transition_state" => '3',
            "transition_user_type" => 'App\Models\Trainer',
        ],
        [
            'name' => '内定辞退',
            'trainer_notice_flg' => 0,
            'gym_notice_flg' => 1,
            "transition_state" => '3',
            "transition_user_type" => 'App\Models\Trainer',
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
