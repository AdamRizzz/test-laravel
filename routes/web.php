<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IdentitasController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| 1. ROUTES LOGIN & LOGOUT (Bisa diakses siapa saja)
|--------------------------------------------------------------------------
*/
// Redirect halaman awal ke login
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| 2. HALAMAN KHUSUS ADMIN (Mengelola Identitas)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    
    // Menampilkan Form Identitas
    Route::get('/identitas', [IdentitasController::class, 'index'])->name('home');
    
    // Menyimpan Data Form
    Route::post('/identitas/simpan', [IdentitasController::class, 'store'])->name('simpan');

});


/*
|--------------------------------------------------------------------------
| 3. HALAMAN KHUSUS USER BIASA (Melihat Dashboard)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])->group(function () {
    
    // Kita gunakan URL '/dashboard' agar lebih rapi
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

});