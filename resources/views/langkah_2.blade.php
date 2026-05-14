<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Posyandu - Langkah 2</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: #f0f4f8;
    min-height: 100vh;
  }

  :root { --teal: #0E766D; }

  .topbar {
    width: 100%;
    height: 80px;
    background: var(--teal);
    flex-shrink: 0;
  }

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

  .main { padding: 24px 32px; max-width: 1100px; margin: 0 auto; }

  .card {
    background: #fff;
    border-radius: 16px;
    border: 2px solid #111;
    padding: 28px;
    display: flex;
    gap: 24px;
    align-items: stretch;
  }

  .left-panel { flex: 1.2; display: flex; flex-direction: column; gap: 20px; }
  .avatar-circle { width: 60px; height: 60px; border-radius: 50%; background: #cce4f9; display: flex; align-items: center; justify-content: center; }
  .avatar-circle svg { width: 34px; height: 34px; fill: #5ba4d4; }
  .table-wrapper { border: 2px solid #111; border-radius: 8px; overflow: hidden; flex: 1; }
  .data-table { width: 100%; border-collapse: collapse; }
  .data-table thead tr { background: #0e7c7b; color: #fff; }
  .data-table th { padding: 12px 14px; font-size: 13px; font-weight: 600; text-align: left; }
  .data-table td { padding: 13px 14px; font-size: 13px; color: #374151; }
  .data-table tbody tr:hover { background: #f8fffe; }

  .right-panel {
    flex: 1; border: 2px solid #111; border-radius: 12px;
    padding: 24px; display: flex; flex-direction: column;
    gap: 18px; margin-top: 80px; min-height: 550px;
  }

  .form-title-btn {
    background: #0e7c7b; color: #fff; border: none; border-radius: 8px;
    padding: 12px 16px; font-size: 13px; font-weight: 700;
    letter-spacing: 0.5px; text-align: center; font-family: inherit; width: 100%;
  }

  .form-group { display: flex; flex-direction: column; gap: 6px; }
  .form-label { font-size: 13px; font-weight: 600; color: #374151; }
  .form-input {
    border: 1.5px solid #1a2e6e; border-radius: 8px;
    padding: 12px 14px; font-size: 14px; font-family: inherit;
    color: #374151; outline: none; transition: border-color 0.2s; background: #fff;
  }
  .form-input:focus { border-color: #0e7c7b; }

  .form-actions { display: flex; gap: 12px; justify-content: flex-end; margin-top: auto; padding-top: 12px; }
  .btn-back { background: #e85d26; color: #fff; border: none; border-radius: 8px; padding: 12px 28px; font-size: 14px; font-weight: 700; font-family: inherit; cursor: pointer; transition: opacity 0.2s; }
  .btn-back:hover { opacity: 0.88; }
  .btn-next { background: #1a2e6e; color: #fff; border: none; border-radius: 8px; padding: 12px 28px; font-size: 14px; font-weight: 700; font-family: inherit; cursor: pointer; transition: opacity 0.2s; }
  .btn-next:hover { opacity: 0.88; }
</style>
</head>
<body>

<div class="topbar"></div>

<div class="stepper-wrapper">
  <div class="stepper">
    <div class="step">
      <div class="step-circle done">
        <svg class="check-icon" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8L6.5 11.5L13 5" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <span class="step-num">1</span>
      </div>
      <div class="step-label done-label">Langkah 1 <span class="step-done-badge"><svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M2 5L4.2 7.2L8 3" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></div>
    </div>
    <div class="connector done-line"></div>
    <div class="step">
      <div class="step-circle active"><span class="step-num">2</span></div>
      <div class="step-label active-label">Langkah 2</div>
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
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/></svg>
      </div>
      <div class="table-wrapper">
        <table class="data-table">
          <thead><tr><th>#</th><th>Nama Pasien</th><th>NIK</th><th>Waktu Ke Posyandu</th><th>Usia Ke Hamilan</th></tr></thead>
          <tbody><tr><td>1</td><td>Najwa Yufentina</td><td>3509308707090002</td><td>29 - 03 - 2024</td><td>29</td></tr></tbody>
        </table>
      </div>
    </div>
    <div class="right-panel">
      <div class="form-title-btn">FORMULIR UNTUK IBU HAMIL</div>
      <div class="form-group">
        <label class="form-label">Berat Badan (Kg) :</label>
        <input class="form-input" type="number" value="10" />
      </div>
      <div class="form-group">
        <label class="form-label">Lingkar Lengan Atas (Lila) (cm) :</label>
        <input class="form-input" type="number" value="33" />
      </div>
      <div class="form-group">
        <label class="form-label">Tekanan Darah Sistole/Diastole (mm/hg) :</label>
        <input class="form-input" type="text" value="29" />
      </div>
      <div class="form-actions">
        <button class="btn-back" onclick="window.location.href='/langkah-1'">Kembali</button>
        <button class="btn-next" onclick="window.location.href='/langkah-3'">Lanjut</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const pasien = JSON.parse(localStorage.getItem('currentPasien') || 'null');
    if (!pasien) return;
    const kategoriLabel = pasien.kategori === 'ibu' ? 'Ibu Hamil' : 'Balita';
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
    const titleEl = document.querySelector('.form-title-btn');
    if (titleEl) titleEl.textContent = pasien.kategori === 'ibu' ? 'FORMULIR UNTUK IBU HAMIL' : 'FORMULIR UNTUK BALITA';
  });
</script>

</body>
</html>