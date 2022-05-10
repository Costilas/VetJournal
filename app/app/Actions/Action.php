<?php

namespace App\Actions;

use App\Helpers\ValidatedArrayTypeChecker;

class Action
{
    protected ValidatedArrayTypeChecker $typeChecker;

    public function __construct()
    {
        $this->typeChecker = new ValidatedArrayTypeChecker();
    }
}
