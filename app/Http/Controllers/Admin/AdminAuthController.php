<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function loginProcess(Request $request)
    {
        $credintials = $request->validate([
            'email'=>['required','email'],
            'password'=>['required']
        ]);

        if(Auth::guard('admin')->attempt($credintials)){
            return redirect()->route('adminDashboard');
        }

        return back()->withErrors([
            'email'=>'The provided credentials do not match our records.'
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('adminLogin');
    }
}
