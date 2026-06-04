<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FoodController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('keyword'); 
        $foods = []; 

        if ($query) {
            $tokenResponse = Http::withoutVerifying()->asForm()->withBasicAuth(
                env('FATSECRET_CLIENT_ID'),
                env('FATSECRET_CLIENT_SECRET')
            )->post('https://oauth.fatsecret.com/connect/token', [
                'grant_type' => 'client_credentials',
                'scope' => 'basic'
            ]);

            $accessToken = $tokenResponse->json('access_token');

            $searchResponse = Http::withoutVerifying()->withToken($accessToken)->get('https://platform.fatsecret.com/rest/server.api', [
                'method' => 'foods.search',
                'search_expression' => $query,
                'format' => 'json',
                'max_results' => 5 
            ]);

            $apiData = $searchResponse->json();
            $result = $apiData['foods']['food'] ?? null;
            
            if ($result && isset($result['food_id'])) {
                $foods = [$result]; 
            } else {
                $foods = $result ?? []; 
            }
        }

        return view('food-search', compact('foods', 'query'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'food_name' => 'required|string',
            'food_description' => 'required|string',
            'meal_type' => 'required|in:breakfast,lunch,dinner,snack',
        ]);

        $description = $request->food_description;

        preg_match('/Calories:\s*([\d.]+)kcal/i', $description, $calMatches);
        $calories = $calMatches[1] ?? 0;

        preg_match('/Protein:\s*([\d.]+)g/i', $description, $proMatches);
        $protein = $proMatches[1] ?? 0;

        preg_match('/Carbs:\s*([\d.]+)g/i', $description, $carbMatches);
        $sugar = $carbMatches[1] ?? 0;

        $request->user()->foodLogs()->create([
            'food_name' => $request->food_name,
            'calories' => $calories,
            'protein' => $protein,
            'sugar' => $sugar,
            'meal_type' => $request->meal_type,
            'consumed_at' => now(), 
        ]);

        return redirect()->route('dashboard');
    }

    // FUNGSI KHUSUS UNTUK PENCATATAN LANGSUNG (DARI DASHBOARD & HASIL PENCARIAN)
    public function storeCustom(Request $request)
    {
        // 1. Validasi input angka langsung (tanpa perlu regex dari deskripsi)
        $request->validate([
            'food_name' => 'required|string',
            'calories'  => 'required|numeric',
            'protein'   => 'required|numeric',
            'meal_type' => 'required|string',
        ]);

        // 2. Filter Bahasa: Terjemahkan otomatis ke ENUM bahasa Inggris
        // Ini mencegah error "Data Truncated" jika form mengirim teks Indonesia
        $tipeMakan = strtolower($request->meal_type);
        $mealTypeMap = [
            'sarapan'     => 'breakfast',
            'makan siang' => 'lunch',
            'makan malam' => 'dinner',
            'cemilan'     => 'snack',
        ];

        // Jika input ada di kamus, pakai bahasa Inggrisnya. Jika tidak, pakai input asli.
        $finalMealType = $mealTypeMap[$tipeMakan] ?? $request->meal_type;

        // 3. Simpan ke tabel food_logs melalui relasi Eloquent
        $request->user()->foodLogs()->create([
            'food_name'   => $request->food_name,
            'calories'    => $request->calories,
            'protein'     => $request->protein,
            'sugar'       => 0, // Set default 0 karena pencatatan cepat
            'meal_type'   => $finalMealType,
            'consumed_at' => now(),
        ]);

        // 4. Kembalikan ke Dashboard setelah sukses
        return redirect()->route('dashboard');
    }

    public function searchFatSecret(Request $request)
    {
        $query = $request->input('keyword'); 
        $foods = []; 

        if ($query) {
            $tokenResponse = Http::withoutVerifying()->asForm()->withBasicAuth(
                env('FATSECRET_CLIENT_ID'),
                env('FATSECRET_CLIENT_SECRET')
            )->post('https://oauth.fatsecret.com/connect/token', [
                'grant_type' => 'client_credentials',
                'scope' => 'basic'
            ]);

            $accessToken = $tokenResponse->json('access_token');

            $searchResponse = Http::withoutVerifying()->withToken($accessToken)->get('https://platform.fatsecret.com/rest/server.api', [
                'method' => 'foods.search',
                'search_expression' => $query,
                'format' => 'json',
                'max_results' => 5 
            ]);

            $apiData = $searchResponse->json();
            $result = $apiData['foods']['food'] ?? null;
            
            if ($result && isset($result['food_id'])) {
                $foods = [$result]; 
            } else {
                $foods = $result ?? []; 
            }
        }

        // Diarahkan ke file blade khusus dashboard
        return view('food.fatsecret-results', compact('foods', 'query'));
    }

    public function destroy($id)
    {
        $foodLog = auth()->user()->foodLogs()->findOrFail($id);
        $foodLog->delete();

        return redirect()->back()->with('success', 'Riwayat makanan berhasil dihapus.');
    }
}