<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodLog extends Model
{
    // Mengizinkan kolom ini diisi data
    protected $fillable = [
        'user_id', 'food_name', 'calories', 'protein', 'sugar', 'meal_type', 'consumed_at'
    ];

    // Relasi kebalikan (Makanan ini dimakan oleh siapa?)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}