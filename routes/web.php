<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

/* ══════════════════════════════════════════════════
   AUTH – Publik (tanpa login)
══════════════════════════════════════════════════ */
Route::get('/', fn() => redirect('/login'));

Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

Route::get('/daftar',   [AuthController::class, 'showRegister']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register',[AuthController::class, 'register']);

Route::get('/forgot-password', fn() => view('auth.forgot-password'));

/* ══════════════════════════════════════════════════
   PROTECTED – Petugas & Admin (harus login)
══════════════════════════════════════════════════ */
Route::middleware(['auth'])->group(function () {

    /* Dashboard */
    Route::get('/dashboard', [PatientController::class, 'dashboard']);
    Route::get('/welcome',   fn() => view('welcome'));
    Route::get('/sasaran',   fn() => view('petugas.sasaran'));

    /* ── 1.0 Kelola Data Pasien ── */
    Route::get('/list_data_pasien',       [PatientController::class, 'index']);
    Route::post('/patients',              [PatientController::class, 'store']);
    Route::get('/patients/{patient}',     [PatientController::class, 'show']);
    Route::put('/patients/{patient}',     [PatientController::class, 'update']);
    Route::delete('/patients/{patient}',  [PatientController::class, 'destroy']);

    // Legacy view routes
    Route::get('/data_pasien', function() {
        $totalPasien = \App\Models\Patient::count();
        $totalBalita = \App\Models\Patient::where('kategori', 'balita')->count();
        $totalIbu    = \App\Models\Patient::where('kategori', 'ibu')->count();
        $patients    = \App\Models\Patient::latest()->get();
        return view('admin.data_pasien', [
            'totalPasien' => $totalPasien,
            'totalBalita' => $totalBalita,
            'totalIbu'    => $totalIbu,
            'totalIgu'    => $totalIbu, // Admin's data_pasien uses totalIgu
            'patients'    => $patients
        ]);
    });

    /* ── 2.0 Proses Pemeriksaan ── */
    // Langkah 1–4 (view saja, data dihandle JS + localStorage)
    Route::get('/langkah-1', fn() => view('petugas.langkah_1'));
    Route::get('/langkah-2', fn() => view('petugas.langkah_2'));
    Route::get('/langkah-3', fn() => view('petugas.langkah_3'));
    Route::get('/langkah-4', fn() => view('petugas.langkah_4'));

    // API: simpan hasil pemeriksaan dari langkah 4
    Route::post('/pemeriksaan',                        [PemeriksaanController::class, 'store']);
    Route::get('/pemeriksaan/{pemeriksaan}',            [PemeriksaanController::class, 'show']);
    Route::get('/pasien/{patient}/riwayat',             [PemeriksaanController::class, 'riwayat']);
    Route::get('/riwayat',                              fn() => view('petugas.riwayat'));

    // Form lama (dipertahankan untuk kompatibilitas)
    Route::get('/form_ibu_hamil',  fn() => view('petugas.form_ibu_hamil'));
    Route::get('/form-ibu-hamil',  fn() => view('petugas.form_ibu_hamil'));
    Route::get('/form_balita',     fn() => view('petugas.form_balita'));
    Route::get('/form-balita',     fn() => view('petugas.form_balita'));

    /* ── 4.0 Pembuatan Laporan ── */
    Route::get('/laporan',         [LaporanController::class, 'index']);
    Route::get('/laporan/export',  [LaporanController::class, 'export']);
});

/* ══════════════════════════════════════════════════
   ADMIN ONLY – Kelola Akun (3.0)
══════════════════════════════════════════════════ */
Route::middleware(['auth'])->group(function () {
    Route::get('/data_akun',        [AkunController::class, 'index']);
    Route::post('/data_akun',       [AkunController::class, 'store']);
    Route::put('/data_akun/{user}', [AkunController::class, 'update']);
    Route::delete('/data_akun/{user}', [AkunController::class, 'destroy']);
});