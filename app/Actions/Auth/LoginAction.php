<?php

namespace App\Actions\Auth;

use App\Http\Requests\Login\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginAction
{
    public function __invoke(LoginRequest $loginRequest)
    {
        $validatedData = $loginRequest->validated();
        $validatedData['is_active'] = 1;

        if(Auth::attempt($validatedData)) {
            $userName = (Auth::user())->name;
            $successMessage = __('auth.notifications.login.success.first_part')
                . ", $userName. "
                . __('auth.notifications.login.success.last_part');


            $loginRequest->session()->regenerate();
            $return = redirect()->intended(route('notes'))
                ->with('success', $successMessage);
        } else {
            $return = redirect()->route('login')
                ->onlyInput('email')
                ->withErrors(__('auth.notifications.login.failed'));
        }

        return $return;
    }
}
