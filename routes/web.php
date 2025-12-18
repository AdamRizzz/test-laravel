<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IdentitasController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| 1. ROUTES LOGIN & LOGOUT
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| 2. ROUTES IDENTITAS (User Biasa)
|--------------------------------------------------------------------------
*/
// Menampilkan Form
Route::get('/identitas', [IdentitasController::class, 'index'])
    ->name('home') 
    ->middleware('auth');

// --- BAGIAN INI YANG HILANG (Penyebab Error) ---
// Menyimpan Data dari Form
Route::post('/identitas/simpan', [IdentitasController::class, 'store'])
    ->name('simpan') // <--- Nama ini yang dicari oleh form Anda
    ->middleware('auth');
// -----------------------------------------------

/*
|--------------------------------------------------------------------------
| 3. ROUTES DASHBOARD (Admin)
|--------------------------------------------------------------------------
*/
Route::get('/admin/dashboard', [AdminController::class, 'index'])
    ->name('admin.dashboard')
    ->middleware('auth');

    // ... kode route login tetap sama ...

/*
|--------------------------------------------------------------------------
| HALAMAN IDENTITAS (KHUSUS ADMIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    
    Route::get('/identitas', [IdentitasController::class, 'index'])->name('home');
    Route::post('/identitas/simpan', [IdentitasController::class, 'store'])->name('simpan');

});


/*
|--------------------------------------------------------------------------
| HALAMAN DASHBOARD (KHUSUS USER BIASA)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])->group(function () {
    
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

});