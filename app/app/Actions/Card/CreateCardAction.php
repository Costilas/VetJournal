<?php

namespace App\Actions\Card;

use App\Models\Owner;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CreateCardAction
{
    public function __invoke(array $validatedData)
    {
        DB::beginTransaction();

        try {
            $newOwner = Owner::create($validatedData['owner']);
            $newOwner->pets()->create($validatedData['pet']);

            DB::commit();
        }catch (\Exception $e) {
            Log::debug($e->getMessage());
            DB::rollBack();
            return redirect()->route('cards')
                ->withErrors('При создании карточки произошла ошибка. Перезагрузите страницу и попробуйте снова.');
        }

        return $newOwner;
    }
}
