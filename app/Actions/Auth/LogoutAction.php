<?php

namespace App\Actions\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutAction
{
    public function __invoke(Request $request)
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
