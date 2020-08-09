<?php

namespace App\Http\Controllers;

use App\Http\Requests\Gym\TrainerSearchRequest;
use App\Models\Gym;
use App\Models\MatchingCondition;
use App\Repositories\UserRepository;
use App\Services\Search\UserSearchService;

class GymsController extends Controller
{
    /** @var UserRepository  */
    protected $userRepository;

    /** @var UserSearchService  */
    protected $userSearchService;

    public function __construct(UserRepository $userRepository, UserSearchService $userSearchService)
    {
        $this->userRepository = $userRepository;
        $this->userSearchService = $userSearchService;

        $this->authorizeResource(Gym::class);
    }

    public function index()
    {
        return view('pages.gyms.index');
    }

    /**
     * トレーナの一覧表示画面(検索付)
     */
    public function trainerList(TrainerSearchRequest $request)
    {
        $conditions = $this->userSearchService->execute($request);
        return view('pages.gyms.trainerList', compact('conditions'));
    }
}
