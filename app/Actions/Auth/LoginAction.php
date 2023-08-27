<?php

namespace App\Actions\Auth;

use App\Helpers\LoginAccess;
use Illuminate\Support\Facades\Auth;

class LoginAction
{
    public function __construct(private LoginAccess $loginAccess)
    {}

    public function __invoke(array $validatedData)
    {
        $userCredentials = $this->loginAccess->formUserCredentials($validatedData);

        return Auth::attempt($userCredentials)
            ? redirect()->intended(route('notes'))
                ->with('success', "Добро пожаловать, " . Auth::user()->name . ". Вход успешно выполнен!")
            : redirect()->route('login')
                ->onlyInput('email')
                ->withErrors('Данные неверны или ваш профиль заблокирован');
    }
}
