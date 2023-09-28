<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

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
            return redirect()->route('frontendDashboard');
        }

        return back()->withErrors([
            'email'=>'The provided credentials do not match our records.'
        ])->onlyInput('email');
    }

    public function registerProcess(Request $request)
    {
        $userData = $request->validate([
            'username'=>['required'],
            'name'=>['required'],
            'email'=>['required','unique:users'],
            'password'=>['required'],
            'confirm-password'=>['required_with:password','same:password']
        ]);

        $usermodel = new User();

        $usermodel->username = $userData['username'];
        $usermodel->name = $userData['name'];
        $usermodel->email = $userData['email'];
        $usermodel->password = Hash::make($userData['password']);

        $usermodel->save();

        return redirect()->route('userLogin');
    }

    public function showProfile(){
        return view('user.userDashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('frontendDashboard');
    }
}
