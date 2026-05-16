<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

/**
 * 1.0 Kelola Data Pasien (DFD Level 1: 1.1 – 1.5)
 */
class PatientController extends Controller
{
    // 1.1 + 1.2 + 1.3 — list pasien dengan filter & search
    public function index(Request $request)
    {
        $query = Patient::with('pemeriksaanTerakhir');

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(fn($q) =>
                $q->where('nama', 'like', "%$s%")
                  ->orWhere('nik', 'like', "%$s%")
                  ->orWhere('kecamatan', 'like', "%$s%")
            );
        }
        $patients = $query->orderBy($request->get('sort', 'created_at'), 'desc')->get();

        if ($request->wantsJson()) {
            return response()->json($patients);
        }
        return view('list_data_pasien', compact('patients'));
    }

    // 1.4 — detail satu pasien beserta riwayat pemeriksaan
    public function show(Patient $patient)
    {
        $patient->load(['pemeriksaans' => fn($q) => $q->latest()->with('petugas')]);

        if (request()->wantsJson()) {
            return response()->json($patient);
        }
        return view('data_pasien', compact('patient'));
    }

    // 1.5 — tambah pasien baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'         => 'required|string|max:150',
            'nik'          => 'required|string|size:16|unique:patients,nik',
            'noHp'         => 'required|string|max:20',
            'tglLahir'     => 'nullable|date',
            'alamat'       => 'required|string',
            'dusun'        => 'required|string|max:100',
            'kecamatan'    => 'required|string|max:100',
            'kategori'     => 'required|in:ibu,balita,lansia',
            'anakKe'       => 'nullable|integer|min:1',
            'tglKunjungan' => 'nullable|date',
            'usiaHamil'    => 'nullable|integer|min:1|max:42',
        ]);

        $patient = Patient::create($data);

        if ($request->wantsJson()) {
            return response()->json($patient, 201);
        }
        return redirect('/list_data_pasien')->with('success', 'Pasien berhasil didaftarkan.');
    }

    // 1.5 — perbarui data pasien (Admin)
    public function update(Request $request, Patient $patient)
    {
        $data = $request->validate([
            'nama'         => 'sometimes|required|string|max:150',
            'nik'          => 'sometimes|required|string|size:16|unique:patients,nik,'.$patient->id,
            'noHp'         => 'sometimes|required|string|max:20',
            'tglLahir'     => 'nullable|date',
            'alamat'       => 'sometimes|required|string',
            'dusun'        => 'sometimes|required|string|max:100',
            'kecamatan'    => 'sometimes|required|string|max:100',
            'kategori'     => 'sometimes|required|in:ibu,balita,lansia',
            'anakKe'       => 'nullable|integer|min:1',
            'tglKunjungan' => 'nullable|date',
            'usiaHamil'    => 'nullable|integer|min:1|max:42',
        ]);

        $patient->update($data);

        if ($request->wantsJson()) {
            return response()->json($patient);
        }
        return redirect('/list_data_pasien')->with('success', 'Data pasien diperbarui.');
    }

    // Hapus pasien (Admin)
    public function destroy(Patient $patient)
    {
        $patient->delete();

        if (request()->wantsJson()) {
            return response()->json(['message' => 'Pasien dihapus.']);
        }
        return redirect('/list_data_pasien')->with('success', 'Pasien dihapus.');
    }

    // 5.0 Dashboard Statistics
    public function dashboard()
    {
        $totalPasien = Patient::count();
        $totalBalita = Patient::where('kategori', 'balita')->count();
        $totalIbu    = Patient::where('kategori', 'ibu')->count();
        
        $latestPatients = Patient::latest()->take(5)->get();
        
        // Data untuk chart (contoh statis atau bisa dihitung)
        $chartData = [
            'labels' => ['JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'],
            'values' => [180, 210, 195, 240, 300, 390, 460, 380, 310, 350, 420, 400]
        ];

        return view('dashboard', compact('totalPasien', 'totalBalita', 'totalIbu', 'latestPatients', 'chartData'));
    }
}
