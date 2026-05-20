<?php

namespace App\Http\Controllers\Nutritionist;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\MealPlan;
use Illuminate\Http\Request;

class MealPlanController extends Controller
{
    public function show(Client $client)
    {
        if ($client->nutritionist_id !== auth()->id()) {
            abort(403);
        }

        $mealPlans = $client->mealPlans()->get();

        $totalCalories = $mealPlans->sum('calories');

        $totalProtein = round(($totalCalories * 0.30) / 4);
        $totalCarbs = round(($totalCalories * 0.45) / 4);
        $totalFat = round(($totalCalories * 0.25) / 9);

        $proteinRemaining = max(0, $client->protein_target - $totalProtein);
        $carbRemaining = max(0, $client->carb_target - $totalCarbs);
        $fatRemaining = max(0, $client->fat_target - $totalFat);

        $proteinReached = $proteinRemaining <= 0;
        $fatReached = $fatRemaining <= 0;
        $calorieReached = $totalCalories >= $client->calorie_target;

        return view('nutritionist.meal-plans.show', compact(
            'client',
            'mealPlans',
            'totalCalories',
            'totalProtein',
            'totalCarbs',
            'totalFat',
            'proteinRemaining',
            'carbRemaining',
            'fatRemaining',
            'proteinReached',
            'fatReached',
            'calorieReached'
        ));
    }

    public function store(Request $request, Client $client)
    {
        if ($client->nutritionist_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'day' => 'required|string',
            'meal_type' => 'required|string',
            'meal_name' => 'required|string|max:255',
            'calories' => 'required|integer|min:0',
        ]);

        $client->mealPlans()->create($validated);

        return redirect()
            ->back()
            ->with('success', 'Makanan berhasil ditambahkan.');
    }

    public function update(Request $request, Client $client, MealPlan $mealPlan)
    {
        if ($client->nutritionist_id !== auth()->id()) {
            abort(403);
        }

        if ($mealPlan->client_id !== $client->id) {
            abort(403);
        }

        $validated = $request->validate([
            'meal_name' => 'required|string|max:255',
            'calories' => 'required|integer|min:1',
        ]);

        $mealPlan->update($validated);

        return redirect()
            ->back()
            ->with('success', 'Makanan berhasil diperbarui.');
    }

    public function destroy(Client $client, MealPlan $mealPlan)
    {
        if ($client->nutritionist_id !== auth()->id()) {
            abort(403);
        }

        if ($mealPlan->client_id !== $client->id) {
            abort(403);
        }

        $mealPlan->delete();

        return redirect()
            ->back()
            ->with('success', 'Makanan berhasil dihapus.');
    }

    public function share(Client $client)
    {
        if ($client->nutritionist_id !== auth()->id()) {
            abort(403);
        }

        if ($client->mealPlans()->count() === 0) {
            return redirect()
                ->back()
                ->with('error', 'Tambahkan makanan terlebih dahulu sebelum membagikan rencana makan.');
        }

        $client->update([
            'meal_plan_status' => 'shared',
            'meal_plan_shared_at' => now(),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Rencana makan berhasil diselesaikan dan dibagikan.');
    }

    public function exportPdf(Client $client)
    {
        if ($client->nutritionist_id !== auth()->id()) {
            abort(403);
        }

        $mealPlans = $client->mealPlans()->get();

        $totalCalories = $mealPlans->sum('calories');

        return view('nutritionist.meal-plans.pdf', compact(
            'client',
            'mealPlans',
            'totalCalories'
        ));
    }
    public function duplicate(Request $request, Client $client)
{
    if ($client->nutritionist_id !== auth()->id()) {
        abort(403);
    }

    $request->validate([
        'source_day' => 'required|string',
    ]);

    $sourceDay = $request->source_day;

    $sourceMeals = $client->mealPlans()
        ->where('day', $sourceDay)
        ->get();

    if ($sourceMeals->isEmpty()) {
        return back()->with(
            'error',
            'Belum ada menu pada hari ' . $sourceDay
        );
    }

    $allDays = [
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
        'Minggu'
    ];

    $targetDays = array_filter($allDays, function ($day) use ($sourceDay) {
        return $day !== $sourceDay;
    });

    foreach ($targetDays as $day)
    {
        $client->mealPlans()
            ->where('day', $day)
            ->delete();

        foreach ($sourceMeals as $meal)
        {
            $client->mealPlans()->create([
                'day' => $day,
                'meal_type' => $meal->meal_type,
                'meal_name' => $meal->meal_name,
                'calories' => $meal->calories,
            ]);
        }
    }

    return back()->with(
        'success',
        'Menu hari ' . $sourceDay . ' berhasil diduplikasi.'
    );
}
    public function index()
    {
    $clients = Client::where('nutritionist_id', auth()->id())->get();

    return view('nutritionist.meal-plans.index', compact('clients'));
    }
}