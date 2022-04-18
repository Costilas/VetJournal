<?php

namespace App\ModelFilters;

use Carbon\Carbon;
use EloquentFilter\ModelFilter;

class VisitFilter extends ModelFilter
{
    private const DATEFORMAT = 'Y-m-d';

    public function pet($pet_id):self
    {
        return $this->where('pet_id', $pet_id);
    }

    public function search(array $when):self
    {
        $from = Carbon::createFromFormat(self::DATEFORMAT, $when['from'])->startOfDay()->toDateTimeString();
        $to = Carbon::createFromFormat(self::DATEFORMAT, $when['to'])->endOfDay()->toDateTimeString();

        return $this->whereBetween('visit_date', [$from, $to]);
    }

}
