<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrainerSearchRequest;
use App\Models\MatchingCondition;
use App\Services\Search\UserSearchService;

use Illuminate\Support\Facades\Log;

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
        $conditions = $this->userSearchService->execute($request);
        return view('pages.trainers.index', compact('conditions'));
    }
}
