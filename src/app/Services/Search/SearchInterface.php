<?php

namespace App\Services\Search;

interface SearchInterface
{
    /**
     * 検索項目を返却.
     *
     * @return array [searchColumn => searchValue]
     */
    public function searchParameters();
}
