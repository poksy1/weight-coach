<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function create()
    {
        return view('setup-profile');
    }

    public function store(Request $request)
    {
        // 1. Validasi Data (Memastikan user tidak mengisi huruf di kolom angka)
        $request->validate([
            'weight' => 'required|numeric',
            'target_weight' => 'required|numeric',
            'height' => 'required|integer',
            'age' => 'required|integer',
            'gender' => 'required|in:L,P',
        ]);

        // 2. Simpan ke Database menggunakan Relasi Eloquent
        // "Auth::user()->profile()->create" artinya kita menyimpan data profil 
        // khusus untuk user yang sedang login saat ini.
        $request->user()->profile()->create([
            'weight' => $request->weight,
            'target_weight' => $request->target_weight,
            'height' => $request->height,
            'age' => $request->age,
            'gender' => $request->gender,
        ]);

        // 3. Arahkan user kembali ke halaman Dashboard setelah sukses
        return redirect()->route('dashboard');
    }
}