<?php

namespace App\Services\Search;

interface SearchInterface
{
    /**
     * 検証済みの検索項目を返却.
     */
    public function searchParamValidated();
}
