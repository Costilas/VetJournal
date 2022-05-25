<?php

namespace App\Actions\Pet;

use App\Models\Pet;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AddPetToOwnerAction
{
    public function __invoke(array $validatedData)
    {
        try{
            $newPet = Pet::create($validatedData['pet']);
            Session::flash('success', "Питомец $newPet->name успешно добавлен.");
        }catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()->route('owner.show', ['owner' => $validatedData['pet']['owner_id']])
                ->withErrors('Питомец не был добавлен. Проверьте введенные данные.');
        }

        return $newPet;
    }
}
