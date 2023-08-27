<?php

namespace App\Actions\User\Promotion;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class PromoteUserAction
{
    public function __invoke(User $targetUser):User|RedirectResponse
    {
        try {
            if($targetUser->hasRole('admin')){throw new \Exception();}
            $targetUser->assignRole('admin')
                ? Session::flash('success', "Сотруднику $targetUser->last_name $targetUser->name предоставлены администраторские права.")
                : throw new \Exception();
        } catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()
                ->route('admin.users')
                ->withErrors('Деактивация не удалась. Перезагрузите страницу и попробуйте снова.');
        }

        return $targetUser;
    }
}
