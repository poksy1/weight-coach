<?php

namespace App\Http\Controllers\Nutritionist;

use App\Http\Controllers\Controller;
use App\Models\Client;

class MealPlanController extends Controller
{
    public function show(Client $client)
    {
        if ($client->nutritionist_id !== auth()->id()) {
            abort(403);
        }

        return view('nutritionist.meal-plans.show', compact('client'));
    }
}