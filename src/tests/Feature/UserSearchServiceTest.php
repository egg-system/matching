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

use Illuminate\Support\Facades\Log;

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

    protected $gyms;

    protected $trainers;

    protected function setUp(): void
    {
        parent::setUp();

        // UserSearchServiceインスタンス生成
        $this->userSearchService = app(UserSearchService::class);

        $this->gyms = factory(Gym::class, self::GYM_DATA_COUNT)->create();
        $this->trainers = factory(Trainer::class, self::TRAINER_DATA_COUNT)->create();
    }

    private function gymSearchRequestSetUp($param = [])
    {
        // ジム全検索用リクエスト
        $this->requestGym = GymSearchRequest::create(
            route('home.gyms.index'), 'GET', $param, [], [], []);
        $validator = Validator::make($this->requestGym->all(), $this->requestGym->rules());
        $this->requestGym->setValidator($validator);
    }

    private function trainerSearchRequestSetUp($param = [])
    {
        // トレーナー全検索用リクエスト
        $this->requestTrainer = TrainerSearchRequest::create(
            route('home.trainers.index'), 'GET', $param, [], [], []);
        $validator = Validator::make($this->requestTrainer->all(), $this->requestTrainer->rules());
        $this->requestTrainer->setValidator($validator);
    }

    /**
     *  ユーザ全検索
     *  @test
     */
    public function getUserListAll()
    {
        // ジム全検索
        $this->gymSearchRequestSetUp();
        $result = $this->userSearchService->execute($this->requestGym);

        // 全件ジムの情報であること
        $this->assertEquals(count($result), self::GYM_DATA_COUNT);
        collect($result)->each(function ($value, $column) {
            $this->assertEquals($value['user_type'], Gym::class);
        });

        // トレーナー全検索
        $this->trainerSearchRequestSetUp();
        $result = $this->userSearchService->execute($this->requestTrainer);

        // 全件トレーナーの情報であること
        $this->assertEquals(count($result), self::TRAINER_DATA_COUNT);
        collect($result)->each(function ($value, $column) {
            $this->assertEquals($value['user_type'], Trainer::class);
        });
    }

    /**
     *  絞り込み検索（ユーザID）
     *  @test
     */
    public function getUserListSearch()
    {
        // ジム絞り込み検索

        // 検索用ユーザID
        $gymUserId = $this->gyms[0]['id'];
        // ジム検索リクエスト作成
        $this->gymSearchRequestSetUp(['user_id' => $gymUserId]);
        // ユーザ検索実行
        $result = $this->userSearchService->execute($this->requestGym);

        // 検索したユーザIDの情報であること
        collect($result)->each(function ($value, $column) use ($gymUserId) {
            $this->assertEquals($value['user_id'], $gymUserId);
        });
    }
}
