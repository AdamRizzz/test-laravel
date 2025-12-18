<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema; // Tambahkan ini untuk cek kolom

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
            // 1. REGENERASI SESI (Wajib untuk keamanan & menghindari error 419)
            $request->session()->regenerate();

            $user = Auth::user();

            // 2. CEK ROLE DENGAN AMAN
            // Logika: Jika kolom role ada DAN isinya admin, ke dashboard.
            // Jika tidak, semuanya ke 'home' (/identitas).
            if (isset($user->role) && $user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('home'); // Ini mengarah ke /identitas
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