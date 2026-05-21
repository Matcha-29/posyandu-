<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'photo',
        'password',
        'role',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'is_active'         => 'boolean',
    ];

    /** Cek apakah user adalah admin */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /** Pemeriksaan yang dilakukan petugas ini */
    public function pemeriksaans(): HasMany
    {
        return $this->hasMany(Pemeriksaan::class, 'petugas_id');
    }
}
