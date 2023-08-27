<?php

namespace App\Actions\User\Edition;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ChangeUserLoginAction
{
    public function __invoke(User $targetUser, array $validatedData):User|RedirectResponse
    {
        try {
            $targetUser->updateOrFail($validatedData['user'])
                ? Session::flash('success', "Логин сотрудника $targetUser->last_name $targetUser->name успешно изменен.")
                : throw new \Exception();
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()
                ->route('admin.user.edit', ['targetUser'=>$targetUser])
                ->withErrors("Логин сотрудника $targetUser->last_name $targetUser->name не был изменен. Перезагрузите страницу и попробуйте снова.");
        }

        return $targetUser;
    }
}
