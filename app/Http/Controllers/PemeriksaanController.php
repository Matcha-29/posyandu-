<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * 2.0 Proses Pemeriksaan (DFD Level 1: 2.1 + 2.2)
 * Menangani input & penyimpanan hasil 4-langkah skrining.
 */
class PemeriksaanController extends Controller
{
    // 2.1 — form input pemeriksaan (tampilkan langkah berdasar kategori)
    public function create(Patient $patient)
    {
        return view('petugas.langkah_1', compact('patient'));
    }

    // 2.2 — simpan hasil pemeriksaan lengkap dari langkah 2–4
    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id'       => 'required|exists:patients,id',
            'tgl_periksa'      => 'required|date',

            // Pengukuran ibu hamil
            'usia_hamil'       => 'nullable|integer|min:1|max:42',
            'berat_badan'      => 'nullable|numeric|min:1',
            'tinggi_badan'     => 'nullable|numeric|min:1',
            'lila'             => 'nullable|numeric|min:1',
            'tekanan_darah'    => 'nullable|string|max:20',
            'hb'               => 'nullable|numeric|min:0',

            // Pengukuran balita
            'lingkar_kepala'   => 'nullable|numeric|min:1',
            'usia_balita'      => 'nullable|integer|min:0|max:60',
            'imunisasi'        => 'nullable|in:lengkap,belum_lengkap,tidak_ada',

            // Kuesioner skrining (JSON)
            'jawaban_skrining' => 'nullable|array',

            // Hasil scoring
            'level_risiko'     => 'nullable|in:rendah,sedang,tinggi,darurat',
            'skor_ya'          => 'nullable|integer|min:0',
            'tindak_lanjut'    => 'nullable|array',

            'catatan'          => 'nullable|string',
        ]);

        $data['petugas_id'] = Auth::id();

        $periksa = Pemeriksaan::create($data);

        if ($request->wantsJson()) {
            return response()->json($periksa->load('patient'), 201);
        }
        return redirect('/list_data_pasien')->with('success', 'Pemeriksaan berhasil disimpan.');
    }

    // Riwayat pemeriksaan satu pasien
    public function riwayat(Patient $patient)
    {
        $riwayat = $patient->pemeriksaans()
                           ->with('petugas')
                           ->latest('tgl_periksa')
                           ->get();

        if (request()->wantsJson()) {
            return response()->json($riwayat);
        }
        return view('petugas.riwayat', compact('patient', 'riwayat'));
    }

    // Detail satu pemeriksaan
    public function show(Pemeriksaan $pemeriksaan)
    {
        $pemeriksaan->load(['patient', 'petugas']);

        if (request()->wantsJson()) {
            return response()->json($pemeriksaan);
        }
        return view('detail_pemeriksaan', compact('pemeriksaan'));
    }
}
