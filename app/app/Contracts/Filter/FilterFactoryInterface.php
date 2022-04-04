<?php

namespace App\Contracts\Filter;

interface FilterFactoryInterface
{
    public static function buildQuery(): Filtering;
}
