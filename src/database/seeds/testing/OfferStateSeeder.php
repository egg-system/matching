<?php

namespace Database\Seeds\Testing;

use App\Models\OfferState;
use Illuminate\Database\Seeder;

class OfferStateSeeder extends Seeder
{
    private const DATA = [
        [
            'name' => 'エントリー',
            'should_notice_trainer' => true,
            'should_notice_gym' => true,
            "transition_state" => null,
            "transition_user_type" => 'App\Models\Trainer',
        ],
        [
            'name' => 'オファー',
            'should_notice_trainer' => true,
            'should_notice_gym' => true,
            "transition_state" => null,
            "transition_user_type" => 'App\Models\Gym',
        ],
        [
            'name' => '内定',
            'should_notice_trainer' => true,
            'should_notice_gym' => false,
            "transition_state" => '[1,2]',
            "transition_user_type" => 'App\Models\Gym',
        ],
        [
            'name' => '内定承諾',
            'should_notice_trainer' => true,
            'should_notice_gym' => true,
            "transition_state" => '[3]',
            "transition_user_type" => 'App\Models\Trainer',
        ],
        [
            'name' => '内定辞退',
            'should_notice_trainer' => false,
            'should_notice_gym' => true,
            "transition_state" => '[3]',
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
            if (OfferState::where('name', $data['name'])->exists()) {
                continue;
            }
            OfferState::firstOrCreate($data);
        }
    }
}
