<?php

namespace App\ModelFilters;

use Carbon\Carbon;
use EloquentFilter\ModelFilter;
use http\Exception\InvalidArgumentException;

class VisitFilter extends ModelFilter
{
    public function pet($pet_id): self
    {
        return $this->where('pet_id', $pet_id);
    }

    public function search(array $when): self
    {
        [$from, $to] = $when;

        if (!$from instanceof Carbon || !$to instanceof Carbon) {
            throw new InvalidArgumentException('Ошибка валидации. Даты имеют неверный формат');
        }

        return $this->whereBetween('visit_date', [
            $from->startOfDay()->toDateTimeString(),
            $to->endOfDay()->toDateTimeString()
        ]);
    }

}
