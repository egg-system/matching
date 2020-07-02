<?php
declare(strict_types=1);

namespace App\Components;

use App\Services\SearchInterface;
use App\Models\MatchingCondition;

class TrainerSearch implements SearchInterface
{
    
    public function findAll(): string
    {        
        // 全検索
        $matchingCondition = MatchingCondition::with(['user', 'area', 'occupation'])->onlyTrainer();
        $conditions = $matchingCondition->get();
    }

    public function findById($id): string
    {
        // idで検索
    }
}