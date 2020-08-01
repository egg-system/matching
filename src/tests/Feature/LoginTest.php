<?php

namespace Tests\Feature;

use App\Models\Gym;
use App\Models\Login;
use App\Models\Trainer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function trainerLogin()
    {
        $trainer = factory(Trainer::class)->create();

        $response = $this->post(route('login.posts', [
            'userType' => 'trainer',
        ], [
            'email' => $trainer->login->email,
            'password' => 'password',
            'user_type' => Trainer::class,
        ]));

        $response->assertStatus(302);
        $this->assertAuthenticated();
    }

    /**
     * @test
     */
    public function gymLogin()
    {
        $owner = factory(Gym::class)->create();

        $response = $this->post(route('login.posts', [
            'userType' => 'gym',
        ], [
            'email' => $owner->login->email,
            'password' => 'password',
            'user_type' => Gym::class,
        ]));

        $response->assertStatus(302);
        $this->assertAuthenticated();
    }
}
