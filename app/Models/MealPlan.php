<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'food_name',
        'image',
        'calories',
        'protein',
        'meal_type',
        'plan_date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}