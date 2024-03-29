<?php

namespace App\Http\Controllers;

use App\Actions\Auth\LoginAction;
use App\Actions\Auth\LogoutAction;
use App\Http\Requests\Login\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        return view('login.index');
    }

    public function auth(LoginRequest $request, LoginAction $loginAction): \Illuminate\Http\RedirectResponse
    {
        return $loginAction($request);
    }

    public function logout(Request $request, LogoutAction $logoutAction)
    {
        return $logoutAction($request);
    }
}
