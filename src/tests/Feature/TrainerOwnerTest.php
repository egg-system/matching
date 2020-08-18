<?php

namespace Tests\Feature;

use App\Models\Area;
use App\Models\Gym;
use App\Models\Login;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TrainerOwnerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->owner = factory(Gym::class)->create();
    }

    /**
     *  ジム一覧
     *  @test
     */
    public function gymList()
    {
        $this->withExceptionHandling();

        $gyms = factory(Gym::class, 10)->create();
        $gyms->each(function ($gyms) {
            if (Area::exists()) {
                factory(Area::class)->create();
            }

            $gyms->matchingCondition()->create(
                [
                    'area_id' => Area::inRandomOrder()->first()->id,
                ]
            );
        });

        // 全検索
        $searchResponse = $this
            ->actingAs($this->owner->login)
            ->get(route('home.gyms.index'));

        $searchResponse->assertStatus(200);

        // 絞り込み検索
        $searchResponse = $this
            ->actingAs($this->owner->login)
            ->get(route('home.gyms.index', [
                'user_id' => '1'
            ]));

        $searchResponse->assertStatus(200);
    }
}
