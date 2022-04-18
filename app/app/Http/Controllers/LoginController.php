<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login\LoginRequest;
use App\Services\PasswordService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    public function auth(LoginRequest $request)
    {
        if (Auth::attempt(
            [
                'email' => $request['user']['email'],
                'password' => $request['user']['password'],
                'is_active' => 1
            ]
        )) {
            Session::flash('success', "Добро пожаловать, " . Auth::user()->name . ". Вход успешно выполнен!");
            return redirect()->route('notes');
        }

        return redirect()->back()->withErrors('Данные неверны или ваш профиль заблокирован');
    }

    public function login()
    {
        return view('login.index');
    }

    public function logout()
    {
        Auth::logout();
        if (!Auth::check()) {
            Session::flash('success', "Выход выполнен!");
        }
        return redirect()->route('login');
    }
}
