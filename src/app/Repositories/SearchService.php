<?php

namespace App\Repositories;

class SearchService
{
    protected $searchInterface;

    public function __construct(SearchInterface $searchInterface)
    {
        $this->searchInterface = $searchInterface;
    }

    public function matchingConditionSearch(Request $request)
    {
        return $this->searchInterface->matchingConditionSearch($request);
    }

    public function detailSearch(Request $request)
    {
        return $this->searchInterface->detailSearch($request);
    }

    public function profileSearch(Request $request)
    {
        return $this->searchInterface->profileSearch($request);
    }

    public function messageSearch(Request $request)
    {
        return $this->searchInterface->messageSearch($request);
    }
}
