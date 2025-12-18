<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IdentitasController;
use App\Http\Controllers\AdminController;

// 1. Redirect halaman awal ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// 2. Route untuk Login & Logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 3. Route Tujuan (Pastikan URL ini sesuai dengan error 404 yang Anda lihat)

// Kalau 404-nya di: /identitas
Route::get('/identitas', [IdentitasController::class, 'index'])
    ->name('home')
    ->middleware('auth');

// Kalau 404-nya di: /admin/dashboard
Route::get('/admin/dashboard', [AdminController::class, 'index'])
    ->name('admin.dashboard')
    ->middleware('auth');