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

}
