<?php

namespace App\ModelFilters;

use Carbon\Carbon;
use EloquentFilter\ModelFilter;

class VisitFilter extends ModelFilter
{
    private const DATEFORMAT = 'Y-m-d';

    private const FILTERS = [
        'today' => 'today',
        'yesterday' => 'yesterday',
        'week' => '-1 week',
    ];

    public function pet($pet_id):self
    {
        return $this->where('pet_id', $pet_id);
    }

    public function search(string|array $when):self
    {
        if(is_array($when))
        {
            $from = Carbon::createFromFormat(self::DATEFORMAT, $when['from'])->startOfDay()->toDateTimeString();
            $to = Carbon::createFromFormat(self::DATEFORMAT, $when['to'])->endOfDay()->toDateTimeString();
        }elseif (is_string($when)) {
            $date = Carbon::create(self::FILTERS[$when]);
            $date->format(self::DATEFORMAT);
            $from = $date->startOfDay()->toDateTimeString();
            $to = $when==='week'?Carbon::now()->endOfDay()->toDateTimeString():$date->endOfDay()->toDateTimeString();
        }

        return $this->whereBetween('visit_date', [$from, $to]);
    }

}
