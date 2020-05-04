<?php

namespace Tests\Feature;

use App\Models\Login;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OnlyAccessGymOwner extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * ミドルウェアテスト
     * @test
     */
    public function can_accsess_only_gymowner()
    {
        $login = factory(Login::class)->create();
        $trainer = factory(Trainer::class)->create();
        // 認証済みに
        $this->assertAuthenticatedAs($trainer->login()->save($login), 'auth');

        $response = $this->get(route('gymowner.index'));

        $response->assertStatus(403);
    }
}
