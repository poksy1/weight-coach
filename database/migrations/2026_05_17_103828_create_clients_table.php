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
    Schema::create('clients', function (Blueprint $table) {
        $table->id();

        $table->foreignId('nutritionist_id')
              ->constrained('users')
              ->cascadeOnDelete();

        $table->string('name');
        $table->string('slug')->unique();

        $table->string('program');
        $table->string('risk_level')->default('low');
        $table->integer('adherence')->default(0);

        $table->integer('calorie_target')->default(2000);
        $table->integer('protein_target')->default(100);
        $table->integer('carb_target')->default(200);
        $table->integer('fat_target')->default(60);

        $table->integer('water_target')->default(3000);
        $table->integer('water_today')->default(0);

        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::dropIfExists('clients');
}
};
