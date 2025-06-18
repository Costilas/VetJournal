<?php

namespace App\Actions\Common;

use App\Utility\Helpers\FilterConditionDescriber;

class DescribeFilterAction
{
    public function __construct(private FilterConditionDescriber $filterDescriber)
    {}

    public function __invoke(array $validatedData):array
    {
        return $this->filterDescriber->describeFilterCondition($validatedData);
    }
}
