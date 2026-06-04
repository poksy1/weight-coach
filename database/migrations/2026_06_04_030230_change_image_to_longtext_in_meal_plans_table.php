<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('meal_plans', function (Blueprint $table) {
            // Perintah sakti .change() untuk mengubah kapasitas kolom 
            // yang sudah ada tanpa menghapus data di dalamnya
            $table->longText('image')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('meal_plans', function (Blueprint $table) {
            $table->string('image')->nullable()->change();
        });
    }
};