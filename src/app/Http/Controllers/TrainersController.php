<?php

namespace App\Http\Controllers;

use App\Models\MatchingCondition;
use App\Models\Trainer;
use App\Http\Requests\TrainerSearchRequest;
use App\Services\Search\UserSearchService;

class TrainersController extends Controller
{
    /** @var UserSearchService  */
    protected $userSearchService;

    public function __construct(UserSearchService $userSearchService)
    {
        $this->userSearchService = $userSearchService;
    }

    /**
     * トレーナの一覧表示画面(検索付)
     */
    public function index(TrainerSearchRequest $request)
    {
        $macthingConditions = $this->userSearchService->execute($request);
        return view('pages.trainers.index', compact('macthingConditions'));
    }

    public function show(Trainer $trainer)
    {
        return view('pages.trainers.show', compact('trainer'));
    }
}
