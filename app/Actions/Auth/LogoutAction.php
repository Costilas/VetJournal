<?php

namespace App\Actions\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutAction
{
    public function __invoke(Request $request): \Illuminate\Http\RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $logoutMessage = __('auth.notifications.logout.success');

        if (!Auth::check()) {
            Session::flash('success', $logoutMessage);
        }

        return redirect()->route('login')->with('success', $logoutMessage);
    }
}
