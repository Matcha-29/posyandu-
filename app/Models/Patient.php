<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    protected $fillable = [
        'nama',
        'nik',
        'noHp',
        'tglLahir',
        'alamat',
        'dusun',
        'kecamatan',
        'kategori',
        'anakKe',
        'tglKunjungan',
        'usiaHamil',
    ];

    protected $casts = [
        'tglLahir'    => 'date',
        'tglKunjungan'=> 'date',
        'anakKe'      => 'integer',
        'usiaHamil'   => 'integer',
    ];

    /** Satu pasien bisa punya banyak pemeriksaan */
    public function pemeriksaans(): HasMany
    {
        return $this->hasMany(Pemeriksaan::class, 'patient_id');
    }

    /** Pemeriksaan terakhir */
    public function pemeriksaanTerakhir()
    {
        return $this->hasOne(Pemeriksaan::class, 'patient_id')->latestOfMany();
    }
}
