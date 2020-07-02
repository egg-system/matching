<?php
declare(strict_types=1);

namespace App\Components;

use App\Services\SearchInterface;

class GymSearch implements SearchInterface
{
    public function findAll(): string
    {
        // 全検索
        $matchingCondition = MatchingCondition::with(['user', 'area', 'occupation'])->onlyGym();
        $conditions = $matchingCondition->get();
    }

    public function findById($id): string
    {
        // idで検索
    }
}