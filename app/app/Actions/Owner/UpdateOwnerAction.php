<?php

namespace App\Actions\Owner;

use App\Actions\Action;
use App\Models\Owner;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UpdateOwnerAction extends Action
{
    public function __invoke(Owner $owner, array $validatedData)
    {
        try{
            $this->typeChecker->checkArrayDataType($validatedData);
            $owner->fill($validatedData)?->save()
                ? Session::flash('success', "Профиль владельца успешно отредактирован!")
                : throw new \Exception();
        }catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()
                ->route('owner.show', ['owner' => $owner])
                ->withErrors('Ошибка при редактировании профиля владельца. Перезагрузите страницу и попробуйте снова.');
        }

        return redirect()->route('owner.show', ['owner' => $owner]);
    }
}
