<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Models\UserProfile;
use App\Models\FoodLog;
use Carbon\Carbon;

use App\Http\Controllers\Nutritionist\DashboardController;
use App\Http\Controllers\Nutritionist\ClientController;
use App\Http\Controllers\Nutritionist\MealPlanController;

Route::get('/', function () {
    return view('welcome');
});

// ==========================================
// RUTE PENCARIAN FATSECRET (Diletakkan di luar)
// ==========================================
Route::get('/food/fatsecret-results', [App\Http\Controllers\FoodController::class, 'searchFatSecret'])
    ->middleware(['auth'])
    ->name('fatsecret.search');


// ==========================================
// 1. RUTE DASHBOARD (Fokus Hari Ini Saja)
// ==========================================
Route::get('/dashboard', function () {
    $user = auth()->user();
    
    // --- TAMBAHAN LOGIKA ROLE ---
    if ($user->role === 'nutritionist') {
        return redirect()->route('nutritionist.dashboard');
    }
    // ----------------------------
    
    $targetCalorie = $user->daily_calorie_target ?? 2000;
    
    // Ambil data makanan khusus hari ini
    $dailyFoods = $user->foodLogs()->whereDate('consumed_at', \Carbon\Carbon::today())->get();
    
    // Hitung total kalori, gula, dan sisa kalori hari ini
    $caloriesConsumedToday = $dailyFoods->sum('calories');
    $totalSugar = $dailyFoods->sum('sugar');
    $remainingCalorie = $targetCalorie - $caloriesConsumedToday;
    
    // Hitung persentase untuk animasi Progress Ring (maksimal 100%)
    $percentage = ($targetCalorie > 0) ? ($caloriesConsumedToday / $targetCalorie) * 100 : 0;
    $progressPercentage = min(100, $percentage); 

    // Ambil Rencana Makan Khusus Hari Ini untuk Fitur "Catat Cepat"
    $todayPlans = \App\Models\MealPlan::where('user_id', $user->id)
                    ->whereDate('plan_date', \Carbon\Carbon::today())
                    ->get();
    
    // Kirim SEMUA variabel ke file blade dashboard
    return view('dashboard', compact(
        'targetCalorie', 
        'dailyFoods', 
        'caloriesConsumedToday',
        'remainingCalorie',
        'totalSugar',
        'progressPercentage',
        'todayPlans'
    ));
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
// 4. RUTE MEAL PLANS (Perencana Makan)
// ==========================================

Route::post('/meal-plans/store', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'food_name' => 'required|string',
        'image'     => 'nullable|string',
        'calories'  => 'required|numeric',
        'meal_type' => 'required|string',
        'plan_date' => 'required|date',
    ]);

    // PERBAIKAN: Gunakan updateOrCreate agar data tidak menumpuk.
    // Jika hari ini sudah ada "Sarapan", maka akan ditimpa (di-update), bukan ditambah ganda.
    \App\Models\MealPlan::updateOrCreate(
        [
            'user_id'   => auth()->id(),
            'plan_date' => $request->plan_date,
            'meal_type' => $request->meal_type, // Kunci pencarian: User + Tanggal + Waktu Makan
        ],
        [
            'food_name' => $request->food_name, // Data yang akan di-update/ditulis
            'image'     => $request->image,
            'calories'  => $request->calories,
            'protein'   => $request->protein ?? 0,
        ]
    );

    return redirect()->route('meal-plans', ['date' => $request->plan_date])
                     ->with('success', 'Rencana makan berhasil dijadwalkan!');
})->middleware(['auth', 'verified'])->name('user.meal-plans.store');

// RUTE BARU: Untuk menghapus permanen rencana makan dari database
Route::delete('/meal-plans/{id}', function ($id) {
    $mealPlan = \App\Models\MealPlan::where('id', $id)->where('user_id', auth()->id())->first();
    if ($mealPlan) {
        $mealPlan->delete();
    }
    return redirect()->back()->with('success', 'Menu berhasil dihapus dari rencana!');
})->middleware(['auth', 'verified'])->name('user.meal-plans.destroy');

