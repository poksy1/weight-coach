<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Wajib ditambahkan untuk memanggil API

class FoodController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('keyword'); 
        $foods = []; // Default array kosong

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

            // --- BAGIAN YANG DIPERBAIKI ---
            // Kita tampung dulu semua datanya mentah-mentah
            $apiData = $searchResponse->json();
            
            // Kita ambil isi makanannya dengan cara array bertingkat (lebih aman dari dot notation)
            $result = $apiData['foods']['food'] ?? null;
            
            // Penyesuaian khusus format FatSecret: 
            if ($result && isset($result['food_id'])) {
                $foods = [$result]; // Jika hasilnya cuma 1 makanan
            } else {
                $foods = $result ?? []; // Jika hasilnya banyak makanan
            }
        }

        return view('food-search', compact('foods', 'query'));
    }

        public function store(Request $request)
        {
        // 1. Validasi inputan form
        $request->validate([
            'food_name' => 'required|string',
            'food_description' => 'required|string',
            'meal_type' => 'required|in:breakfast,lunch,dinner,snack',
        ]);

        $description = $request->food_description;

        // 2. Ekstraksi angka dari teks FatSecret menggunakan Regex
        // Mencari angka sebelum tulisan "kcal"
        preg_match('/Calories:\s*([\d.]+)kcal/i', $description, $calMatches);
        $calories = $calMatches[1] ?? 0;

        // Mencari angka sebelum tulisan "g" pada Protein
        preg_match('/Protein:\s*([\d.]+)g/i', $description, $proMatches);
        $protein = $proMatches[1] ?? 0;

        // API gratis tidak selalu menyertakan data gula (sugar), 
        // jadi kita ambil dari data Karbohidrat (Carbs) sebagai pendekatan
        preg_match('/Carbs:\s*([\d.]+)g/i', $description, $carbMatches);
        $sugar = $carbMatches[1] ?? 0;

        // 3. Simpan ke database menggunakan relasi Eloquent
        $request->user()->foodLogs()->create([
            'food_name' => $request->food_name,
            'calories' => $calories,
            'protein' => $protein,
            'sugar' => $sugar,
            'meal_type' => $request->meal_type,
            'consumed_at' => now(), // Waktu pencatatan saat ini
        ]);

        // 4. Kembali ke halaman dashboard setelah berhasil
        return redirect()->route('dashboard');
    }

    public function storeCustom(Request $request)
    {
        // 1. Validasi inputan form
        $request->validate([
            'food_name' => 'required|string|max:255',
            'meal_type' => 'required|in:Breakfast,Lunch,Dinner,Snack',
            'calories'  => 'required|numeric|min:0',
            'protein'   => 'required|numeric|min:0',
            'sugar'     => 'required|numeric|min:0',
        ]);

        // 2. Simpan ke database FoodLog
        $user = auth()->user();
        $user->foodLogs()->create([
            'food_name'   => $request->food_name . ' (Manual)', // Tambahkan tag "(Manual)" agar user tahu
            'meal_type'   => $request->meal_type,
            'calories'    => $request->calories,
            'protein'     => $request->protein,
            'sugar'       => $request->sugar,
            'consumed_at' => \Carbon\Carbon::now(),
        ]);

        // 3. Kembalikan ke halaman dashboard dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Makanan custom berhasil dicatat!');
    }

    public function destroy($id)
        {
        $foodLog = auth()->user()->foodLogs()->findOrFail($id);

        $foodLog->delete();

        return redirect()->back()->with('success', 'Riwayat makanan berhasil dihapus.');
        }
}
