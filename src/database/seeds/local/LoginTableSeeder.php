<?php

namespace Database\Seeds\Local;

use App\Models\Login;
use Illuminate\Database\Seeder;

class LoginTableSeeder extends Seeder
{
    public function run()
    {
        factory(Login::class, 1)->create([
            'email' => config('database.seeds.default.email')
        ]);
    }
}
