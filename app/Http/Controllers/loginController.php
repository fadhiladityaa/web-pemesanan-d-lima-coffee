<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
class LoginController extends Controller
{
    // use ThrottlesLogins; // Trait not available in Laravel 11 core
    
    // Konfigurasi Rate Limiter manual
    protected $maxAttempts = 3;
    protected $decayMinutes = 1;
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

        // Cek Rate Limiter
        $throttleKey = Str::lower($credentials['noHp']).'|'.$request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, $this->maxAttempts)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            
            throw ValidationException::withMessages([
                'noHp' => ['Terlalu banyak percobaan login. Silakan coba lagi dalam ' . $seconds . ' detik.'],
            ]);
        }

        if(Auth::attempt($credentials)) {
            // Reset percobaan login jika berhasil
            RateLimiter::clear($throttleKey);

            \Illuminate\Support\Facades\Log::info('Login successful for: ' . $credentials['noHp']);
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        // Tambah hitungan gagal
        RateLimiter::hit($throttleKey, $this->decayMinutes * 60);

        \Illuminate\Support\Facades\Log::warning('Login failed for: ' . $credentials['noHp']);
        return back()->with('LoginError', 'Login Tidak Berhasil!');

    }

    public function username()
    {
        return 'noHp';
    }


    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    
}

