<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
class LoginController extends Controller
{
    public function index() 
    {
        return view('auth.login', [
            'title' => 'Login',
        ]);
    }

    public function authenticate(Request $request) 
    {
        $credentials = $request->validate([
            'noHp' => ['required', 'string', 'min:5', 'max:15'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('LoginError', 'Login Tidak Berhasil!');

    }


    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    
}

