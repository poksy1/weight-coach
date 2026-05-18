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
    Schema::table('clients', function (Blueprint $table) {
        $table->string('meal_plan_status')->default('draft');
        $table->timestamp('meal_plan_shared_at')->nullable();
    });
}

public function down(): void
{
    Schema::table('clients', function (Blueprint $table) {
        $table->dropColumn(['meal_plan_status', 'meal_plan_shared_at']);
    });
}
};
