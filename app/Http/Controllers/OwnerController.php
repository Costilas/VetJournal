<?php

namespace App\Http\Controllers;

use App\Actions\Owner\ShowOwnerAction;
use App\Actions\Owner\UpdateOwnerAction;
use App\Http\Requests\Owner\EditRequest;
use App\Models\Owner;

class OwnerController extends Controller
{
    public function show(Owner $owner, ShowOwnerAction $showOwnerAction)
    {
        return $showOwnerAction($owner);
    }

    public function update(EditRequest $request, Owner $owner, UpdateOwnerAction $updateOwnerAction)
    {
        return redirect()->route('owner.show', ['owner'=>$updateOwnerAction($owner, $request->validated())]);
    }
}
