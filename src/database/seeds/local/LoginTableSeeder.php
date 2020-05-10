<?php

namespace Database\Seeds\Local;

use App\Models\Login;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginTableSeeder extends Seeder
{
    public function run()
    {
        Login::create([
            'email' => 'test@test.co.jp',
            'email_verified_at' => Carbon::now(),
            'password' => 'password',
            'user_type' => 'App\Models\Trainer',
            'user_id' => 1,
        ]);
    }
}
