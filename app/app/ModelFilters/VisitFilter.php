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

    public function search(array $when)
    {
        try{
            //If date validation is broken somehow and is not a date format
            if(!strtotime($when['from'])&&!strtotime($when['to'])){throw new \Exception('Ошибка валидации. Даты имеют неверный формат');}

            //If start date greater than end date then we need to revert it
            $start = strtotime($when['from'])>strtotime($when['to'])?$when['to']:$when['from'];
            $end = strtotime($when['from'])>strtotime($when['to'])?$when['from']:$when['to'];
            $from = Carbon::createFromFormat(self::DATEFORMAT, $start)->startOfDay()->toDateTimeString();
            $to = Carbon::createFromFormat(self::DATEFORMAT, $end)->endOfDay()->toDateTimeString();
        }catch(\Exception $e){
            Log::debug($e->getMessage());
           return redirect()->back()->withErrors($e->getMessage());
        }

        return $this->whereBetween('visit_date', [$from, $to]);
    }

}
