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
    protected Login $login;
    protected Gym $owner;

    protected function setUp(): void
    {
        parent::setUp();

        $this->login = factory(Login::class)->create();
        $this->owner = factory(Gym::class)->create();
        $this->owner->login()->save($this->login);
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
                    'area_id' => (Area::inRandomOrder()->first())->id ?? factory(Area::class)->create()->id,
                    'occupation_id' => (Occupation::inRandomOrder()->first())->id ?? factory(Occupation::class)->create()->id,
                    'price' => [
                        'min' => 100,
                        'test' => 'test'
                    ]
                ]
            );
        });
        $response = $this->actingAs($this->login)->get(route('gymowner.trainerList'));

        $response->assertStatus(200)->assertSee(100)->assertSee('test');

        $search_response = $this->actingAs($this->login)->get(route('gymowner.trainerList'), [
            'price' => ['min' => 100]
        ]);

        $search_response->assertStatus(200)->assertSee(100)->assertSee('test');
    }
}
