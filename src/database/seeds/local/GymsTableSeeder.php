<?php

namespace Database\Seeds\Local;

use App\Models\Gym;
use App\Models\Login;
use Illuminate\Database\Seeder;

class GymsTableSeeder extends Seeder
{
    public function run()
    {
        factory(Gym::class, 1)->create()->each(function ($gym) {
            factory(Login::class, 1)->create([
                'email' => config('test.seeds.default.email.gym'),
                'user_type' => Gym::class,
                'user_id' => $gym->id,
            ]);
        });
    }
}
