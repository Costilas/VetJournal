<?php

namespace App\Helpers;

class ValidatedArrayTypeChecker
{
    public function checkArrayDataType(mixed $validatedData):\Exception|array
    {
        if(!is_array($validatedData)) throw new \Exception();

        return $validatedData;
    }
}
