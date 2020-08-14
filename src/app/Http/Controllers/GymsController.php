<?php

namespace App\Http\Controllers;

use App\Http\Requests\GymSearchRequest;
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

    /**
     * ジム一覧画面表示(検索付)
     */
    public function index(GymSearchRequest $request)
    {
        $gymSearchResult = $this->userSearchService->execute($request);
        return view('pages.gyms.index', compact('gymSearchResult'));
    }
}
