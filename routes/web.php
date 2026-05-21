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

/* ── SETUP DATABASE OTOMATIS VIA BROWSER ── */
Route::get('/setup-db', function () {
    try {
        // 0. Bersihkan Cache Laravel agar mendeteksi perubahan .env terbaru
        \Illuminate\Support\Facades\Artisan::call('config:clear');
        \Illuminate\Support\Facades\Artisan::call('cache:clear');

        $host = config('database.connections.mysql.host', '127.0.0.1');
        $port = config('database.connections.mysql.port', '3306');
        $username = config('database.connections.mysql.username', 'root');
        $password = config('database.connections.mysql.password', '');
        $dbName = config('database.connections.mysql.database', 'posyandu_new');

        // 1. Buat Database Baru
        $pdo = new PDO("mysql:host=$host;port=$port", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");

        // 2. Tulis File SQL posyandu_new.sql secara dinamis
        if (file_exists(base_path('generate_sql_file.php'))) {
            include base_path('generate_sql_file.php');
        }

        // 3. Jalankan Migrations & Seeders Laravel
        \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--seed' => true]);
        
        return response()->json([
            'status' => 'success',
            'message' => "Database '$dbName' berhasil dibuat dan data default berhasil dimasukkan! Silakan login menggunakan admin@posyandu.id (admin123) atau petugas@posyandu.id (petugas123)."
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
});

/* ── DIAGNOSTIK DATABASE VIA BROWSER ── */
Route::get('/db-check', function () {
    try {
        $dbName = \Illuminate\Support\Facades\DB::connection()->getDatabaseName();
        $dbDriver = \Illuminate\Support\Facades\DB::connection()->getDriverName();
        $dbHost = config('database.connections.mysql.host');
        $dbPort = config('database.connections.mysql.port');

        $output = [
            'status' => 'connected',
            'database' => [
                'driver' => $dbDriver,
                'host' => $dbHost,
                'port' => $dbPort,
                'name' => $dbName,
            ],
            'users_table' => 'not_found',
            'users_list' => []
        ];

        if (\Illuminate\Support\Facades\Schema::hasTable('users')) {
            $output['users_table'] = 'found';
            $users = \Illuminate\Support\Facades\DB::table('users')->get(['id', 'name', 'email', 'role', 'is_active']);
            $output['users_list'] = $users;
        }

        return response()->json($output);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'failed_to_connect',
            'error' => $e->getMessage()
        ], 500);
    }
});

/* ── FORCE RESET AKUN ADMIN & PETUGAS ── */
Route::get('/reset-admin', function () {
    try {
        // 0. Bersihkan Cache Laravel secara paksa
        \Illuminate\Support\Facades\Artisan::call('config:clear');
        \Illuminate\Support\Facades\Artisan::call('cache:clear');

        // 1. Pastikan tabel users ada
        if (!\Illuminate\Support\Facades\Schema::hasTable('users')) {
            \Illuminate\Support\Facades\Artisan::call('migrate');
        }

        // 2. Hapus akun lama jika ada
        \Illuminate\Support\Facades\DB::table('users')->whereIn('email', ['admin@posyandu.id', 'petugas@posyandu.id'])->delete();

        // 3. Buat Akun Admin Baru dengan Hash Aktif
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name'      => 'Administrator',
            'email'     => 'admin@posyandu.id',
            'role'      => 'admin',
            'password'  => \Illuminate\Support\Facades\Hash::make('admin123'),
            'is_active' => true,
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);

        // 4. Buat Akun Petugas Baru dengan Hash Aktif
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name'      => 'Bidan Sari',
            'email'     => 'petugas@posyandu.id',
            'role'      => 'petugas',
            'password'  => \Illuminate\Support\Facades\Hash::make('petugas123'),
            'is_active' => true,
            'created_at'=> now(),
            'updated_at'=> now(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Akun Admin & Petugas berhasil di-reset dengan password yang 100% benar!',
            'accounts' => [
                ['email' => 'admin@posyandu.id', 'password' => 'admin123', 'role' => 'admin'],
                ['email' => 'petugas@posyandu.id', 'password' => 'petugas123', 'role' => 'petugas']
            ]
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
});

/* ── MEMBERSIHKAN FILE PEMBANTU SEMENTARA ── */
Route::get('/cleanup', function () {
    $files = [
        base_path('create_and_seed_db.php'),
        base_path('generate_sql_file.php'),
        base_path('db_check.php')
    ];

    $deleted = [];
    foreach ($files as $file) {
        if (file_exists($file)) {
            @unlink($file);
            $deleted[] = basename($file);
        }
    }

    return response()->json([
        'status' => 'success',
        'message' => 'File pembantu sementara berhasil dibersihkan dari proyek!',
        'deleted_files' => $deleted
    ]);
});

Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');


Route::get('/forgot-password', fn() => view('auth.forgot-password'));
Route::post('/forgot-password/send',   [AuthController::class, 'sendResetCode']);
Route::post('/forgot-password/verify', [AuthController::class, 'verifyResetCode']);
Route::post('/forgot-password/reset',  [AuthController::class, 'resetPassword']);
Route::get('/run-migrate', function() {
    try {
        if (!\Illuminate\Support\Facades\Schema::hasTable('password_reset_tokens')) {
            \Illuminate\Support\Facades\Schema::create('password_reset_tokens', function ($table) {
                $table->string('email')->primary();
                $table->string('token');
                $table->timestamp('created_at')->nullable();
            });
            return "Table 'password_reset_tokens' successfully created!";
        }
        return "Table 'password_reset_tokens' already exists!";
    } catch(\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});


/* ══════════════════════════════════════════════════
   PROTECTED – Petugas & Admin (harus login)
══════════════════════════════════════════════════ */
Route::middleware(['auth'])->group(function () {

    /* Dashboard */
    Route::get('/dashboard', [PatientController::class, 'dashboard']);
    Route::get('/welcome',   fn() => view('welcome'));
    Route::get('/sasaran',   fn() => view('petugas.sasaran'));

    /* ── 1.0 Kelola Data Pasien ── */
    Route::get('/list_data_pasien',           [PatientController::class, 'index']);
    Route::post('/patients',                  [PatientController::class, 'store']);
    Route::get('/patients/{patient}',         [PatientController::class, 'show']);
    Route::get('/patients/{patient}/edit',    [PatientController::class, 'edit']);
    Route::put('/patients/{patient}',         [PatientController::class, 'update']);
    Route::patch('/patients/{patient}',       [PatientController::class, 'update']);
    Route::delete('/patients/{patient}',      [PatientController::class, 'destroy']);

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