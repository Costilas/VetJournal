<?php

namespace App\Actions\User\Edition;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UpdateUserAction
{
    public function __invoke(User $targetUser, array $validatedData)
    {
        try {
            $targetUser->updateOrFail($validatedData['user'])
                ? Session::flash('success', "Данные сотрудника успешно изменены.")
                : throw new \Exception();
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()
                ->route('admin.user.edit', ['targetUser'=>$targetUser])
                ->withErrors('Редактирование не удалось. Проверьте введенные данные и попробуйте снова');
        }

        return $targetUser;
    }
}
