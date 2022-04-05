<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class VisitFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */


    public function pet($pet_id)
    {
        return $this->where('pet_id', '=', $pet_id);
    }

    public function visits($visit_date)
    {
        return $this->whereBetween('visit_date', [$visit_date['from'] . ' 00:00:01', $visit_date['to'] . ' 23:59:59']);
    }

    public function search($when)
    {
        switch ($when) {
            case 'today':
                return $this->whereBetween('visit_date',
                    [
                        date('Y-m-d 00:00:01', time()),
                        date('Y-m-d 23:59:59', time())
                    ]
                );
            case 'yesterday':
                return $this->whereBetween('visit_date',
                    [
                        date('Y-m-d 00:00:01', strtotime('-1day')),
                        date('Y-m-d 23:59:59', strtotime('-1day'))
                    ]
                );
            case 'week':
                return $this->whereBetween('visit_date',
                    [
                        date('Y-m-d 00:00:01', strtotime('-1week')),
                        date('Y-m-d 23:59:59', time())
                    ]
                );
            default:
                return null;
        }

    }

}
