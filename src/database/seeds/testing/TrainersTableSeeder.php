<?php

namespace Database\Seeds\Testing;

use App\Models\Login;
use App\Models\Trainer;
use Illuminate\Database\Seeder;

class TrainersTableSeeder extends Seeder
{
    public function run()
    {
        $trainer = factory(Trainer::class)->create();

        $loginEmail = config('test.seeds.default.email.trainer');
        if (Login::where('email', $loginEmail)->exists()) {
            return;
        }

        $trainer->login->update([
            'email' => $loginEmail,
        ]);
    }
}
