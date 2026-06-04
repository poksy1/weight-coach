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
    Schema::table('users', function (Blueprint $table) {
        // Menambahkan kolom float agar bisa pakai koma (misal: 65.5 kg)
        $table->float('weight')->nullable()->after('email');
        $table->float('height')->nullable()->after('weight');
        $table->integer('daily_calorie_target')->nullable()->after('height');
    });
}

    public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['weight', 'height', 'daily_calorie_target']);
    });
}
};
