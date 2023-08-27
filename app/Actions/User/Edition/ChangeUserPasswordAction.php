<?php

namespace App\Actions\User\Edition;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ChangeUserPasswordAction
{
    public function __invoke(User $targetUser, array $validatedData):User|RedirectResponse
    {
        try {
            $targetUser->updateOrFail(['password'=>Hash::make($validatedData['user']['password'])])
                ? Session::flash('success', "Пароль сотрудника $targetUser->last_name $targetUser->name успешно изменен.")
                : throw new \Exception();
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()
                ->route('admin.user.edit', ['targetUser'=>$targetUser])
                ->withErrors('Изменение пароля не удалось. Перезагрузите страницу и попробуйте снова.');
        }

        return $targetUser;
    }
}
