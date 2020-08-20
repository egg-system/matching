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
     *  ジム一覧全件
     *  @test
     */
    public function gymListAll()
    {
        // 全検索
        $searchResponse = $this
            ->actingAs($this->owner->login)
            ->get(route('home.gyms.index'));
        $searchResponse->assertStatus(200);
    }

    public function gymListRefineSearchDataProvider()
    {
        return[
            ['user_id', 1],
            ['occupation_id', 1],
            ['area_id', 1],
            ['can_work_holiday', true],
            ['can_work_weekday', true],
            ['can_adjust', true],
        ];
    }

    public function gymListValidateErrorByTypeDifferenceDataProvider()
    {
        return[
            ['user_id', 'userid'],
            ['occupation_id', 'occupationid'],
            ['area_id', 'areaid'],
            ['can_work_holiday', 2],
            ['can_work_weekday', 2],
            ['can_adjust', 2],
        ];
    }

    public function gymListValidateErrorByNotExistDataProvider()
    {
        return[
            ['user_id', 99999],
            ['occupation_id', 99999],
            ['area_id', 99999],
        ];
    }

    /**
     *  ジム一覧絞り込み検索
     *  @dataProvider gymListRefineSearchDataProvider
     *  @test
     */
    public function gymListRefineSearch($column, $value)
    {
        // 絞り込み検索
        $searchResponse = $this
            ->actingAs($this->owner->login)
            ->get(route('home.gyms.index', [
                $column => $value
            ]));
        $searchResponse->assertStatus(200);
    }

    /**
     *  ジム一覧 バリデーションエラー（型判定エラー）
     *  @dataProvider gymListValidateErrorByTypeDifferenceDataProvider
     *  @test
     */
    public function gymListValidateErrorByTypeDifference($column, $value)
    {
        $this->withExceptionHandling();

        // 絞り込み検索
        $searchResponse = $this
            ->actingAs($this->owner->login)
            ->get(route('home.gyms.index', [
                $column => $value
            ]));
        $searchResponse->assertStatus(302);
    }

    /**
     *  ジム一覧 バリデーションエラー（存在判定エラー）
     *  @dataProvider gymListValidateErrorByNotExistDataProvider
     *  @test
     */
    public function gymListValidateErrorByNotExist($column, $value)
    {
        $this->withExceptionHandling();

        // 絞り込み検索
        $searchResponse = $this
            ->actingAs($this->owner->login)
            ->get(route('home.gyms.index', [
                $column => $value
            ]));
        $searchResponse->assertStatus(302);
    }
}
