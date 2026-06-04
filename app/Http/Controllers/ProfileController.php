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
        // Saya ubah ini menjadi profile.edit agar sinkron dengan struktur Bento Grid-mu
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        
        // 1. Tarik semua data yang sudah divalidasi (nama, email, weight, height, goal)
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // 2. Mesin Kalkulator Nutrisi (Aktif JIKA weight & height diisi)
        if ($user->weight && $user->height) {
            
            // Karena form umur & gender belum ada, kita pasang default: Umur 25, Laki-laki
            $age = 25; 
            
            // Rumus BMR Pria
            $bmr = (10 * $user->weight) + (6.25 * $user->height) - (5 * $age) + 5;
            
            // TDEE (Aktivitas ringan)
            $tdee = $bmr * 1.2;

            // Target Kalori berdasarkan Goal
            $targetCalorie = $tdee; 
            $goal = $user->goal ?? 'maintain';

            if ($goal == 'lose') {
                $targetCalorie -= 500; 
            } elseif ($goal == 'gain') {
                $targetCalorie += 500; 
            }

            // Simpan target kalori yang baru dihitung
            $user->daily_calorie_target = round($targetCalorie);
        }

        // 3. Simpan perubahan ke Database
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