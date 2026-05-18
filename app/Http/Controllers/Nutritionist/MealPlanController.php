<?php

namespace App\Http\Controllers\Nutritionist;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class MealPlanController extends Controller
{
    public function show(Client $client)
    {
        if ($client->nutritionist_id !== auth()->id()) {
            abort(403);
        }

        $mealPlans = $client->mealPlans()->get();

        return view('nutritionist.meal-plans.show', compact('client', 'mealPlans'));
    }

    public function store(Request $request, Client $client)
    {
        if ($client->nutritionist_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'day' => 'required|string',
            'meal_type' => 'required|string',
            'meal_name' => 'required|string|max:255',
            'calories' => 'required|integer|min:0',
        ]);

        $client->mealPlans()->create([
            'day' => $request->day,
            'meal_type' => $request->meal_type,
            'meal_name' => $request->meal_name,
            'calories' => $request->calories,
        ]);

        return redirect()->back()->with('success', 'Makanan berhasil ditambahkan.');
    }

    public function destroy(Client $client, \App\Models\MealPlan $mealPlan)
{
    if ($client->nutritionist_id !== auth()->id()) {
        abort(403);
    }

    if ($mealPlan->client_id !== $client->id) {
        abort(403);
    }

    $mealPlan->delete();

    return redirect()->back()->with('success', 'Makanan berhasil dihapus.');
}

    public function update(Request $request, Client $client, \App\Models\MealPlan $mealPlan)
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

    return redirect()->back()->with('success', 'Meal plan berhasil diperbarui.');
}
    public function share(Client $client)
{
    if ($client->nutritionist_id !== auth()->id()) {
        abort(403);
    }

    if ($client->mealPlans()->count() === 0) {
        return redirect()->back()->with('error', 'Tambahkan makanan terlebih dahulu sebelum membagikan rencana makan.');
    }

    $client->update([
        'meal_plan_status' => 'shared',
        'meal_plan_shared_at' => now(),
    ]);

    return redirect()->back()->with('success', 'Rencana makan berhasil diselesaikan dan dibagikan.');
}
}