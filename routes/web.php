<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// INI BAGIAN YANG KITA UBAH (Logika Dashboard)
Route::get('/dashboard', function () {
    // Mencari data profil milik user yang sedang login
    $profile = auth()->user()->profile;

    // JIKA profil belum ada, arahkan ke halaman setup
    if (!$profile) {
        return redirect()->route('profile.setup');
    }

    // JIKA sudah ada, tampilkan dashboard dengan membawa data profil
    return view('dashboard', compact('profile'));
})->middleware(['auth', 'verified'])->name('dashboard');


// Rute bawaan Laravel Breeze untuk pengaturan akun
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute buatan kita sendiri untuk aplikasi Weight Coach
Route::middleware('auth')->group(function () {
    // Jalur untuk menampilkan form HTML
    Route::get('/setup-profile', [UserProfileController::class, 'create'])->name('profile.setup');
    
    // Jalur untuk mengirim/menyimpan data dari form
    Route::post('/setup-profile', [UserProfileController::class, 'store'])->name('profile.store');
});

require __DIR__.'/auth.php';