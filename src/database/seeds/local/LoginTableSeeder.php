<?php

namespace Database\Seeds\Local;

use App\Models\Gym;
use App\Models\Login;
use App\Models\Trainer;
use Illuminate\Database\Seeder;

class LoginTableSeeder extends Seeder
{
    public function run()
    {
        // トレーナー
        factory(Login::class, 1)->create([
            'email' => config('test.seeds.default.email.trainer'),
            'user_type' => Trainer::class,
        ]);
        // ジムオーナー
        factory(Login::class, 1)->create([
            'email' => config('test.seeds.default.email.gym'),
            'user_type' => Gym::class,
        ]);
    }
}
