<?php

namespace App\Actions\Owner;

use App\Models\Owner;

class ShowOwnerAction
{
    public function __invoke(Owner $owner)
    {
        return view('owner.show', [
            'owner' => $owner,
            'pets' => $owner->pets()->with('kind', 'gender', 'castration')->paginate(5)
        ]);
    }
}
