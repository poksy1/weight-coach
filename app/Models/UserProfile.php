<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    // Mengizinkan kolom ini diisi data
    protected $fillable = [
        'user_id', 'weight', 'target_weight', 'height', 'age', 'gender'
    ];

    // Relasi kebalikan (Profil ini milik siapa?)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
