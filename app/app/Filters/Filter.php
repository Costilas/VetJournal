<?php

namespace App\Filters;

use App\Contracts\Filter\Filtering;

abstract class Filter implements Filtering
{
    const MODEL = '';

    const FILLABLES = [
        self::MODEL => [],
    ];

    protected array $queryData = [];
    protected $queryBuilder;

    public function __construct(string $className, array $validatedRequestData)
    {
        $this->queryData = $this->prepareData($validatedRequestData);
        $model = new $className();
        $this->queryBuilder = $model->query();
    }


    protected function prepareData(array $rawValidatedData): array
    {
        return $this->filterData($rawValidatedData);
    }

    protected function filterData(array $queryData):array
    {
        return array_filter($queryData);
    }
}
