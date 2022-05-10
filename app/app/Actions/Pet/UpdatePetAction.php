<?php

namespace App\Actions\Pet;

use App\Actions\Action;
use App\Models\Pet;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UpdatePetAction extends Action
{
    public function __invoke(Pet $pet, array $validatedData)
    {
        try{
            $pet->fill($this->typeChecker->checkArrayDataType($validatedData['pet']))?->save()
                ? Session::flash('success', "Питомец успешно отредактирован!")
                : throw new \Exception();
        }catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()
                ->route('pet.edit', ['pet' => $pet])
                ->withErrors('Ошибка при редактирования питомца. Перезагрузите страницу и попробуйте снова.');
        }

        return redirect()->route('pet.edit', ['pet' => $pet]);
    }
}
