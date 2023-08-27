<?php

namespace App\Actions\User\Promotion;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class DemoteUserAction
{
    public function __invoke(User $targetUser):User|RedirectResponse
    {
        try {
            !$targetUser->hasRole('admin')?? throw new \Exception();
            $targetUser->removeRole('admin')
                ? Session::flash('success', "С сотрудника $targetUser->last_name $targetUser->name сняты администраторские права.")
                : throw new \Exception();
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()
                ->route('admin.users')
                ->withErrors('Операция изменения прав не удалась. Перезагрузите страницу и попробуйте снова.');
        }

        return $targetUser;
    }
}
