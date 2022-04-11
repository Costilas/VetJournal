<?php

namespace App\ModelFilters;

use EloquentFilter\ModelFilter;
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


    public function search($who)
    {
        Auth::user()->is_dev?$this->select('*'):$this->where('is_dev', '!=', '1');
        switch ($who) {
            case 'active':
                return $this->where('is_active', '=', '1');

            case 'inactive':
                return $this->where('is_active', '=', '0');

            default:
                return $this;
        }

    }
}
