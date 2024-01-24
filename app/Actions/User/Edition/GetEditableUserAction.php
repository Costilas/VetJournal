<?php

namespace App\Actions\User\Edition;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GetEditableUserAction
{
    public function __invoke(User $targetUser):User|RedirectResponse
    {
        try{
            $currentUser = Auth::user();
            if($targetUser->is_dev && ! $currentUser->is_dev){throw new \Exception();}
        }catch (\Exception $e) {
            Log::debug($e->getMessage());
            return redirect()->route('admin.users')->withErrors('Вы не имеете право, на данное действие');
        }
        return $targetUser;
    }
}
