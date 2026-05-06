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

    if (!$profile) {
        return redirect()->route('profile.setup');
    }

    // 1. Ambil semua catatan makanan HARI INI
    $todayLogs = $user->foodLogs()->whereDate('consumed_at', Carbon::today())->get();

    // 2. Hitung total masing-masing nutrisi
    $totalCaloriesToday = $todayLogs->sum('calories');
    $totalProteinToday = $todayLogs->sum('protein');
    $totalCarbsToday = $todayLogs->sum('sugar'); // Kita pakai kolom sugar sebagai pendekatan Carbs harian
    
    // Karena tabel food_logs kita belum punya kolom fat, kita buat estimasi logis 
    // dari kalori tersisa agar progress bar tidak kosong saat demo, atau set ke 0 dulu
    $totalFatToday = $todayLogs->count() > 0 ? ($totalCaloriesToday * 0.03) : 0; 

    // 3. Tentukan Target berdasarkan standar gambar contohmu
    $targetCalories = 2000;
    $targetProtein = 1500; // Sesuai gambar: 150g (kita simpan dalam angka biasa/skala disesuaikan)
    $targetCarbs = 200;    // Sesuai gambar: 200g
    $targetFat = 70;       // Sesuai gambar: 70g

    // 4. Hitung Persentase untuk panjang Progress Bar (Maksimal 100%)
    $proteinPercent = $targetProtein > 0 ? min(($totalProteinToday / 150) * 100, 100) : 0;
    $carbsPercent = $targetCarbs > 0 ? min(($totalCarbsToday / 200) * 100, 100) : 0;
    $fatPercent = $targetFat > 0 ? min(($totalFatToday / 70) * 100, 100) : 0;

    return view('dashboard', compact(
        'profile', 
        'totalCaloriesToday', 'targetCalories',
        'totalProteinToday', 'proteinPercent',
        'totalCarbsToday', 'carbsPercent',
        'totalFatToday', 'fatPercent'
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