<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLogin()
    {
        return view('login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // --- LOGIKA PENGALIHAN (REDIRECT) ---
            
            if ($user->role === 'admin') {
                // Admin ke Identitas
                return redirect()->route('home'); 
            } else {
                // User ke Dashboard (Sesuai nama baru di web.php)
                return redirect()->route('dashboard'); 
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah!']);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}