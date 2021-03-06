<?php

namespace Tests\Feature;

use App\Models\Area;
use App\Models\Gym;
use App\Models\Login;
use App\Models\MatchingCondition;
use App\Models\Occupation;
use App\Models\Trainer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GymOwnerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->owner = factory(Gym::class)->create();
    }

    /**
     *  トレーナー一覧
     *  @test
     */
    public function traienrList()
    {
        $this->withExceptionHandling();

        $trainers = factory(Trainer::class, 10)->create();
        $trainers->each(function ($trainer) {
            if (Area::exists()) {
                factory(Area::class)->create();
            }

            factory(MatchingCondition::class)->create([
                'user_id' => $trainer->id,
                'user_type' => Trainer::class,
                'area_id' => Area::inRandomOrder()->first()->id,
            ]);
        });

        $searchResponse = $this
            ->actingAs($this->owner->login)
            ->get(route('home.trainers.index', [
                'user_type' => 'App\Models\Gym'
            ]));

        $searchResponse->assertStatus(200);
    }
}
