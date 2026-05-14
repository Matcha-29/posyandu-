<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'nama',
        'nik',
        'hp',
        'alamat',
        'dusun',
        'kecamatan',
        'kategori',
        'anakKe',
        'tglKunjungan',
        'usiaHamil',
    ];

    protected $casts = [
        'tglKunjungan' => 'date',
        'anakKe' => 'integer',
        'usiaHamil' => 'integer',
    ];
}
