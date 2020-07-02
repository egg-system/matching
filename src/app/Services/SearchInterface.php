<?php
declare(strict_types=1);

namespace App\Services;

interface SearchInterface
{
    public function findAll(): string;
    public function findById($id): string;
}