<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class VisitFilter extends ModelFilter
{

    public function pet($pet_id)
    {
        return $this->where('pet_id', '=', $pet_id);
    }

    public function visits($visit_date)
    {
        $dayRangeFrom = ' 00:00:01';
        $dayRangeTo = ' 23:59:59';
        return $this->whereBetween('visit_date', [$visit_date['from'] . $dayRangeFrom, $visit_date['to'] . $dayRangeTo]);
    }

    public function search($when)
    {
        $dayRangeFrom = ' 00:00:01';
        $dayRangeTo = ' 23:59:59';
        switch ($when) {
            case 'today':
                return $this->whereBetween('visit_date',
                    [
                        date('Y-m-d'.$dayRangeFrom, time()),
                        date('Y-m-d'.$dayRangeTo, time())
                    ]
                );
            case 'yesterday':
                return $this->whereBetween('visit_date',
                    [
                        date('Y-m-d'.$dayRangeFrom, strtotime('-1day')),
                        date('Y-m-d'.$dayRangeTo, strtotime('-1day'))
                    ]
                );
            case 'week':
                return $this->whereBetween('visit_date',
                    [
                        date('Y-m-d'.$dayRangeFrom, strtotime('-1week')),
                        date('Y-m-d'.$dayRangeTo, time())
                    ]
                );
            default:
                return null;
        }

    }

}
