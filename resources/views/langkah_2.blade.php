<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Posyandu – Langkah 2</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  :root { --teal:#0E766D; --navy:#1a2e6e; --orange:#e85d26; --bg:#f0f4f8; --border:#d0d8e4; --text:#1c2340; }
  *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
  body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--bg);min-height:100vh}
  .topbar{width:100%;height:80px;background:var(--teal)}

  .stepper-wrapper{padding:28px 40px 20px;display:flex;justify-content:center}
  .stepper{display:flex;align-items:center;width:100%;max-width:860px}
  .step{display:flex;flex-direction:column;align-items:center;z-index:1}
  .step-circle{width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:14px;border:2px solid var(--border);background:var(--bg);color:#bbb;z-index:2;transition:all .3s}
  .step-circle.done{background:#16a085;border-color:#16a085;color:#fff}
  .step-circle.active{background:var(--navy);border-color:var(--navy);color:#fff;box-shadow:0 0 0 4px rgba(26,46,110,.15)}
  .check-icon{display:none}.step-circle.done .check-icon{display:inline}.step-circle.done .step-num{display:none}
  .step-label{margin-top:8px;font-size:12px;font-weight:600;color:#aaa;white-space:nowrap;display:flex;align-items:center;gap:4px}
  .step-label.active-label{color:var(--navy)}.step-label.done-label{color:#16a085}
  .step-done-badge{background:#16a085;border-radius:50%;width:16px;height:16px;display:flex;align-items:center;justify-content:center}
  .connector{flex:1;height:2px;background:var(--border);margin-bottom:22px}
  .connector.done-line{background:#16a085}

  .main{padding:20px 32px 40px;max-width:1100px;margin:0 auto}
  .card{background:#fff;border-radius:16px;border:2px solid #c8d5e0;padding:28px;display:flex;gap:24px;align-items:stretch}

  .left-panel{flex:1.2;display:flex;flex-direction:column;gap:16px}
  .avatar-circle{width:56px;height:56px;border-radius:50%;background:#cce4f9;display:flex;align-items:center;justify-content:center}
  .avatar-circle svg{width:32px;height:32px;fill:#5ba4d4}
  .table-wrapper{border:2px solid #c8d5e0;border-radius:8px;overflow:hidden;flex:1}
  .data-table{width:100%;border-collapse:collapse}
  .data-table thead tr{background:var(--teal);color:#fff}
  .data-table th{padding:11px 13px;font-size:12px;font-weight:700;text-align:left}
  .data-table td{padding:12px 13px;font-size:12px;color:var(--text)}
  .data-table tbody tr:hover{background:#f0fffe}

  .right-panel{flex:1;border:2px solid #c8d5e0;border-radius:12px;padding:22px;display:flex;flex-direction:column;gap:14px;margin-top:72px;min-height:480px}
  .panel-title{background:var(--teal);color:#fff;border-radius:8px;padding:11px 16px;font-size:13px;font-weight:700;letter-spacing:.5px;text-align:center;width:100%}

  /* Pengukuran fields */
  .form-group{display:flex;flex-direction:column;gap:6px}
  .form-label{font-size:12px;font-weight:700;color:var(--text)}
  .form-input{border:1.5px solid var(--navy);border-radius:8px;padding:10px 13px;font-size:13px;font-family:inherit;color:var(--text);outline:none;transition:border-color .2s;background:#fff}
  .form-input:focus{border-color:var(--teal)}
  .form-grid-2{display:grid;grid-template-columns:1fr 1fr;gap:12px}

  /* Balita section */
  .section-label{font-size:12px;font-weight:800;color:var(--teal);text-transform:uppercase;letter-spacing:.8px;border-bottom:2px solid #d4f0ec;padding-bottom:6px}

  .form-actions{display:flex;gap:12px;justify-content:flex-end;margin-top:auto;padding-top:10px}
  .btn-back{background:var(--orange);color:#fff;border:none;border-radius:8px;padding:11px 26px;font-size:13px;font-weight:700;font-family:inherit;cursor:pointer;transition:opacity .2s}
  .btn-back:hover{opacity:.88}
  .btn-next{background:var(--navy);color:#fff;border:none;border-radius:8px;padding:11px 26px;font-size:13px;font-weight:700;font-family:inherit;cursor:pointer;transition:opacity .2s}
  .btn-next:hover{opacity:.88}
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
          <thead>
            <tr><th>#</th><th>Nama Pasien</th><th>NIK</th><th>Kunjungan</th><th>Kategori</th></tr>
          </thead>
          <tbody id="pasienTable">
            <tr><td colspan="5" style="text-align:center;color:#999;padding:20px">Memuat data...</td></tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="right-panel">
      <div class="panel-title" id="panelTitle">DATA PENGUKURAN</div>
      <div id="formFields"></div>
      <div class="form-actions">
        <button class="btn-back" onclick="goBack()">Kembali</button>
        <button class="btn-next" onclick="simpanDanLanjut()">Lanjut</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const raw = localStorage.getItem('currentPatient');
    if (!raw) {
      alert('Data pasien tidak ditemukan.');
      window.location.href = '/list_data_pasien';
      return;
    }
    const p = JSON.parse(raw);
    const isIbu = p.kategori === 'ibu';
    const isBalita = p.kategori === 'balita';
    const katLabel = isIbu ? 'Ibu Hamil' : (isBalita ? 'Balita' : 'Lansia');

    document.getElementById('pasienTable').innerHTML = `
      <tr>
        <td>1</td><td>${p.nama||'-'}</td><td>${p.nik||'-'}</td>
        <td>${p.tglKunjungan||'-'}</td><td>${katLabel}</td>
      </tr>`;

    document.getElementById('panelTitle').textContent = isIbu
      ? 'PENGUKURAN – IBU HAMIL'
      : (isBalita ? 'PENGUKURAN – BALITA' : 'PENGUKURAN – LANSIA');

    const saved = JSON.parse(localStorage.getItem('langkah2Data') || '{}');
    const today = new Date().toISOString().split('T')[0];

    let fields = `
      <div class="form-group" style="grid-column:span 2">
        <label class="form-label">Tanggal Pemeriksaan</label>
        <input class="form-input" id="tgl_periksa" type="date" value="${saved.tgl_periksa || today}" />
      </div>
    `;

    if (isIbu) {
      fields += `
        <div class="form-grid-2">
          <div class="form-group">
            <label class="form-label">Usia Kehamilan (minggu)</label>
            <input class="form-input" id="usiaHamil" type="number" min="1" max="42" value="${saved.usiaHamil||p.usiaHamil||''}" placeholder="cth: 28"/>
          </div>
          <div class="form-group">
            <label class="form-label">Berat Badan (kg)</label>
            <input class="form-input" id="beratBadan" type="number" step="0.1" value="${saved.beratBadan||''}" placeholder="cth: 58.5"/>
          </div>
          <div class="form-group">
            <label class="form-label">Tinggi Badan (cm)</label>
            <input class="form-input" id="tinggiBadan" type="number" value="${saved.tinggiBadan||''}" placeholder="cth: 160"/>
          </div>
          <div class="form-group">
            <label class="form-label">Lingkar Lengan Atas / LILA (cm)</label>
            <input class="form-input" id="lila" type="number" step="0.1" value="${saved.lila||''}" placeholder="cth: 24"/>
          </div>
          <div class="form-group" style="grid-column:span 2">
            <label class="form-label">Tekanan Darah (Sistole/Diastole mmHg)</label>
            <input class="form-input" id="tekananDarah" type="text" value="${saved.tekananDarah||''}" placeholder="cth: 120/80"/>
          </div>
          <div class="form-group" style="grid-column:span 2">
            <label class="form-label">Kadar Hemoglobin / Hb (g/dL)</label>
            <input class="form-input" id="hb" type="number" step="0.1" value="${saved.hb||''}" placeholder="cth: 11.5"/>
          </div>
        </div>`;
    } else if (isBalita) {
      fields += `
        <div class="section-label">Pengukuran Fisik Balita</div>
        <div class="form-grid-2">
          <div class="form-group">
            <label class="form-label">Berat Badan (kg)</label>
            <input class="form-input" id="beratBadan" type="number" step="0.1" value="${saved.beratBadan||''}" placeholder="cth: 10.5"/>
          </div>
          <div class="form-group">
            <label class="form-label">Tinggi/Panjang Badan (cm)</label>
            <input class="form-input" id="tinggiBadan" type="number" step="0.1" value="${saved.tinggiBadan||''}" placeholder="cth: 85"/>
          </div>
          <div class="form-group">
            <label class="form-label">Lingkar Kepala (cm)</label>
            <input class="form-input" id="lingkarKepala" type="number" step="0.1" value="${saved.lingkarKepala||''}" placeholder="cth: 44"/>
          </div>
          <div class="form-group">
            <label class="form-label">Usia Balita (bulan)</label>
            <input class="form-input" id="usiaBalita" type="number" value="${saved.usiaBalita||''}" placeholder="cth: 18"/>
          </div>
          <div class="form-group" style="grid-column:span 2">
            <label class="form-label">Status Imunisasi</label>
            <select class="form-input" id="imunisasi">
              <option value="">-- Pilih Status --</option>
              <option value="lengkap" ${saved.imunisasi==='lengkap'?'selected':''}>Lengkap</option>
              <option value="belum_lengkap" ${saved.imunisasi==='belum_lengkap'?'selected':''}>Belum Lengkap</option>
              <option value="tidak_ada" ${saved.imunisasi==='tidak_ada'?'selected':''}>Tidak Ada Data</option>
            </select>
          </div>
        </div>`;
    }
    document.getElementById('formFields').innerHTML = fields;
  });

  function goBack() { window.location.href = '/langkah-1'; }

  function simpanDanLanjut() {
    const data = {};
    document.querySelectorAll('.form-input').forEach(el => {
      if (el.id) data[el.id] = el.value;
    });
    
    if (!data.tgl_periksa) {
      alert('Tanggal pemeriksaan wajib diisi');
      return;
    }

    localStorage.setItem('langkah2Data', JSON.stringify(data));
    window.location.href = '/langkah-3';
  }
</script>
</body>
</html>