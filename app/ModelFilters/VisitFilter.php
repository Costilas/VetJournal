<?php

namespace App\ModelFilters;

use Carbon\Carbon;
use EloquentFilter\ModelFilter;
use Exception;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\Log;

class VisitFilter extends ModelFilter
{
    private const DATEFORMAT = 'Y-m-d';

    public function pet($pet_id): self
    {
        return $this->where('pet_id', $pet_id);
    }

    public function search(array $when)
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
