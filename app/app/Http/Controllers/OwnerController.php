<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function show($id)
    {
        $owner = Owner::with('pets')->findOrFail($id);

        return view('owner.show', compact('owner'));
    }
}