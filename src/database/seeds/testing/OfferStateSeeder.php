<?php

namespace Database\Seeds\Testing;

use App\Models\OfferState;
use Illuminate\Database\Seeder;

class OfferStateSeeder extends Seeder
{
    private const DATA = [
        [
            'name' => 'エントリー',
            'should_notice_trainer' => 1,
            'should_notice_gym' => 1,
            "transition_state" => null,
            "transition_user_type" => 'App\Models\Trainer',
        ],
        [
            'name' => 'オファー',
            'should_notice_trainer' => 1,
            'should_notice_gym' => 1,
            "transition_state" => null,
            "transition_user_type" => 'App\Models\Gym',
        ],
        [
            'name' => '内定',
            'should_notice_trainer' => 1,
            'should_notice_gym' => 0,
            "transition_state" => '1,2',
            "transition_user_type" => 'App\Models\Gym',
        ],
        [
            'name' => '内定承諾',
            'should_notice_trainer' => 1,
            'should_notice_gym' => 1,
            "transition_state" => '3',
            "transition_user_type" => 'App\Models\Trainer',
        ],
        [
            'name' => '内定辞退',
            'should_notice_trainer' => 0,
            'should_notice_gym' => 1,
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
