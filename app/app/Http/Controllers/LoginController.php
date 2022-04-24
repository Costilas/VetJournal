<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    private const ACCESS = [
        'is_active' => 1,
    ];

    public function login()
    {
        return view('login.index');
    }

    public function auth(LoginRequest $request)
    {
        $userCredentials = array_merge($request->validated(), self::ACCESS);

        return Auth::attempt($userCredentials)
            ? redirect()->intended(route('notes'))
                ->with('success', "Добро пожаловать, " . Auth::user()->name . ". Вход успешно выполнен!")
            : redirect()->route('login')
                ->onlyInput('email')
                ->withErrors('Данные неверны или ваш профиль заблокирован');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if (!Auth::check()) {
            Session::flash('success', "Выход выполнен!");
        }
        return redirect()->route('login');
    }
}
