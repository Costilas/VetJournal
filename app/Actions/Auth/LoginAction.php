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
            $loginRequest->session()->regenerate();
            $return = redirect()->intended(route('notes'))
                ->with('success', "Добро пожаловать, " . (Auth::user())->name . ". Вход успешно выполнен!");
        } else {
            $return = redirect()->route('login')
                ->onlyInput('email')
                ->withErrors('Данные неверны или ваш профиль заблокирован');
        }

        return $return;
    }
}