Route::get('/meal-plans', function () {
    $user = auth()->user();
    $selectedDate = request('date') ? \Carbon\Carbon::parse(request('date')) : \Carbon\Carbon::today();
    
    $startOfWeek = $selectedDate->copy()->startOfWeek(); 
    // PERBAIKAN: Hitung juga akhir minggunya (Hari Minggu)
    $endOfWeek = $startOfWeek->copy()->addDays(6);
    
    $weekDates = [];
    for ($i = 0; $i < 7; $i++) {
        $weekDates[] = $startOfWeek->copy()->addDays($i);
    }

    $prevWeek = $startOfWeek->copy()->subWeek()->format('Y-m-d');
    $nextWeek = $startOfWeek->copy()->addWeek()->format('Y-m-d');

    // PERBAIKAN: Tarik data SELAMA SATU MINGGU PENUH (Senin - Minggu)
    $plannedFoods = \App\Models\MealPlan::where('user_id', $user->id)
                        ->whereBetween('plan_date', [$startOfWeek->format('Y-m-d'), $endOfWeek->format('Y-m-d')])
                        ->get();

    return view('meal-plans', compact('weekDates', 'prevWeek', 'nextWeek', 'selectedDate', 'startOfWeek', 'plannedFoods'));
})->middleware(['auth', 'verified'])->name('meal-plans');

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

Route::middleware(['auth', 'nutritionist'])->group(function () {

    // Dashboard ahli gizi
    Route::get('/nutritionist/dashboard', [DashboardController::class, 'index'])
        ->name('nutritionist.dashboard');

    // Halaman detail klien (DINAMIS)
    Route::get('/nutritionist/clients/{client:slug}', [ClientController::class, 'show'])
        ->name('nutritionist.clients.show');

    // Meal plan per klien (DINAMIS)
    Route::get('/nutritionist/clients/{client:slug}/meal-plans', [MealPlanController::class, 'show'])
    ->name('nutritionist.clients.meal-plans');

    Route::get('/nutritionist/meal-plans', [MealPlanController::class, 'index'])
    ->name('nutritionist.meal-plans');
    // SIMPAN meal plan
    Route::post('/nutritionist/clients/{client:slug}/meal-plans', [MealPlanController::class, 'store'])
    ->name('nutritionist.clients.meal-plans.store');

    Route::delete('/nutritionist/clients/{client:slug}/meal-plans/{mealPlan}', [MealPlanController::class, 'destroy'])
    ->name('nutritionist.clients.meal-plans.destroy');

    Route::put('/nutritionist/clients/{client:slug}/meal-plans/{mealPlan}', [MealPlanController::class, 'update'])
    ->name('nutritionist.clients.meal-plans.update');

    Route::post('/nutritionist/clients/{client:slug}/meal-plans/share', [MealPlanController::class, 'share'])
    ->name('nutritionist.clients.meal-plans.share');

    Route::post(
    '/nutritionist/clients/{client:slug}/meal-plans/duplicate',
    [MealPlanController::class, 'duplicate']
    )->name('nutritionist.clients.meal-plans.duplicate');

    Route::get(
    '/nutritionist/clients/{client:slug}/meal-plans/export-pdf',
    [MealPlanController::class, 'exportPdf']
    )->name('nutritionist.clients.meal-plans.export-pdf');
    // Halaman lain
    Route::get('/nutritionist/water', function () {
        return view('nutritionist.water');
    })->name('nutritionist.water');

    Route::get('/nutritionist/progress', function () {
        return view('nutritionist.progress');
    })->name('nutritionist.progress');

    Route::get('/nutritionist/settings', function () {
        return view('nutritionist.settings');
    })->name('nutritionist.settings');

    // Redirect sementara meal plans utama
    Route::get('/nutritionist/meal-plans', [MealPlanController::class, 'index'])
    ->name('nutritionist.meal-plans');
    
});

require __DIR__.'/auth.php';