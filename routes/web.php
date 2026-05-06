<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Models\UserProfile;
use App\Models\FoodLog;
use Carbon\Carbon;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    $profile = $user->profile;

    // JIKA profil belum ada, paksa mengisi dulu
    if (!$profile) {
        return redirect()->route('profile.setup');
    }

    // Hitung total kalori yang dikonsumsi HARI INI saja
    $totalCaloriesToday = $user->foodLogs()
        ->whereDate('consumed_at', Carbon::today())
        ->sum('calories');

    // Rumus BMR Sederhana untuk target harian (Bisa dikembangkan nanti)
    // Di sini kita asumsikan target kalori harian standar adalah 2000 kkal
    $targetCalories = 2000; 

    // Lempar semua variabel ke view dashboard
    return view('dashboard', compact('profile', 'totalCaloriesToday', 'targetCalories'));
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
// Rute untuk mencari makanan (menggunakan metode GET agar keyword masuk di URL)
Route::middleware('auth')->group(function () {
    Route::get('/food/search', [FoodController::class, 'search'])->name('food.search');
});

Route::middleware('auth')->group(function () {
    Route::get('/food/search', [FoodController::class, 'search'])->name('food.search');
    
    // Rute baru untuk memproses form penyimpanan makanan
    Route::post('/food/log', [FoodController::class, 'store'])->name('food.log');
});

require __DIR__.'/auth.php';