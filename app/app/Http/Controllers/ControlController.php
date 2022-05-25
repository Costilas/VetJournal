<?php

namespace App\Http\Controllers;

use App\Actions\Control\GetMissedPetsAction;

class ControlController extends Controller
{
    public function index(GetMissedPetsAction $getMissedPetsAction)
    {
       return view('control.index', ['missedPets' => $getMissedPetsAction()]);
    }
}
