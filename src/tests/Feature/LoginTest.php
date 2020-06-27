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
    use RefreshDatabase, WithFaker, WithoutMiddleware;

    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function trainer_login()
    {
        $trainer = factory(Trainer::class)->create();

        $response = $this->post(route('trainer.login', ['email' => $trainer->login->email, 'password' => 'password']));

        $response->assertStatus(302);
        $this->assertAuthenticated();
    }

    /**
     * @test
     */
    public function gymowner_login()
    {
        $owner = factory(Gym::class)->create();

        $response = $this->post(route('gym.login', ['email' => $owner->login->email, 'password' => 'password']));

        $response->assertStatus(302);
        $this->assertAuthenticated();
    }
}
