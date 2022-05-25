<?php

namespace App\Actions\Owner;

use App\Models\Owner;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UpdateOwnerAction
{
    public function __invoke(Owner $owner, array $validatedData)
    {
        try{
            $owner->fill($validatedData)?->save()
                ? Session::flash('success', "Профиль владельца успешно отредактирован!")
                : throw new \Exception();
        }catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()
                ->route('owner.show', ['owner' => $owner])
                ->withErrors('Ошибка при редактировании профиля владельца. Перезагрузите страницу и попробуйте снова.');
        }

        return $owner;
    }
}
