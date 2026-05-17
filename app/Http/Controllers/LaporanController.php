<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;

/**
 * 4.0 Pembuatan Laporan (DFD Level 1: 4.1 – 4.3)
 */
class LaporanController extends Controller
{
    // 4.1 + 4.2 + 4.3 — generate laporan pasien & pemeriksaan
    public function index(Request $request)
    {
        $request->validate([
            'dari'     => 'nullable|date',
            'sampai'   => 'nullable|date|after_or_equal:dari',
            'kategori' => 'nullable|in:ibu,balita,lansia',
            'risiko'   => 'nullable|in:rendah,sedang,tinggi,darurat',
        ]);

        // 4.2 – Ambil data pasien + pemeriksaan
        $query = Pemeriksaan::with(['patient', 'petugas'])
            ->when($request->filled('dari'),   fn($q) => $q->where('tgl_periksa', '>=', $request->dari))
            ->when($request->filled('sampai'), fn($q) => $q->where('tgl_periksa', '<=', $request->sampai))
            ->when($request->filled('risiko'), fn($q) => $q->where('level_risiko', $request->risiko))
            ->when($request->filled('kategori'), fn($q) =>
                $q->whereHas('patient', fn($pq) => $pq->where('kategori', $request->kategori))
            )
            ->latest('tgl_periksa');

        $pemeriksaans = $query->get();

        // Statistik ringkasan
        $stats = [
            'total_pemeriksaan' => $pemeriksaans->count(),
            'total_pasien'      => $pemeriksaans->pluck('patient_id')->unique()->count(),
            'per_risiko' => [
                'rendah'  => $pemeriksaans->where('level_risiko', 'rendah')->count(),
                'sedang'  => $pemeriksaans->where('level_risiko', 'sedang')->count(),
                'tinggi'  => $pemeriksaans->where('level_risiko', 'tinggi')->count(),
                'darurat' => $pemeriksaans->where('level_risiko', 'darurat')->count(),
            ],
            'per_kategori' => [
                'ibu'    => $pemeriksaans->filter(fn($p) => optional($p->patient)->kategori === 'ibu')->count(),
                'balita' => $pemeriksaans->filter(fn($p) => optional($p->patient)->kategori === 'balita')->count(),
                'lansia' => $pemeriksaans->filter(fn($p) => optional($p->patient)->kategori === 'lansia')->count(),
            ],
        ];

        if ($request->wantsJson()) {
            return response()->json(compact('pemeriksaans', 'stats'));
        }

        return view('petugas.laporan', compact('pemeriksaans', 'stats'));
    }

    // Export laporan ke CSV sederhana
    public function export(Request $request)
    {
        $request->validate([
            'dari'   => 'nullable|date',
            'sampai' => 'nullable|date|after_or_equal:dari',
        ]);

        $pemeriksaans = Pemeriksaan::with('patient')
            ->when($request->dari,   fn($q) => $q->where('tgl_periksa', '>=', $request->dari))
            ->when($request->sampai, fn($q) => $q->where('tgl_periksa', '<=', $request->sampai))
            ->latest('tgl_periksa')
            ->get();

        $filename = 'laporan_posyandu_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($pemeriksaans) {
            $handle = fopen('php://output', 'w');

            // Header CSV
            fputcsv($handle, [
                'No', 'Nama Pasien', 'NIK', 'Kategori', 'Tgl Periksa',
                'Usia Hamil (mgg)', 'Berat Badan (kg)', 'Tinggi Badan (cm)',
                'LILA (cm)', 'Tekanan Darah', 'Hb (g/dL)',
                'Usia Balita (bln)', 'Lingkar Kepala (cm)', 'Imunisasi',
                'Level Risiko', 'Skor YA',
            ]);

            foreach ($pemeriksaans as $i => $p) {
                fputcsv($handle, [
                    $i + 1,
                    optional($p->patient)->nama,
                    optional($p->patient)->nik,
                    optional($p->patient)->kategori,
                    $p->tgl_periksa?->format('d/m/Y'),
                    $p->usia_hamil,
                    $p->berat_badan,
                    $p->tinggi_badan,
                    $p->lila,
                    $p->tekanan_darah,
                    $p->hb,
                    $p->usia_balita,
                    $p->lingkar_kepala,
                    $p->imunisasi,
                    $p->level_risiko,
                    $p->skor_ya,
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
