<?php

namespace App\Actions\User\Activation;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ActivateUserAction
{
    public function __invoke(User $targetUser):User|RedirectResponse
    {
        try {
            $targetUser->updateOrFail(['is_active'=>1])
                ? Session::flash('success', "Профиль сотрудника $targetUser->last_name $targetUser->name успешно активирован.")
                : throw new \Exception();
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()
                ->route('admin.users')
                ->withErrors('Активация не удалась. Перезагрузите страницу и попробуйте снова.');
        }

        return $targetUser;
    }
}
