<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Riwayat Pasien</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" />
  <style>
    :root {
      --teal: #0E766D;
      --navy: #0B1760;
      --white: #ffffff;
      --bg: #f6fbfb;
      --surface: #f2f6f5;
      --border: #d9e7e4;
      --text: #1c1c1c;
      --mute: #556c6a;
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background: var(--bg);
      min-height: 100vh;
    }
    .header {
      width: 100%;
      height: 80px;
      background: var(--teal);
      flex-shrink: 0;
      display: flex;
      align-items: center;
      padding: 0 40px;
    }
    .header .brand { font-size: 1.1rem; font-weight: 800; color: var(--white); letter-spacing: .08em; }
    .container {
      max-width: 900px;
      margin: 0 auto;
      padding: 24px 16px;
    }
    .page-title {
      text-align: center;
      font-size: 20px;
      font-weight: 700;
      color: var(--text);
      margin-bottom: 20px;
    }
    .card {
      background: var(--white);
      border: 1px solid var(--border);
      border-radius: 10px;
      padding: 20px 28px;
      margin-bottom: 28px;
    }
    .row {
      display: flex;
      padding: 11px 0;
      border-bottom: 1px solid var(--surface);
      font-size: 15px;
      align-items: flex-start;
    }
    .row:last-child {
      border-bottom: none;
    }
    .label {
      width: 200px;
      flex-shrink: 0;
      color: var(--text);
      font-weight: 600;
    }
    .sep {
      width: 24px;
      flex-shrink: 0;
      color: var(--mute);
    }
    .value {
      color: var(--text);
      flex: 1;
    }
    .btn-back {
      background: var(--navy);
      color: var(--white);
      border: none;
      border-radius: 8px;
      padding: 11px 24px;
      font-size: 15px;
      font-weight: 600;
      cursor: pointer;
      transition: background .2s, transform .15s;
    }
    .btn-back:hover {
      background: #0d1f8a;
      transform: translateY(-1px);
    }
    .empty-state {
      text-align: center;
      padding: 40px 20px;
      color: var(--mute);
    }
  </style>
</head>
<body>

  <div class="header">
  </div>

  <div class="container">
    <p class="page-title">Detail Riwayat Pemeriksaan</p>

    <div id="riwayatContent"></div>

    <button class="btn-back" onclick="history.back()">Kembali</button>
  </div>

  <script>
    // Data pasien (sama seperti di list_data_pasien.blade.php)
    const data = [
        { id:1, nama:'Siti Aminah',     nik:'3508010101980001', hp:'081234567890', alamat:'Jl. Mawar No. 12',   dusun:'Krajan',     kecamatan:'Sumbersari', kategori:'ibu',    anakKe:1, tglKunjungan:'2025-02-28', usiaHamil:28 },
        { id:2, nama:'Dewi Rahayu',     nik:'3508010202990002', hp:'082345678901', alamat:'Jl. Melati No. 5',   dusun:'Tegal Boto', kecamatan:'Kaliwates',  kategori:'balita', anakKe:2, tglKunjungan:'2026-01-05', usiaHamil:null },
        { id:3, nama:'Nur Halimah',     nik:'3508010303000003', hp:'083456789012', alamat:'Jl. Kenanga No. 8',  dusun:'Patrang',    kecamatan:'Patrang',    kategori:'ibu',    anakKe:1, tglKunjungan:'2025-11-20', usiaHamil:32 },
        { id:4, nama:'Rina Wulandari',  nik:'3508010404010004', hp:'084567890123', alamat:'Jl. Dahlia No. 3',   dusun:'Kebon',      kecamatan:'Pakusari',   kategori:'lansia', anakKe:3, tglKunjungan:'2026-02-15', usiaHamil:null },
        { id:5, nama:'Fatimah Azzahra', nik:'3508010505020005', hp:'085678901234', alamat:'Jl. Anggrek No. 17', dusun:'Mojosari',   kecamatan:'Ajung',      kategori:'ibu',    anakKe:1, tglKunjungan:'2026-02-28', usiaHamil:20 },
    ];

    // Ambil parameter dari URL
    const params = new URLSearchParams(window.location.search);
    const patientId = parseInt(params.get('id'));
    const tglRiwayat = params.get('tgl');

    // Cari data pasien
    const pasien = data.find(p => p.id === patientId);

    if (!pasien) {
      document.getElementById('riwayatContent').innerHTML = '<div class="empty-state">Data pasien tidak ditemukan</div>';
    } else {
      // Render data
      document.getElementById('riwayatContent').innerHTML = `
        <div class="card">
          <div class="row">
            <span class="label">Nama</span>
            <span class="sep">:</span>
            <span class="value">${pasien.nama}</span>
          </div>
          <div class="row">
            <span class="label">NIK</span>
            <span class="sep">:</span>
            <span class="value">${pasien.nik}</span>
          </div>
          <div class="row">
            <span class="label">Alamat</span>
            <span class="sep">:</span>
            <span class="value">${pasien.alamat}</span>
          </div>
          <div class="row">
            <span class="label">Dusun</span>
            <span class="sep">:</span>
            <span class="value">${pasien.dusun}</span>
          </div>
          <div class="row">
            <span class="label">Kecamatan</span>
            <span class="sep">:</span>
            <span class="value">${pasien.kecamatan}</span>
          </div>
          <div class="row">
            <span class="label">No. HP</span>
            <span class="sep">:</span>
            <span class="value">${pasien.hp}</span>
          </div>
          <div class="row">
            <span class="label">Kategori</span>
            <span class="sep">:</span>
            <span class="value">${pasien.kategori === 'ibu' ? 'Ibu Hamil' : pasien.kategori === 'balita' ? 'Balita' : 'Lansia'}</span>
          </div>
          <div class="row">
            <span class="label">Tanggal Kunjungan</span>
            <span class="sep">:</span>
            <span class="value">${tglRiwayat || pasien.tglKunjungan}</span>
          </div>
          ${pasien.usiaHamil ? `
          <div class="row">
            <span class="label">Usia Kehamilan</span>
            <span class="sep">:</span>
            <span class="value">${pasien.usiaHamil} minggu</span>
          </div>
          ` : ''}
        </div>
      `;
    }
  </script>

</body>
</html>