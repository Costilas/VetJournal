<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class PasswordServiceFacade extends Facade
{
    protected static function getFacadeAccessor():string
    {
        return 'password.service';
    }
}
