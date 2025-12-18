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

            // --- LOGIKA TERBALIK SESUAI PERMINTAAN ---
            
            if ($user->role === 'admin') {
                // Jika Admin -> Masuk ke IDENTITAS ('home')
                return redirect()->route('home'); 
            } else {
                // Jika User Biasa -> Masuk ke DASHBOARD ('admin.dashboard')
                return redirect()->route('admin.dashboard');
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