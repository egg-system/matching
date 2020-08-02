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
            'gym_send_mail' => 1,
            "transition_state" => null,
            "transition_user_type" => 'App\Models\Trainer',
        ],
        [
            'name' => 'オファー',
            'trainer_send_mail' => 1,
            'gym_send_mail' => 1,
            "transition_state" => null,
            "transition_user_type" => 'App\Models\Gym',
        ],
        [
            'name' => '内定',
            'trainer_send_mail' => 1,
            'gym_send_mail' => 0,
            "transition_state" => '1,2',
            "transition_user_type" => 'App\Models\Gym',
        ],
        [
            'name' => '内定承諾',
            'trainer_send_mail' => 1,
            'gym_send_mail' => 1,
            "transition_state" => '3',
            "transition_user_type" => 'App\Models\Trainer',
        ],
        [
            'name' => '内定辞退',
            'trainer_send_mail' => 0,
            'gym_send_mail' => 1,
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
