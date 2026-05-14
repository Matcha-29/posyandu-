<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Posyandu - Formulir Ibu Hamil</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: #f0f4f8;
    min-height: 100vh;
  }

  .topbar {
    width: 100%;
    height: 80px;
    background: var(--teal);
    flex-shrink: 0;
  }

  :root { --teal: #0E766D; }

  .stepper-wrapper {
    background: #f0f4f8;
    padding: 28px 40px 24px;
    display: flex;
    align-items: flex-start;
    justify-content: center;
  }

  .stepper {
    display: flex;
    align-items: center;
    width: 100%;
    max-width: 860px;
  }

  .step {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    z-index: 1;
  }

  .step-circle {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 14px;
    border: 2px solid #d0d0d0;
    background: #f0f4f8;
    color: #bbb;
    position: relative;
    z-index: 2;
    transition: all 0.3s;
  }

  .step-circle.done { background: #16a085; border-color: #16a085; color: #fff; }
  .step-circle.active { background: #1a2e6e; border-color: #1a2e6e; color: #fff; box-shadow: 0 0 0 4px rgba(26,46,110,0.15); }
  .step-circle.pending { background: #f0f4f8; border-color: #d0d0d0; color: #bbb; }

  .check-icon { display: none; }
  .step-circle.done .check-icon { display: inline; }
  .step-circle.done .step-num { display: none; }

  .step-label {
    margin-top: 8px;
    font-size: 12px;
    font-weight: 600;
    color: #aaa;
    white-space: nowrap;
    display: flex;
    align-items: center;
    gap: 4px;
  }
  .step-label.active-label { color: #1a2e6e; }
  .step-label.done-label { color: #16a085; }

  .step-done-badge {
    background: #16a085;
    border-radius: 50%;
    width: 16px; height: 16px;
    display: flex; align-items: center; justify-content: center;
  }

  .connector {
    flex: 1;
    height: 2px;
    background: #d0d0d0;
    margin-bottom: 22px;
    z-index: 0;
  }
  .connector.done-line { background: #16a085; }

  .main {
    padding: 24px 32px;
    max-width: 1100px;
    margin: 0 auto;
  }

  .card {
    background: #fff;
    border-radius: 16px;
    border: 2px solid #111;
    padding: 28px;
    display: flex;
    gap: 24px;
    align-items: stretch;
  }

  .left-panel {
    flex: 1.2;
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .avatar-circle {
    width: 60px; height: 60px;
    border-radius: 50%;
    background: #cce4f9;
    display: flex; align-items: center; justify-content: center;
  }
  .avatar-circle svg { width: 34px; height: 34px; fill: #5ba4d4; }

  .table-wrapper {
    border: 2px solid #111;
    border-radius: 8px;
    overflow: hidden;
    flex: 1;
  }

  .data-table { width: 100%; border-collapse: collapse; }

  .data-table thead tr { background: #0e7c7b; color: #fff; }
  .data-table th {
    padding: 12px 14px;
    font-size: 13px;
    font-weight: 600;
    text-align: left;
  }
  .data-table td {
    padding: 13px 14px;
    font-size: 13px;
    color: #374151;
  }
  .data-table tbody tr:hover { background: #f8fffe; }

  .right-panel {
    flex: 1;
    border: 2px solid #111;
    border-radius: 12px;
    padding: 24px;
    display: flex;
    flex-direction: column;
    gap: 18px;
    margin-top: 80px;
    min-height: 550px;
  }

  .form-title-btn {
    background: #0e7c7b;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 0.5px;
    text-align: center;
    font-family: inherit;
    width: 100%;
  }

  .form-group { display: flex; flex-direction: column; gap: 6px; }
  .form-label { font-size: 13px; font-weight: 600; color: #374151; }

  .form-input {
    border: 1.5px solid #1a2e6e;
    border-radius: 8px;
    padding: 12px 14px;
    font-size: 14px;
    font-family: inherit;
    color: #374151;
    outline: none;
    transition: border-color 0.2s;
    background: #fff;
  }
  .form-input:focus { border-color: #0e7c7b; }

  .form-actions {
    display: flex;
    gap: 12px;
    justify-content: flex-end;
    margin-top: auto;
    padding-top: 12px;
  }

  .btn-back {
    background: #e85d26; color: #fff; border: none; border-radius: 8px;
    padding: 12px 28px; font-size: 14px; font-weight: 700; font-family: inherit;
    cursor: pointer; transition: opacity 0.2s;
  }
  .btn-back:hover { opacity: 0.88; }

  .btn-next {
    background: #1a2e6e; color: #fff; border: none; border-radius: 8px;
    padding: 12px 28px; font-size: 14px; font-weight: 700; font-family: inherit;
    cursor: pointer; transition: opacity 0.2s;
  }
  .btn-next:hover { opacity: 0.88; }
</style>
</head>
<body>

<div class="topbar"></div>

<div class="stepper-wrapper">
  <div class="stepper">
    <div class="step">
      <div class="step-circle active"><span class="step-num">1</span></div>
      <div class="step-label active-label">Langkah 1</div>
    </div>
    <div class="connector"></div>
    <div class="step">
      <div class="step-circle pending"><span class="step-num">2</span></div>
      <div class="step-label">Langkah 2</div>
    </div>
    <div class="connector"></div>
    <div class="step">
      <div class="step-circle pending"><span class="step-num">3</span></div>
      <div class="step-label">Langkah 3</div>
    </div>
    <div class="connector"></div>
    <div class="step">
      <div class="step-circle pending"><span class="step-num">4</span></div>
      <div class="step-label">Langkah 4</div>
    </div>
  </div>
</div>

<div class="main">
  <div class="card">
    <div class="left-panel">
      <div class="avatar-circle">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
        </svg>
      </div>
      <div class="table-wrapper">
        <table class="data-table">
          <thead>
            <tr><th>#</th><th>Nama Pasien</th><th>NIK</th><th>Waktu Ke Posyandu</th><th>Kategori</th></tr>
          </thead>
          <tbody id="pasienTable">
            <tr><td colspan="5" style="text-align:center;color:#999;">Memuat data...</td></tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="right-panel">
      <div class="form-title-btn" id="formTitle">FORMULIR UNTUK IBU HAMIL</div>
      <div id="formContent">
        <p style="text-align:center;color:#999;">Memuat data...</p>
      </div>
      <div class="form-actions">
        <button class="btn-back" onclick="window.location.href='/list_data_pasien'">Kembali</button>
        <button class="btn-next" onclick="window.location.href='/langkah-2'">Lanjut</button>
      </div>
    </div>
  </div>
</div>

<script>
  // Load data pasien dari localStorage
  function loadPasienData() {
    const pasienData = localStorage.getItem('currentPasien');
    if (!pasienData) {
      document.getElementById('pasienTable').innerHTML = '<tr><td colspan="5" style="text-align:center;color:#999;">Tidak ada data pasien</td></tr>';
      return;
    }

    const pasien = JSON.parse(pasienData);
    const kategoriLabel = pasien.kategori === 'ibu' ? 'Ibu Hamil' : pasien.kategori === 'balita' ? 'Balita' : 'Lansia';
    const formTitle = pasien.kategori === 'ibu' ? 'FORMULIR UNTUK IBU HAMIL' : pasien.kategori === 'balita' ? 'FORMULIR UNTUK BALITA' : 'FORMULIR UNTUK LANSIA';

    // Tampilkan tabel
    document.getElementById('pasienTable').innerHTML = `
      <tr>
        <td>1</td>
        <td>${pasien.nama}</td>
        <td>${pasien.nik}</td>
        <td>${pasien.tglKunjungan}</td>
        <td>${kategoriLabel}</td>
      </tr>
    `;

    // Tampilkan title
    document.getElementById('formTitle').textContent = formTitle;

    // Render form sesuai kategori
    if (pasien.kategori === 'ibu') {
      document.getElementById('formContent').innerHTML = `
        <div class="form-group">
          <label class="form-label">Waktu Ke Posyandu :</label>
          <input class="form-input" type="text" value="${pasien.tglKunjungan}" readonly />
        </div>
        <div class="form-group">
          <label class="form-label">Usia Kehamilan (Minggu) :</label>
          <input class="form-input" type="number" value="${pasien.usiaHamil || ''}" />
        </div>
      `;
    } else if (pasien.kategori === 'balita') {
      document.getElementById('formContent').innerHTML = `
        <div class="form-group">
          <label class="form-label">Nama Balita :</label>
          <input class="form-input" type="text" value="${pasien.nama}" readonly />
        </div>
        <div class="form-group">
          <label class="form-label">Waktu Ke Posyandu :</label>
          <input class="form-input" type="text" value="${pasien.tglKunjungan}" readonly />
        </div>
      `;
    } else {
      document.getElementById('formContent').innerHTML = `
        <div class="form-group">
          <label class="form-label">Nama Lansia :</label>
          <input class="form-input" type="text" value="${pasien.nama}" readonly />
        </div>
        <div class="form-group">
          <label class="form-label">Waktu Ke Posyandu :</label>
          <input class="form-input" type="text" value="${pasien.tglKunjungan}" readonly />
        </div>
      `;
    }
  }

  // Load saat halaman terbuka
  document.addEventListener('DOMContentLoaded', loadPasienData);
</script>

</body>
</html>