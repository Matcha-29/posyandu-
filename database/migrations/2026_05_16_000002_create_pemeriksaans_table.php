<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * D2 – Data Pemeriksaan
 * Menyimpan hasil pemeriksaan per kunjungan pasien (langkah 2–4)
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemeriksaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')
                  ->constrained('patients')
                  ->onDelete('cascade');
            $table->date('tgl_periksa');

            // ── Pengukuran (langkah 2) ──────────────────────────────
            // Ibu Hamil
            $table->integer('usia_hamil')->nullable();        // minggu
            $table->decimal('berat_badan', 5, 2)->nullable(); // kg
            $table->decimal('tinggi_badan', 5, 2)->nullable();// cm
            $table->decimal('lila', 5, 2)->nullable();        // cm
            $table->string('tekanan_darah', 20)->nullable();  // cth: 120/80
            $table->decimal('hb', 4, 2)->nullable();          // g/dL

            // Balita
            $table->decimal('lingkar_kepala', 5, 2)->nullable(); // cm
            $table->integer('usia_balita')->nullable();           // bulan
            $table->string('imunisasi', 20)->nullable();

            // ── Kuesioner Skrining (langkah 3) ─────────────────────
            // Disimpan sebagai JSON array jawaban {q1:"ya", q2:"tidak", ...}
            $table->json('jawaban_skrining')->nullable();

            // ── Hasil (langkah 4) ───────────────────────────────────
            $table->string('level_risiko', 20)->nullable(); // rendah | sedang | tinggi | darurat
            $table->integer('skor_ya')->nullable();
            $table->json('tindak_lanjut')->nullable();       // array rekomendasi

            // Metadata
            $table->foreignId('petugas_id')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null');
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemeriksaans');
    }
};
