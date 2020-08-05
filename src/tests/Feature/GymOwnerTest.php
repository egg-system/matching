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

        $trainers = factory(Trainer::class, 10)->create()->each(function ($trainer) {
            $trainer->matchingCondition()->create(
                [
                    'area_id' => (Area::inRandomOrder()->first())->id ?? factory(Area::class)->create()->id
                ]
            );
        });

        $search_response = $this->actingAs($this->owner->login)->get(route('gyms.trainerList') . '?user_type=App\Models\Trainer');

        $search_response->assertStatus(200);
    }
}
