<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Wajib ditambahkan untuk memanggil API

class FoodController extends Controller
{
    public function search(Request $request)
    {
        // Menangkap teks yang diketik user dari form pencarian (misal: "Ayam Bakar")
        $query = $request->input('keyword'); 
        $foods = []; // Default array kosong jika belum ada pencarian

        // Jika user sudah mengetik sesuatu dan menekan tombol cari
        if ($query) {
            $tokenResponse = Http::withoutVerifying()->asForm()->withBasicAuth(
                env('FATSECRET_CLIENT_ID'),
                env('FATSECRET_CLIENT_SECRET')
            )->post('https://oauth.fatsecret.com/connect/token', [
                'grant_type' => 'client_credentials',
                'scope' => 'basic'
            ]);

            $accessToken = $tokenResponse->json('access_token');

            $searchResponse = Http::withToken($accessToken)->get('https://platform.fatsecret.com/rest/server.api', [
                'method' => 'foods.search',
                'search_expression' => $query,
                'format' => 'json',
                'max_results' => 5 // Kita ambil 5 data teratas
            ]);

            // Mengambil isi data makanan
            $result = $searchResponse->json('foods.food');
            
            // Penyesuaian khusus format FatSecret: 
            // Jika hasil pencarian cuma 1 item, ubah formatnya agar tidak error saat dilooping (foreach)
            if ($result && isset($result['food_id'])) {
                $foods = [$result];
            } else {
                $foods = $result ?? [];
            }
        }

        // Lempar data hasil pencarian dan keywordnya ke file Blade
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

    public function destroy($id)
        {
        $foodLog = auth()->user()->foodLogs()->findOrFail($id);

        $foodLog->delete();

        return redirect()->back()->with('success', 'Riwayat makanan berhasil dihapus.');
        }
}