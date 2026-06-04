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
    Schema::create('meal_plans', function (Blueprint $table) {
        $table->id();
        // INI KOLOM YANG HILANG TADI:
        $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

        $table->string('food_name');
        $table->integer('calories');
        $table->integer('protein')->nullable();
        $table->string('meal_type');
        $table->date('plan_date');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_plans');
    }
};
