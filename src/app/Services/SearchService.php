<?php
declare(strict_types=1);

namespace App\Services;

class SearchService
{
    protected $searchComponent;

    public function __construct(SearchInterface $searchComponent)
    {
        $this->searchComponent = $searchComponent;
    }

    public function findAll()
    {
        return $this->searchComponent->findAll();
    }

    public function findById($id)
    {
        return $this->searchComponent->findById($id);
    }
}
