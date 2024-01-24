<?php

namespace App\Http\Controllers;

use App\Services\Pet\PetService;

class ControlController extends Controller
{
    public function __construct(
        protected PetService $petService
    )
    {}

    public function index()
    {
        $petWithoutVisits = $this->petService->getPetsWithoutVisits(10);

       return view('control.index', ['missedPets' => $petWithoutVisits]);
    }
}
