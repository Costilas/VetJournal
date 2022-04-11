<?php

namespace App\Services;

class PasswordService
{
    public static function salting(string $freshPassword):string
    {
        $salt = 'vetjournal';

        return $freshPassword.$salt;
    }
}
