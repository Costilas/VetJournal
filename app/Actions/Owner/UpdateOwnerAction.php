<?php

namespace App\Actions\Owner;

use App\Models\Owner;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UpdateOwnerAction
{
    public function __invoke(Owner $owner, array $validatedData)
    {

        return $owner;
    }
}
