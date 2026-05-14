<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Posyandu - Langkah 4</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
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
    --teal-light: #d4f0ec;
    --teal-dark: #0e4f4a;
    --orange: #e85d26;
  }

  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: var(--bg);
    min-height: 100vh;
  }

  .topbar {
    width: 100%;
    height: 80px;
    background: var(--teal);
    flex-shrink: 0;
  }

  /* STEPPER */
  .stepper-wrapper {
    background: var(--bg);
    padding: 28px 40px 24px;
    display: flex; align-items: flex-start; justify-content: center;
  }
  .stepper { display: flex; align-items: center; width: 100%; max-width: 860px; }
  .step { display: flex; flex-direction: column; align-items: center; position: relative; z-index: 1; }
  .step-circle {
    width: 36px; height: 36px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 14px;
    border: 2px solid var(--border); background: var(--bg); color: var(--mute);
    position: relative; z-index: 2; transition: all 0.3s;
  }
  .step-circle.done { background: var(--teal); border-color: var(--teal); color: var(--white); }
  .step-circle.active { background: var(--navy); border-color: var(--navy); color: var(--white); box-shadow: 0 0 0 4px rgba(11,23,96,0.15); }
  .step-circle.pending { background: var(--bg); border-color: var(--border); color: var(--mute); }
  .check-icon { display: none; }
  .step-circle.done .check-icon { display: inline; }
  .step-circle.done .step-num { display: none; }
  .step-label { margin-top: 8px; font-size: 12px; font-weight: 600; color: var(--mute); white-space: nowrap; display: flex; align-items: center; gap: 4px; }
  .step-label.active-label { color: var(--navy); }
  .step-label.done-label { color: var(--teal); }
  .step-done-badge { background: var(--teal); border-radius: 50%; width: 16px; height: 16px; display: flex; align-items: center; justify-content: center; }
  .connector { flex: 1; height: 2px; background: var(--border); margin-bottom: 22px; z-index: 0; }
  .connector.done-line { background: var(--teal); }

  /* MAIN */
  .main { padding: 24px 32px; max-width: 1100px; margin: 0 auto; }

  .card {
    background: var(--white);
    border-radius: 16px;
    border: 1.5px solid var(--border);
    padding: 28px;
    display: flex;
    gap: 24px;
    align-items: stretch;
  }

  /* LEFT PANEL */
  .left-panel { flex: 1.2; display: flex; flex-direction: column; gap: 20px; min-height: 500px; }
  .avatar-circle { width: 60px; height: 60px; border-radius: 50%; background: #cce4f9; display: flex; align-items: center; justify-content: center; }
  .avatar-circle svg { width: 34px; height: 34px; fill: #5ba4d4; }
  .table-wrapper { border: 1.5px solid var(--border); border-radius: 8px; overflow: hidden; flex: 1; min-height: 380px; }
  .data-table { width: 100%; border-collapse: collapse; }
  .data-table thead tr { background: var(--teal); color: var(--white); }
  .data-table th { padding: 12px 14px; font-size: 13px; font-weight: 600; text-align: left; }
  .data-table td { padding: 13px 14px; font-size: 13px; color: var(--text); }
  .data-table tbody tr:hover { background: var(--surface); }

  /* RIGHT PANEL */
  .right-panel {
    flex: 1;
    border: 1.5px solid var(--border);
    border-radius: 12px;
    padding: 24px;
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-top: 80px;
    min-height: 550px;
    background: var(--surface);
  }

  .form-title-btn {
    background: var(--teal);
    color: var(--white);
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

  /* HASIL LIST */
  .hasil-list { display: flex; flex-direction: column; gap: 14px; padding: 4px 0; }
  .hasil-item {
    display: flex; align-items: flex-start; gap: 10px;
    font-size: 14px; font-weight: 600; color: var(--text);
    line-height: 1.5;
  }

  /* STATUS CARD */
  .status-card {
    background: var(--teal-light);
    border-radius: 12px;
    padding: 18px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    margin-top: 4px;
    align-self: center;
    width: 80%;
  }
  .status-text {
    font-size: 14px; font-weight: 700;
    color: var(--teal-dark);
    line-height: 1.5; text-align: center; flex: 1;
  }
  .status-check {
    width: 40px; height: 40px; border-radius: 50%;
    background: var(--teal);
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
  }

  .form-actions {
    display: flex; gap: 12px; justify-content: flex-end;
    margin-top: auto; padding-top: 12px;
  }

  .btn-back {
    background: var(--orange); color: var(--white); border: none; border-radius: 8px;
    padding: 12px 28px; font-size: 14px; font-weight: 700; font-family: inherit;
    cursor: pointer; transition: opacity 0.2s;
  }
  .btn-back:hover { opacity: 0.88; }

  .btn-selesai {
    background: var(--navy); color: var(--white); border: none; border-radius: 8px;
    padding: 12px 28px; font-size: 14px; font-weight: 700; font-family: inherit;
    cursor: pointer; transition: opacity 0.2s;
  }
  .btn-selesai:hover { opacity: 0.88; }
</style>
</head>
<body>

<div class="topbar"></div>

<!-- STEPPER -->
<div class="stepper-wrapper">
  <div class="stepper">

    <!-- Step 1: DONE -->
    <div class="step">
      <div class="step-circle done">
        <svg class="check-icon" width="16" height="16" viewBox="0 0 16 16" fill="none">
          <path d="M3 8L6.5 11.5L13 5" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span class="step-num">1</span>
      </div>
      <div class="step-label done-label">
        Langkah 1
        <span class="step-done-badge">
          <svg width="10" height="10" viewBox="0 0 10 10" fill="none">
            <path d="M2 5L4.2 7.2L8 3" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </span>
      </div>
    </div>

    <div class="connector done-line"></div>

    <!-- Step 2: DONE -->
    <div class="step">
      <div class="step-circle done">
        <svg class="check-icon" width="16" height="16" viewBox="0 0 16 16" fill="none">
          <path d="M3 8L6.5 11.5L13 5" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span class="step-num">2</span>
      </div>
      <div class="step-label done-label">
        Langkah 2
        <span class="step-done-badge">
          <svg width="10" height="10" viewBox="0 0 10 10" fill="none">
            <path d="M2 5L4.2 7.2L8 3" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </span>
      </div>
    </div>

    <div class="connector done-line"></div>

    <!-- Step 3: DONE -->
    <div class="step">
      <div class="step-circle done">
        <svg class="check-icon" width="16" height="16" viewBox="0 0 16 16" fill="none">
          <path d="M3 8L6.5 11.5L13 5" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span class="step-num">3</span>
      </div>
      <div class="step-label done-label">
        Langkah 3
        <span class="step-done-badge">
          <svg width="10" height="10" viewBox="0 0 10 10" fill="none">
            <path d="M2 5L4.2 7.2L8 3" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </span>
      </div>
    </div>

    <div class="connector done-line"></div>

    <!-- Step 4: ACTIVE -->
    <div class="step">
      <div class="step-circle active"><span class="step-num">4</span></div>
      <div class="step-label active-label">Langkah 4</div>
    </div>

  </div>
</div>

<!-- MAIN CONTENT -->
<div class="main">
  <div class="card">

    <!-- LEFT PANEL -->
    <div class="left-panel">
      <div class="avatar-circle">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
        </svg>
      </div>

      <div class="table-wrapper">
        <table class="data-table">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Pasien</th>
              <th>NIK</th>
              <th>Waktu Ke Posyandu</th>
              <th>Usia Ke Hamilan</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Najwa Yufentina</td>
              <td>3509308707090002</td>
              <td>29 - 03 - 2024</td>
              <td>29</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- RIGHT PANEL -->
    <div class="right-panel">
      <div class="form-title-btn">TINDAK LANJUT HASIL PEMERIKSAAN</div>

      <div class="hasil-list">
        <div class="hasil-item">1. Pemberian Tablet Tambah Darah (TTD) kepada pasien</div>
        <div class="hasil-item">2. Pemeriksaan kehamilan</div>
        <div class="hasil-item">3. Terpantau janin sehat</div>
      </div>

      <div class="status-card">
        <div class="status-text">Tidak ada tanda berbahaya<br>pada pasien</div>
        <div class="status-check">
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
            <path d="M4 10L8 14L16 6" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </div>

      <div class="form-actions">
        <button class="btn-back" onclick="window.location.href='/langkah-3'">Kembali</button>
        <button class="btn-selesai" onclick="selesai()">Selesai</button>
      </div>
    </div>

</div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const pasien = JSON.parse(localStorage.getItem('currentPasien') || 'null');
    if (!pasien) return;
    const tbody = document.querySelector('.data-table tbody');
    if (tbody) {
      tbody.innerHTML = `<tr>
        <td>1</td>
        <td>${pasien.nama}</td>
        <td>${pasien.nik}</td>
        <td>${pasien.tglKunjungan}</td>
        <td>${pasien.usiaHamil != null ? pasien.usiaHamil + ' minggu' : '-'}</td>
      </tr>`;
    }
  });

  function selesai() {
    // Bisa tambahkan notifikasi sukses sebelum redirect
    const overlay = document.createElement('div');
    overlay.style.cssText = 'position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:9999;display:flex;align-items:center;justify-content:center;';
    overlay.innerHTML = `
      <div style="background:#fff;border-radius:20px;padding:40px 48px;text-align:center;box-shadow:0 20px 60px rgba(0,0,0,.2);animation:popIn .3s cubic-bezier(.22,.68,0,1.3)">
        <div style="width:64px;height:64px;background:#0E766D;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
          <svg width="32" height="32" viewBox="0 0 32 32" fill="none"><path d="M6 16L13 23L26 10" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <div style="font-size:1.2rem;font-weight:800;color:#1a1a1a;margin-bottom:8px;">Pemeriksaan Selesai!</div>
        <div style="font-size:.9rem;color:#888;margin-bottom:24px;">Data pasien berhasil disimpan.</div>
        <div style="font-size:.82rem;color:#aaa;">Mengalihkan ke halaman daftar...</div>
      </div>
      <style>@keyframes popIn{from{transform:scale(.7);opacity:0}to{transform:scale(1);opacity:1}}</style>
    `;
    document.body.appendChild(overlay);
    setTimeout(() => { window.location.href = '/list_data_pasien'; }, 2000);
  }
</script>

</body>
</html>