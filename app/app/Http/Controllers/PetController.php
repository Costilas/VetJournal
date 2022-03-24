<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PetController extends Controller
{
    public function show($id)
    {
        $pet = Pet::with('owner', 'gender', 'kind', 'owner.pets')->findOrFail($id);

        $visits = Visit::where('pet_id', '=', $id)->orderBy('visit_date', 'DESC')->paginate(10);

        return view('pet.show', compact('pet', 'visits'));
    }
}
