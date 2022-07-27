<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class UserFilter extends ModelFilter
{
    /**
    * Related Models that have ModelFilters as well as the method on the ModelFilter
    * As [relationMethod => [input_key1, input_key2]].
    *
    * @var array
    */
    public $relations = [];

    public function search(string $who = null):UserFilter
    {
        switch ($who) {
            case 'active':
                $this->where('is_active',  '1');
                break;
            case 'inactive':
                $this->where('is_active', '0');
                break;
        }

        return $this;
    }
}
