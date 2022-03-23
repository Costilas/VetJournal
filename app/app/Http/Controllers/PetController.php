<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function show($id)
    {
        $card = Pet::with('visits', 'owner', 'gender', 'kind')->findOrFail($id);

        return view('pet.show', compact('card'));
    }
}
