<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pemeriksaan extends Model
{
    protected $fillable = [
        'patient_id',
        'tgl_periksa',
        'usia_hamil',
        'berat_badan',
        'tinggi_badan',
        'lila',
        'tekanan_darah',
        'hb',
        'lingkar_kepala',
        'usia_balita',
        'imunisasi',
        'jawaban_skrining',
        'level_risiko',
        'skor_ya',
        'tindak_lanjut',
        'petugas_id',
        'catatan',
    ];

    protected $casts = [
        'tgl_periksa'     => 'date',
        'berat_badan'     => 'decimal:2',
        'tinggi_badan'    => 'decimal:2',
        'lila'            => 'decimal:2',
        'hb'              => 'decimal:2',
        'lingkar_kepala'  => 'decimal:2',
        'jawaban_skrining'=> 'array',
        'tindak_lanjut'   => 'array',
        'skor_ya'         => 'integer',
        'usia_hamil'      => 'integer',
        'usia_balita'     => 'integer',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function petugas(): BelongsTo
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}
