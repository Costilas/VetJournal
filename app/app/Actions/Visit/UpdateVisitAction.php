<?php

namespace App\Actions\Visit;

use App\Models\Visit;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UpdateVisitAction
{
    public function __invoke(array $validatedRequest, int $id)
    {
        try {
            $validatedRequest['visit']['weight'] = Visit::weightNormalize($validatedRequest['visit']['weight']);
            $validatedRequest['visit']['temperature'] = Visit::temperatureNormalize($validatedRequest['visit']['temperature']);
            $visit = Visit::find($id);
            $visit->update($validatedRequest['visit'])?
                Session::flash('success', "Прием успешно изменен!"):
                throw new \Exception();
        }catch (\Exception $e){
            Log::debug($e->getMessage());
            return redirect()
                ->route('visit.edit', ['id'=>$id])
                ->withErrors('Произошла ошибка обновления приема, обновите страницу и попробуйте снова.');
        }

        return $visit;
    }
}
