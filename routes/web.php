<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
	return redirect('/login');
});

Route::get('/login', function () {
	return view('login');
});

Route::get('/forgot-password', function () {
	return view('forgot-password');
});

Route::get('/daftar', function () {
	return view('daftar');
});

Route::get('/register', function () {
	return view('daftar');
});

Route::get('/sasaran', function () {
	return view('sasaran');
});

Route::get('/list_data_pasien', function () {
	return view('list_data_pasien');
});

Route::get('/form_ibu_hamil', function () {
	return view('form_ibu_hamil');
});

Route::get('/form-ibu-hamil', function () {
	return view('form_ibu_hamil');
});

Route::get('/form_balita', function () {
	return view('form_balita');
});

Route::get('/form-balita', function () {
	return view('form_balita');
});

Route::get('/langkah-1', function () {
    return view('langkah_1');
});

Route::get('/langkah-2', function () {
    return view('langkah_2');
});

Route::get('/langkah-3', function () {
    return view('langkah_3');
});

Route::get('/langkah-4', function () {
    return view('langkah_4');
});

Route::get('/riwayat', function () {
    return view('riwayat');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/data_pasien', function () {
    return view('data_pasien');
});

Route::get('/data_akun', function () {
    return view('data_akun');
});