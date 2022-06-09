<?php

namespace App\Actions\Visit;

use App\Models\Visit;

class SearchVisitsAction
{
    public function __invoke(array $searchDateRange)
    {
        return Visit::filter($searchDateRange)->with('pet', 'user')
            ->orderBy('id', 'DESC')
            ->paginate(10)
            ->withQueryString();
    }
}
