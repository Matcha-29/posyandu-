<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\Pemeriksaan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /* ── D3: Akun ─────────────────────────────────────── */
        $admin = User::firstOrCreate(
            ['email' => 'admin@posyandu.id'],
            [
                'name'      => 'Administrator',
                'password'  => Hash::make('admin123'),
                'role'      => 'admin',
                'is_active' => true,
            ]
        );

        $petugas = User::firstOrCreate(
            ['email' => 'petugas@posyandu.id'],
            [
                'name'      => 'Bidan Sari',
                'password'  => Hash::make('petugas123'),
                'role'      => 'petugas',
                'is_active' => true,
            ]
        );

        /* ── D1: Pasien ────────────────────────────────────── */
        $patients = [
            [
                'nama' => 'Siti Aminah', 'nik' => '3508010101980001',
                'noHp' => '081234567890', 'tglLahir' => '1998-01-01',
                'alamat' => 'Jl. Mawar No. 12', 'dusun' => 'Krajan',
                'kecamatan' => 'Sumbersari', 'kategori' => 'ibu',
                'anakKe' => 1, 'tglKunjungan' => '2025-02-28', 'usiaHamil' => 28,
            ],
            [
                'nama' => 'Dewi Rahayu', 'nik' => '3508010202990002',
                'noHp' => '082345678901', 'tglLahir' => '1999-02-02',
                'alamat' => 'Jl. Melati No. 5', 'dusun' => 'Tegal Boto',
                'kecamatan' => 'Kaliwates', 'kategori' => 'balita',
                'anakKe' => 2, 'tglKunjungan' => '2026-01-05', 'usiaHamil' => null,
            ],
            [
                'nama' => 'Nur Halimah', 'nik' => '3508010303000003',
                'noHp' => '083456789012', 'tglLahir' => '2000-03-03',
                'alamat' => 'Jl. Kenanga No. 8', 'dusun' => 'Patrang',
                'kecamatan' => 'Patrang', 'kategori' => 'ibu',
                'anakKe' => 1, 'tglKunjungan' => '2025-11-20', 'usiaHamil' => 32,
            ],
            [
                'nama' => 'Fatimah Azzahra', 'nik' => '3508010505020005',
                'noHp' => '085678901234', 'tglLahir' => '2002-05-05',
                'alamat' => 'Jl. Anggrek No. 17', 'dusun' => 'Mojosari',
                'kecamatan' => 'Ajung', 'kategori' => 'ibu',
                'anakKe' => 1, 'tglKunjungan' => '2026-02-28', 'usiaHamil' => 20,
            ],
            [
                'nama' => 'Bagas Pratama', 'nik' => '3508010606030006',
                'noHp' => '086789012345', 'tglLahir' => '2023-06-06',
                'alamat' => 'Jl. Cempaka No. 4', 'dusun' => 'Mangli',
                'kecamatan' => 'Kaliwates', 'kategori' => 'balita',
                'anakKe' => 1, 'tglKunjungan' => '2026-03-10', 'usiaHamil' => null,
            ],
        ];

        foreach ($patients as $pData) {
            Patient::firstOrCreate(['nik' => $pData['nik']], $pData);
        }

        /* ── D2: Pemeriksaan contoh ────────────────────────── */
        $sitiAminah = Patient::where('nik', '3508010101980001')->first();
        if ($sitiAminah && $sitiAminah->pemeriksaans()->count() === 0) {
            Pemeriksaan::create([
                'patient_id'       => $sitiAminah->id,
                'tgl_periksa'      => '2025-02-28',
                'usia_hamil'       => 28,
                'berat_badan'      => 62.5,
                'tinggi_badan'     => 158.0,
                'lila'             => 25.0,
                'tekanan_darah'    => '110/70',
                'hb'               => 11.8,
                'jawaban_skrining' => [
                    'q1'=>'tidak','q2'=>'tidak','q3'=>'tidak',
                    'q4'=>'ya','q5'=>'tidak','q6'=>'tidak',
                    'q7'=>'tidak','q8'=>'tidak','q9'=>'tidak','q10'=>'ya',
                ],
                'level_risiko'     => 'sedang',
                'skor_ya'          => 2,
                'tindak_lanjut'    => [
                    'Pemberian TTD + pemantauan konsumsi rutin',
                    'Konseling gizi ibu hamil lebih intensif',
                    'Jadwal kontrol lebih sering (2 minggu sekali)',
                ],
                'petugas_id'       => $petugas->id,
                'catatan'          => 'Bengkak ringan pada kaki, dianjurkan kurangi garam.',
            ]);
        }

        $bagasPratama = Patient::where('nik', '3508010606030006')->first();
        if ($bagasPratama && $bagasPratama->pemeriksaans()->count() === 0) {
            Pemeriksaan::create([
                'patient_id'       => $bagasPratama->id,
                'tgl_periksa'      => '2026-03-10',
                'berat_badan'      => 9.8,
                'tinggi_badan'     => 78.5,
                'lingkar_kepala'   => 44.0,
                'usia_balita'      => 21,
                'imunisasi'        => 'belum_lengkap',
                'jawaban_skrining' => [
                    's1'=>'ya','s2'=>'ya','s3'=>'tidak',
                    's4'=>'ya','s5'=>'tidak','s6'=>'ya',
                    'p1'=>'tidak','p2'=>'tidak','p3'=>'tidak',
                    'p4'=>'tidak','p5'=>'tidak','p6'=>'tidak',
                ],
                'level_risiko'     => 'sedang',
                'skor_ya'          => 4,
                'tindak_lanjut'    => [
                    'Pemberian PMT (Pemberian Makanan Tambahan)',
                    'Edukasi intensif pola makan (protein tinggi)',
                    'Pemantauan berat badan tiap bulan',
                    'Konsultasi ke Puskesmas',
                ],
                'petugas_id'       => $petugas->id,
                'catatan'          => 'BB kurang dari standar. Imunisasi belum lengkap.',
            ]);
        }

        $this->command->info('✅ Seeder selesai: 2 akun, 5 pasien, 2 pemeriksaan contoh.');
    }
}
