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

// ==========================================
// 1. RUTE DASHBOARD (Fokus Hari Ini Saja)
// ==========================================
Route::get('/dashboard', function () {
    $user = auth()->user();
    $targetCalorie = $user->daily_calorie_target ?? 2000;
    
    // Ambil makanan khusus hari ini
    $dailyFoods = $user->foodLogs()->whereDate('consumed_at', Carbon::today())->get();
    $caloriesConsumedToday = $dailyFoods->sum('calories');

    return view('dashboard', compact('targetCalorie', 'dailyFoods', 'caloriesConsumedToday'));
})->middleware(['auth', 'verified'])->name('dashboard');

// ==========================================
// 2. RUTE RIWAYAT (Mesin Waktu & Tabel)
// ==========================================
Route::get('/history', function () {
    $user = auth()->user();
    
    // Tangkap tanggal dari URL, jika kosong gunakan hari ini
    $selectedDate = request('date') ? Carbon::parse(request('date')) : Carbon::today();
    
    // Variabel navigasi
    $prevDate = $selectedDate->copy()->subDay()->format('Y-m-d');
    $nextDate = $selectedDate->copy()->addDay()->format('Y-m-d');
    $isToday = $selectedDate->isToday();
    
    // Format tanggal
    Carbon::setLocale('id');
    $displayDate = $selectedDate->translatedFormat('l, d F Y');
    
    $dailyFoods = $user->foodLogs()->whereDate('consumed_at', $selectedDate)->get();

    return view('history', compact('selectedDate', 'prevDate', 'nextDate', 'isToday', 'displayDate', 'dailyFoods'));
})->middleware(['auth', 'verified'])->name('history');

// ==========================================
// 3. RUTE ANALITIK (BMI & Grafik Chart.js)
// ==========================================
Route::get('/analytics', function () {
    $user = auth()->user();
    $targetCalorie = $user->daily_calorie_target ?? 2000;

    // --- FITUR BMI DINAMIS ---
    $weight = $user->weight;
    $height = $user->height;
    $bmi = 0; $bmiCategory = 'Belum Ada Data'; $bmiColor = 'bg-gray-200 text-gray-800';

    if ($weight && $height) {
        $heightInMeter = $height / 100;
        $bmi = round($weight / ($heightInMeter * $heightInMeter), 1);

        if ($bmi < 18.5) { 
            $bmiCategory = 'Kurus'; $bmiColor = 'bg-blue-100 text-blue-800'; 
        } elseif ($bmi >= 18.5 && $bmi <= 24.9) { 
            $bmiCategory = 'Normal (Ideal)'; $bmiColor = 'bg-green-100 text-green-800'; 
        } elseif ($bmi >= 25 && $bmi <= 29.9) { 
            $bmiCategory = 'Overweight'; $bmiColor = 'bg-yellow-100 text-yellow-800'; 
        } else { 
            $bmiCategory = 'Obesitas'; $bmiColor = 'bg-red-100 text-red-800'; 
        }
    }

    // --- FITUR GRAFIK RAPOR MINGGUAN ---
    $chartLabels = []; $chartData = [];
    for ($i = 6; $i >= 0; $i--) {
        $date = Carbon::today()->subDays($i);
        $chartLabels[] = $date->translatedFormat('d M');
        $chartData[] = $user->foodLogs()->whereDate('consumed_at', $date)->sum('calories');
    }

    return view('analytics', compact('bmi', 'bmiCategory', 'bmiColor', 'chartLabels', 'chartData', 'targetCalorie'));
})->middleware(['auth', 'verified'])->name('analytics');


// ==========================================
// RUTE LAINNYA (Tetap sama seperti aslinya)
// ==========================================
Route::post('/water/add', function () {
    session([
        'water' => session('water', 0) + 250
    ]);
    return redirect()->back();
})->name('water.add');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/setup-profile', [UserProfileController::class, 'create'])->name('profile.setup');
    Route::post('/setup-profile', [UserProfileController::class, 'store'])->name('profile.store');
});

Route::middleware('auth')->group(function () {
    // Rute bawaan dari API
    Route::get('/food/search', [FoodController::class, 'search'])->name('food.search');
    Route::post('/food/log', [FoodController::class, 'store'])->name('food.log');
    Route::delete('/food/{id}', [FoodController::class, 'destroy'])->name('food.destroy');
    
    // RUTE BARU: Untuk input makanan manual (Langkah 1)
    Route::post('/food/custom', [FoodController::class, 'storeCustom'])->name('food.custom');
});

require __DIR__.'/auth.php';

require __DIR__.'/auth.php';