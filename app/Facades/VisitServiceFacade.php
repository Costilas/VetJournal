<?php

namespace App\Facades;

class VisitServiceFacade
{
    protected static function getFacadeAccessor():string
    {
        return 'visit.service';
    }
}
