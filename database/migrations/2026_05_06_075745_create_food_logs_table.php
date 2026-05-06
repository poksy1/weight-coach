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
    Schema::create('food_logs', function (Blueprint $table) {
        $table->id();
        // Foreign key ke tabel users (milik siapa makanan ini)
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
        $table->string('food_name');
        $table->decimal('calories', 8, 2);
        $table->decimal('protein', 8, 2);
        $table->decimal('sugar', 8, 2);
        $table->enum('meal_type', ['breakfast', 'lunch', 'dinner', 'snack']);
        $table->timestamp('consumed_at'); // Waktu makan
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_logs');
    }
};
