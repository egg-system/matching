<?php

namespace Database\Seeds\Local;

use App\Models\Login;
use App\Models\Trainer;
use Illuminate\Database\Seeder;

class TrainersTableSeeder extends Seeder
{
    public function run()
    {
        factory(Trainer::class, 1)->create()->each(function ($trainer) {
            factory(Login::class, 1)->create([
                'email' => config('test.seeds.default.email.trainer'),
                'user_type' => Trainer::class,
                'user_id' => $trainer->id,
            ]);
        });
    }
}
