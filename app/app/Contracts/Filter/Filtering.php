<?php

namespace App\Contracts\Filter;

use Illuminate\Support\Collection;

interface Filtering
{
    function runFiltering();

    function filterAdd(string $model, string $fillable, mixed $value, string $operator): void;
}
