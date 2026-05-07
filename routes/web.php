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

    // 1. Ambil target kalori dinamis milik user (default 2000 jika kosong)
    $targetCalorie = $user->daily_calorie_target ?? 2000;

    // 2. Hitung total kalori dari makanan yang dimakan HARI INI
    $caloriesConsumedToday = $user->foodLogs()
                                  ->whereDate('consumed_at', today())
                                  ->sum('calories');

    // 3. Hitung sisa kalori
    $remainingCalorie = $targetCalorie - $caloriesConsumedToday;

    // 4. Hitung persentase untuk Progress Bar Bootstrap (maksimal 100%)
    $percentage = ($targetCalorie > 0) ? ($caloriesConsumedToday / $targetCalorie) * 100 : 0;
    $progressPercentage = min(100, $percentage); 

    return view('dashboard', compact(
        'targetCalorie', 
        'caloriesConsumedToday', 
        'remainingCalorie', 
        'progressPercentage'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/water/add', function () {

    session([
        'water' => session('water', 0) + 250
    ]);

    return redirect()->back();

})->name('water.add');

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

    // Route baru untuk memproses penyimpanan makanan
    Route::post('/food/log', [FoodController::class, 'store'])->name('food.log');

    // Route untuk menghapus riwayat makanan
    Route::delete('/food/{id}', [FoodController::class, 'destroy'])->name('food.destroy');
});

require __DIR__.'/auth.php';