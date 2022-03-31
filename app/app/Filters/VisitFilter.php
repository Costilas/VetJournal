<?php

namespace App\Filters;

use Illuminate\Support\Collection;

class VisitFilter extends Filter
{
    const MODEL = 'visit';

    const FILLABLES = [
        self::MODEL => ['date_start', 'date_end', 'today', 'yesterday', 'week'],
    ];

    public function runFiltering():Collection
    {
        foreach ($this->queryData as $model => $inputs) {
            if (key_exists($model, self::FILLABLES)) {
                foreach ($inputs as $input => $value) {
                    if (in_array($input, self::FILLABLES[$model])) {
                        $checkedData[$input] = $value;
                    }
                }

                $this->filterAdd($model, 'visit_date', $checkedData, '=');
            }
        }

        return $this->queryBuilder->pluck('id');
    }

    public function filterAdd(string $model, string $fillable, mixed $value, string $operator = 'LIKE'): void
    {
        if ($model === self::MODEL) {
            $this->queryBuilder->where('pet_id', $operator, $value['pet_id'])->whereBetween($fillable, [$value['date_start'].' 00:00:00', $value['date_end'].' 23:59:59']);
        }
    }
}
