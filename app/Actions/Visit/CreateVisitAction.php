<?php

namespace App\Actions\Visit;

use App\Models\Visit;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CreateVisitAction
{
    public function __invoke(array $validatedRequest)
    {
        try{
            $validatedRequest['visit']['weight'] = Visit::weightNormalize($validatedRequest['visit']['weight']);
            $validatedRequest['visit']['temperature'] = Visit::temperatureNormalize($validatedRequest['visit']['temperature']);
            $visit = Visit::create($validatedRequest['visit']);
            Session::flash('success', "Прием успешно добавлен!");
        }catch (\Exception $e){
            Log::debug($e->getMessage());
            return redirect()
                ->route('pet.show', ['pet' => $validatedRequest['visit']['pet_id']])
                ->withErrors('Ошибка при создании према. Перезагрузите страницу и попробуйте снова.');
        }

        return $visit;
    }
}
