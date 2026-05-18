<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealPlan extends Model
{
    protected $fillable = [
        'client_id',
        'day',
        'meal_type',
        'meal_name',
        'calories',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}