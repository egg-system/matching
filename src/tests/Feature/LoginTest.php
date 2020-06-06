<?php

namespace Tests\Feature;

use App\Models\Gym;
use App\Models\Login;
use App\Models\Trainer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function trainer_login()
    {
        $login = factory(Login::class)->create();
        $trainer = factory(Trainer::class)->create();
        $trainer->login()->save($login);

        $response = $this->post(route('trainer.login', ['email' => $login->email, 'password' => 'password']));

        $response->assertStatus(302);
        $this->assertAuthenticated();
    }

    /**
     * @test
     */
    public function gymowner_login()
    {
        $login = factory(Login::class)->create();
        $owner = factory(Gym::class)->create();
        $owner->login()->save($login);

        $response = $this->post(route('gym.login', ['email' => $login->email, 'password' => 'password']));

        $response->assertStatus(302);
        $this->assertAuthenticated();
    }
}
