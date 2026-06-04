<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
    'name',
    'email',
    'password',
    'weight',               // <--- TAMBAHKAN INI
    'height',               // <--- TAMBAHKAN INI
    'daily_calorie_target', // <--- TAMBAHKAN INI
    'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi One-to-One (Satu User hanya punya 1 Profil Fisik)
    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    // Relasi One-to-Many (Satu User bisa punya banyak Catatan Makanan)
    public function foodLogs()
    {
        return $this->hasMany(FoodLog::class);
    }

    // Relasi Nutritionist -> Banyak Klien
    public function clients()
    {
        return $this->hasMany(\App\Models\Client::class, 'nutritionist_id');
    }
}