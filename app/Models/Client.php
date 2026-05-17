<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'nutritionist_id',
        'name',
        'slug',
        'program',
        'risk_level',
        'adherence',
        'calorie_target',
        'protein_target',
        'carb_target',
        'fat_target',
        'water_target',
        'water_today',
    ];

    public function nutritionist()
    {
        return $this->belongsTo(User::class, 'nutritionist_id');
    }
}