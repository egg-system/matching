<?php

namespace Tests\Feature;

use App\Http\Requests\GymSearchRequest;
use App\Http\Requests\TrainerSearchRequest;
use App\Models\Area;
use App\Models\Gym;
use App\Models\Trainer;
use App\Services\Search\UserSearchService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserSearchServiceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    const GYM_DATA_COUNT = 10;
    const TRAINER_DATA_COUNT = 10;

    /** @var UserSearchService */
    protected $userSearchService;

    /** @var GymSearchRequest */
    protected $requestGym;

    /** @var TrainerSearchRequest */
    protected $requestTrainer;

    protected function setUp(): void
    {
        parent::setUp();

        // UserSearchServiceインスタンス生成
        $this->userSearchService = app(UserSearchService::class);
    }

    private function gymSearchSetUp($param = [])
    {
        $gyms = factory(Gym::class, self::GYM_DATA_COUNT)->create();

        // ジム全検索用リクエスト
        $this->requestGym = GymSearchRequest::create(
            route('gyms.index'), 'GET', [], [], [], []);
        $validator = Validator::make($this->requestGym->all(), $this->requestGym->rules());
        $this->requestGym->setValidator($validator);
    }

    private function trainerSearchSetUp($param = [])
    {
        $trainers = factory(Trainer::class, self::TRAINER_DATA_COUNT)->create();

        // トレーナー全検索用リクエスト
        $this->requestTrainer = TrainerSearchRequest::create(
            route('trainers.index'), 'GET', $param, [], [], []);
        $validator = Validator::make($this->requestTrainer->all(), $this->requestTrainer->rules());
        $this->requestTrainer->setValidator($validator);
    }

    /**
     *  ユーザ全検索
     *  @test
     */
    public function getUserListAll()
    {
        $this->withExceptionHandling();

        // ジム全検索
        $this->gymSearchSetUp();
        $result = $this->userSearchService->execute($this->requestGym);

        // 全件ジムの情報であること
        $this->assertEquals(count($result), self::GYM_DATA_COUNT);
        collect($result)->each(function ($value, $column) {
            $this->assertEquals($value['user_type'], Gym::class);
        });

        // トレーナー全検索
        $this->trainerSearchSetUp();
        $result = $this->userSearchService->execute($this->requestTrainer);

        // 全件トレーナーの情報であること
        $this->assertEquals(count($result), self::TRAINER_DATA_COUNT);
        collect($result)->each(function ($value, $column) {
            $this->assertEquals($value['user_type'], Trainer::class);
        });
    }
}
