<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthControllers extends Controller
{
    public function showLoginForm()
    {
        return view('user.auth.login');
    }

    public function loginProcess(Request $request)
    {
        $credintials = $request->validate([
            'email'=>['required','email'],
            'password'=>['required']
        ]);

        if(Auth::attempt($credintials)){
            return redirect()->route('userDashboard');
        }

        return back()->withErrors([
            'email'=>'The provided credentials do not match our records.'
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('userDashboard');
    }
}
