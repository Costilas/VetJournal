<?php

namespace App\Filters;

use App\Models\Owner;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;


class CardFilter extends Filter
{
    const MODEL = 'owner';

    const FILLABLES = [
        self::MODEL => ['name', 'patronymic', 'last_name', 'phone'],
        'pets' => ['pet_name'],
    ];

    public function runFiltering():Collection
    {
        foreach ($this->queryData as $model => $inputs) {
            if (key_exists($model, self::FILLABLES)) {
                foreach ($inputs as $input => $value) {
                    if (in_array($input, self::FILLABLES[$model])) {
                        $this->filterAdd($model, $input, $value);
                    }
                }
            }
        }

        return $this->queryBuilder->pluck('id');
    }

    public function filterAdd(string $model, string $fillable, mixed $value, string $operator = 'LIKE'): void
    {
        if ($model === self::MODEL) {
            $this->queryBuilder->where($fillable, $operator, "$value%");
        } else {
            $this->queryBuilder->whereHas($model, fn($query) => $query->where($fillable, $operator, "$value%"));
        }
    }
}
