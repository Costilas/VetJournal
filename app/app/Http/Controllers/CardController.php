<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;

class CardController extends Controller
{


    public function show($id)
    {
        $card = Pet::with('visits', 'owner', 'gender', 'kind')->findOrFail($id);
        dump($card);
    }

    public function create(Request $request)
    {
        echo "Create method";
    }
}
