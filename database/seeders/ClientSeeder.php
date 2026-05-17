<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $nutritionist = User::where('role', 'nutritionist')->first();

        if (!$nutritionist) {
            return;
        }

        Client::updateOrCreate(
            ['slug' => 'putri-amanda'],
            [
                'nutritionist_id' => $nutritionist->id,
                'name' => 'Putri Amanda',
                'program' => 'Manajemen Berat Badan',
                'risk_level' => 'low',
                'adherence' => 92,
                'calorie_target' => 2000,
                'protein_target' => 100,
                'carb_target' => 180,
                'fat_target' => 60,
                'water_target' => 3000,
                'water_today' => 2800,
            ]
        );

        Client::updateOrCreate(
            ['slug' => 'nanda-nabila'],
            [
                'nutritionist_id' => $nutritionist->id,
                'name' => 'Nanda Nabila',
                'program' => 'Nutrisi Olahraga',
                'risk_level' => 'moderate',
                'adherence' => 76,
                'calorie_target' => 2400,
                'protein_target' => 140,
                'carb_target' => 300,
                'fat_target' => 70,
                'water_target' => 3500,
                'water_today' => 3200,
            ]
        );

        Client::updateOrCreate(
            ['slug' => 'deta-amelia'],
            [
                'nutritionist_id' => $nutritionist->id,
                'name' => 'Deta Amelia',
                'program' => 'Pemulihan Pola Makan',
                'risk_level' => 'high',
                'adherence' => 45,
                'calorie_target' => 1850,
                'protein_target' => 90,
                'carb_target' => 190,
                'fat_target' => 55,
                'water_target' => 2500,
                'water_today' => 2100,
            ]
        );
    }
}