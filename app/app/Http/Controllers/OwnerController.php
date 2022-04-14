<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Pet;

class OwnerController extends Controller
{
    public function show($id)
    {
        $owner = Owner::findOrFail($id);
        $pets = Pet::where('owner_id', $id)->with('kind', 'gender')->paginate(5);

        return view('owner.show', compact('owner', 'pets'));
    }
}
