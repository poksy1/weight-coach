<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('user_profiles', function (Blueprint $table) {
        $table->id();
        // Foreign key yang menyambung ke tabel users
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
        
        $table->decimal('weight', 5, 2); // Berat badan (misal: 65.50)
        $table->decimal('target_weight', 5, 2); // Target berat badan
        $table->integer('height'); // Tinggi badan dalam cm
        $table->integer('age'); // Usia
        $table->enum('gender', ['L', 'P']); // Laki-laki atau Perempuan
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
