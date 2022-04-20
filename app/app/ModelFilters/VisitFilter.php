<?php

namespace App\ModelFilters;

use Carbon\Carbon;
use EloquentFilter\ModelFilter;
use Illuminate\Support\Facades\Log;

class VisitFilter extends ModelFilter
{
    private const DATEFORMAT = 'Y-m-d';

    public function pet($pet_id):self
    {
        return $this->where('pet_id', $pet_id);
    }

    public function search(array $when):self
    {
        try{
            if(strtotime($when['from'])>strtotime($when['to'])){throw new \Exception('Попытка вручную поменять настройки максимального порога дат.');}
            $start = $when['from'];
            $end = $when['to'];
        }catch(\Exception $e){
            Log::debug($e->getMessage());
            //If validation before_or_equal is corrupted somehow then from becomes to and to - from
           $start = $when['to'];
           $end = $when['from'];
        }
        $from = Carbon::createFromFormat(self::DATEFORMAT, $start)->startOfDay()->toDateTimeString();
        $to = Carbon::createFromFormat(self::DATEFORMAT, $end)->endOfDay()->toDateTimeString();

        return $this->whereBetween('visit_date', [$from, $to]);
    }

}
