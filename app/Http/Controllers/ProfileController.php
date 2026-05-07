<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // 1. Update data dasar bawaan Breeze (nama, email)
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // 2. Validasi inputan form kesehatan yang baru kita buat
        $request->validate([
            'weight' => 'required|numeric|min:30',
            'height' => 'required|numeric|min:100',
            'age'    => 'required|integer|min:10',
            'gender' => 'required|in:male,female',
            'goal'   => 'required|in:lose,maintain,gain',
        ]);

        // 3. Masukkan Algoritma "Mesin" Nutrisi di sini
        $weight = $request->weight;
        $height = $request->height;
        $age = $request->age;
        $gender = $request->gender;
        $goal = $request->goal;

        // Hitung BMR
        if ($gender == 'male') {
            $bmr = (10 * $weight) + (6.25 * $height) - (5 * $age) + 5;
        } else {
            $bmr = (10 * $weight) + (6.25 * $height) - (5 * $age) - 161;
        }

        // Hitung TDEE (Asumsi aktivitas ringan x 1.2)
        $tdee = $bmr * 1.2;

        // Tentukan Target Kalori
        $targetCalorie = $tdee; 
        if ($goal == 'lose') {
            $targetCalorie -= 500; 
        } elseif ($goal == 'gain') {
            $targetCalorie += 500; 
        }

        // 4. Masukkan hasil perhitungan ke dalam variabel user sebelum disimpan
        $user = $request->user();
        $user->weight = $weight;
        $user->height = $height;
        $user->age = $age;
        $user->gender = $gender;
        $user->goal = $goal;
        $user->daily_calorie_target = round($targetCalorie);

        // 5. Simpan semua perubahan ke Database
        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
