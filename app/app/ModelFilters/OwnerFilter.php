<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;

class OwnerFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function name($name)
    {
        return $this->where('name', 'LIKE', "$name%");
    }

    public function lastName($lastName)
    {
        return $this->where('last_name','LIKE', "$lastName%");
    }

    public function patronymic($patronymic)
    {
        return $this->where('patronymic','LIKE', "$patronymic%");
    }

    public function phone($phone)
    {
        return $this->where('phone', 'LIKE', "$phone%");
    }

    public function pets($pet_name)
    {
        $this->related('pets', 'pet_name', 'LIKE', "$pet_name%");
    }
}
