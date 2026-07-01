<?php

use App\Http\Controllers\AlatKebersihanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Halaman Publik
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/alat/{id}', [HomeController::class, 'detail'])->name('home.detail');

// Rute ini harus di luar grup middleware 'auth' agar bisa diakses publik
Route::get('/daftar-alat', [HomeController::class, 'alat'])->name('alat');
Route::get('/laporan-kondisi', [HomeController::class, 'kondisi'])->name('kondisi');
Route::get('/kontak', function () {
    return view('home.kontak');
})->name('kontak');

Route::post('/kontak', [HomeController::class, 'kirimKontak'])
    ->name('kontak.kirim');
/*
|--------------------------------------------------------------------------
| Autentikasi
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| Area Admin
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
 
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
 
    Route::get('/alat/export/pdf', [AlatKebersihanController::class, 'exportPdf'])->name('alat.export');
    Route::resource('alat', AlatKebersihanController::class)->except(['show']); 
});