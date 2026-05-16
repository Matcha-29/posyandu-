<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Posyandu – Langkah 4 – Hasil Skrining</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  :root{--teal:#0E766D;--navy:#1a2e6e;--orange:#e85d26;--bg:#f0f4f8;--border:#d0d8e4;--text:#1c2340;--green:#16a085;--yellow:#e67e22;--red:#c0392b}
  *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
  body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--bg);min-height:100vh}
  .topbar{width:100%;height:80px;background:var(--teal)}

  .stepper-wrapper{padding:28px 40px 20px;display:flex;justify-content:center}
  .stepper{display:flex;align-items:center;width:100%;max-width:860px}
  .step{display:flex;flex-direction:column;align-items:center;z-index:1}
  .step-circle{width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:14px;border:2px solid var(--border);background:var(--bg);color:#bbb;z-index:2;transition:all .3s}
  .step-circle.done{background:var(--green);border-color:var(--green);color:#fff}
  .step-circle.active{background:var(--navy);border-color:var(--navy);color:#fff;box-shadow:0 0 0 4px rgba(26,46,110,.15)}
  .check-icon{display:none}.step-circle.done .check-icon{display:inline}.step-circle.done .step-num{display:none}
  .step-label{margin-top:8px;font-size:12px;font-weight:600;color:#aaa;white-space:nowrap;display:flex;align-items:center;gap:4px}
  .step-label.active-label{color:var(--navy)}.step-label.done-label{color:var(--green)}
  .step-done-badge{background:var(--green);border-radius:50%;width:16px;height:16px;display:flex;align-items:center;justify-content:center}
  .connector{flex:1;height:2px;background:var(--border);margin-bottom:22px}
  .connector.done-line{background:var(--green)}

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

  /* RIGHT */
  .right-panel{flex:1;border:2px solid #c8d5e0;border-radius:12px;padding:22px;display:flex;flex-direction:column;gap:12px;margin-top:72px;min-height:480px}
  .panel-title{background:var(--teal);color:#fff;border-radius:8px;padding:11px 16px;font-size:13px;font-weight:700;letter-spacing:.5px;text-align:center;width:100%}

  /* RISK BADGE */
  .risk-badge{display:flex;align-items:center;justify-content:center;gap:12px;padding:14px 20px;border-radius:12px;font-weight:800;font-size:14px}
  .risk-badge.rendah{background:#d5f5e3;color:#1a7a45;border:2px solid #a9dfbf}
  .risk-badge.sedang{background:#fef9e7;color:#9a5500;border:2px solid #f9e79f}
  .risk-badge.tinggi{background:#fde8e8;color:#8b1a1a;border:2px solid #f5b7b1}
  .risk-badge.darurat{background:#f8d7da;color:#721c24;border:2px solid #f5c6cb;animation:pulse 1s infinite}
  @keyframes pulse{0%,100%{box-shadow:0 0 0 0 rgba(192,57,43,.4)}50%{box-shadow:0 0 0 8px rgba(192,57,43,0)}}
  .risk-icon{font-size:22px}

  /* SCORE ROW */
  .score-row{display:flex;gap:10px}
  .score-box{flex:1;background:#f7fafd;border:1.5px solid var(--border);border-radius:10px;padding:10px 12px;text-align:center}
  .score-box .s-num{font-size:22px;font-weight:800}
  .score-box .s-label{font-size:10px;font-weight:600;color:#7a8ba0;margin-top:2px}
  .score-box.c-green .s-num{color:var(--green)}
  .score-box.c-yellow .s-num{color:var(--yellow)}
  .score-box.c-red .s-num{color:var(--red)}

  /* TINDAK LANJUT */
  .tl-section{background:#f7fafd;border-radius:10px;padding:12px 14px;border:1.5px solid var(--border)}
  .tl-title{font-size:11px;font-weight:800;color:var(--teal);text-transform:uppercase;letter-spacing:.6px;margin-bottom:8px}
  .tl-item{display:flex;align-items:flex-start;gap:8px;font-size:12px;font-weight:600;color:var(--text);line-height:1.55;padding:3px 0}
  .tl-item::before{content:'✓';color:var(--green);font-weight:900;flex-shrink:0;margin-top:1px}
  .tl-item.warn::before{content:'⚠';color:var(--red)}

  .form-actions{display:flex;gap:12px;justify-content:flex-end;margin-top:auto;padding-top:10px;border-top:1px solid #eef2f6}
  .btn-back{background:var(--orange);color:#fff;border:none;border-radius:8px;padding:11px 26px;font-size:13px;font-weight:700;font-family:inherit;cursor:pointer;transition:opacity .2s}
  .btn-back:hover{opacity:.88}
  .btn-selesai{background:var(--navy);color:#fff;border:none;border-radius:8px;padding:11px 26px;font-size:13px;font-weight:700;font-family:inherit;cursor:pointer;transition:opacity .2s}
  .btn-selesai:hover{opacity:.88}

  /* SUCCESS OVERLAY */
  #overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:9999;align-items:center;justify-content:center}
  #overlay.show{display:flex}
  .overlay-box{background:#fff;border-radius:20px;padding:40px 48px;text-align:center;box-shadow:0 20px 60px rgba(0,0,0,.2);animation:popIn .3s cubic-bezier(.22,.68,0,1.3)}
  @keyframes popIn{from{transform:scale(.7);opacity:0}to{transform:scale(1);opacity:1}}
  .ov-icon{width:64px;height:64px;background:var(--teal);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px}
</style>
</head>
<body>
<div class="topbar"></div>

<!-- STEPPER -->
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
      <div class="step-circle done">
        <svg class="check-icon" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8L6.5 11.5L13 5" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <span class="step-num">2</span>
      </div>
      <div class="step-label done-label">Langkah 2 <span class="step-done-badge"><svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M2 5L4.2 7.2L8 3" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></div>
    </div>
    <div class="connector done-line"></div>
    <div class="step">
      <div class="step-circle done">
        <svg class="check-icon" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8L6.5 11.5L13 5" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <span class="step-num">3</span>
      </div>
      <div class="step-label done-label">Langkah 3 <span class="step-done-badge"><svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M2 5L4.2 7.2L8 3" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></div>
    </div>
    <div class="connector done-line"></div>
    <div class="step">
      <div class="step-circle active"><span class="step-num">4</span></div>
      <div class="step-label active-label">Langkah 4</div>
    </div>
  </div>
</div>

<div class="main">
  <div class="card">
    <!-- LEFT -->
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

    <!-- RIGHT -->
    <div class="right-panel">
      <div class="panel-title" id="panelTitle">HASIL & TINDAK LANJUT SKRINING</div>
      <div id="resultArea"><p style="text-align:center;color:#999">Menghitung skor...</p></div>
      <div class="form-actions">
        <button class="btn-back" onclick="window.location.href='/langkah-3'">Kembali</button>
        <button class="btn-selesai" onclick="selesai()">Selesai</button>
      </div>
    </div>
  </div>
</div>

<!-- SUCCESS OVERLAY -->
<div id="overlay">
  <div class="overlay-box">
    <div class="ov-icon">
      <svg width="32" height="32" viewBox="0 0 32 32" fill="none"><path d="M6 16L13 23L26 10" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </div>
    <div style="font-size:1.2rem;font-weight:800;color:#1a1a1a;margin-bottom:8px">Pemeriksaan Selesai!</div>
    <div style="font-size:.9rem;color:#888;margin-bottom:8px">Data pasien berhasil disimpan.</div>
    <div style="font-size:.8rem;color:#aaa">Mengalihkan ke halaman daftar...</div>
  </div>
</div>

<script>
/* ─── Definisi soal darurat ─────────────────────────────────── */
const ibuDarurat = ['q1','q5']; // perdarahan, kejang
const balitaDarurat = ['p3','p6']; // sesak napas, tidak responsif

/* ─── Tindak lanjut per level ─────────────────────────────────── */
const tlIbu = {
  rendah: [
    'Pemberian Tablet Tambah Darah (TTD) secara rutin',
    'Edukasi gizi seimbang (protein, sayur, buah)',
    'Anjuran kontrol rutin ke Posyandu / Puskesmas (ANC)',
    'Pemantauan berat badan & tekanan darah',
  ],
  sedang: [
    'Pemberian TTD + pemantauan konsumsi rutin',
    'Konseling gizi ibu hamil lebih intensif',
    'Pemeriksaan Hb (anemia) & tekanan darah',
    'Jadwal kontrol lebih sering (2 minggu sekali)',
    'Edukasi tanda bahaya kehamilan',
    'Pertimbangkan rujuk ke Puskesmas',
  ],
  tinggi: [
    'RUJUK SEGERA ke Puskesmas / Rumah Sakit',
    'Pendampingan kader / bidan saat rujukan',
    'Jangan menunda penanganan medis',
    'Pastikan ibu tidak dehidrasi & istirahat total',
    'Monitoring ketat oleh tenaga kesehatan',
  ],
};

const tlBalita = {
  rendah: [
    'Pemberian vitamin A sesuai jadwal',
    'Edukasi pola makan bergizi seimbang',
    'Lanjutkan imunisasi lengkap',
    'Pemantauan rutin berat & tinggi badan',
  ],
  sedang: [
    'Pemberian PMT (Pemberian Makanan Tambahan)',
    'Edukasi intensif pola makan (protein tinggi)',
    'Pemantauan berat badan tiap bulan',
    'Pemberian vitamin & suplemen jika perlu',
    'Konsultasi ke Puskesmas',
  ],
  tinggi: [
    'RUJUK SEGERA ke Puskesmas / Rumah Sakit',
    'Pemberian PMT intensif (tinggi kalori & protein)',
    'Penanganan penyakit penyerta (diare, infeksi)',
    'Monitoring ketat pertumbuhan',
    'Pendampingan keluarga (edukasi langsung)',
  ],
};

/* ─── Global State ───────────────────────────────────────────── */
let levelRisikoGlobal = 'rendah';
let tindakLanjutGlobal = [];

/* ─── Render ─────────────────────────────────────────────────── */
function levelInfo(level, darurat) {
  if (darurat) return { cls:'darurat', icon:'🚨', label:'DARURAT – Rujuk Segera!', color:'#8b1a1a', value:'darurat' };
  if (level === 'tinggi') return { cls:'tinggi', icon:'🔴', label:'Risiko Tinggi', color:'#8b1a1a', value:'tinggi' };
  if (level === 'sedang') return { cls:'sedang', icon:'🟡', label:'Risiko Sedang', color:'#9a5500', value:'sedang' };
  return { cls:'rendah', icon:'🟢', label:'Risiko Rendah / Normal', color:'#1a7a45', value:'rendah' };
}

function renderTL(items, darurat) {
  const isWarn = darurat || false;
  return items.map((t,i) =>
    `<div class="tl-item${i===0 && isWarn?' warn':''}">${t}</div>`
  ).join('');
}

function buildScoreBox(num, label, colorClass) {
  return `<div class="score-box ${colorClass}"><div class="s-num">${num}</div><div class="s-label">${label}</div></div>`;
}

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
  const answers = JSON.parse(localStorage.getItem('langkah3Data') || '{}');

  document.getElementById('pasienTable').innerHTML = `
    <tr>
      <td>1</td><td>${p.nama||'-'}</td><td>${p.nik||'-'}</td>
      <td>${p.tglKunjungan||'-'}</td><td>${katLabel}</td>
    </tr>`;

  const area = document.getElementById('resultArea');

  /* ═══ IBU HAMIL ════════════════════════════════════════════════ */
  if (isIbu) {
    document.getElementById('panelTitle').textContent = 'HASIL SKRINING – IBU HAMIL';

    const keys = ['q1','q2','q3','q4','q5','q6','q7','q8','q9','q10'];
    const yaCount = keys.filter(k => answers[k] === 'ya').length;
    const tidakCount = keys.filter(k => answers[k] === 'tidak').length;

    // cek darurat
    const isDarurat = ibuDarurat.some(k => answers[k] === 'ya');
    let level = 'rendah';
    if (isDarurat || yaCount >= 4) level = 'tinggi';
    else if (yaCount >= 2) level = 'sedang';

    const li = levelInfo(level, isDarurat);
    levelRisikoGlobal = li.value;
    tindakLanjutGlobal = tlIbu[level];

    area.innerHTML = `
      <div class="risk-badge ${li.cls}">
        <span class="risk-icon">${li.icon}</span>
        <span>${li.label}</span>
      </div>
      <div class="score-row">
        ${buildScoreBox(yaCount, 'Jawaban YA', yaCount >= 4 ? 'c-red' : (yaCount >= 2 ? 'c-yellow' : 'c-green'))}
        ${buildScoreBox(tidakCount, 'Jawaban TIDAK', 'c-green')}
        ${buildScoreBox(keys.length - yaCount - tidakCount, 'Belum Dijawab', 'c-yellow')}
      </div>
      <div class="tl-section">
        <div class="tl-title">📋 Tindak Lanjut – ${li.label}</div>
        ${renderTL(tindakLanjutGlobal, isDarurat)}
      </div>`;

  /* ═══ BALITA ════════════════════════════════════════════════════ */
  } else if (isBalita) {
    document.getElementById('panelTitle').textContent = 'HASIL SKRINING – BALITA';

    const sKeys = ['s1','s2','s3','s4','s5','s6'];
    const pKeys = ['p1','p2','p3','p4','p5','p6'];
    const sYa = sKeys.filter(k => answers[k] === 'ya').length;
    const pYa = pKeys.filter(k => answers[k] === 'ya').length;

    const isDarurat = balitaDarurat.some(k => answers[k] === 'ya');

    // Stunting level
    let sLevel = 'rendah';
    if (sYa >= 4) sLevel = 'tinggi';
    else if (sYa >= 2) sLevel = 'sedang';

    // Penyakit level
    let pLevel = 'rendah';
    if (isDarurat || pYa >= 2) pLevel = 'tinggi';
    else if (pYa >= 1) pLevel = 'sedang';

    // Overall = worst
    const overall = (sLevel === 'tinggi' || pLevel === 'tinggi') ? 'tinggi'
                  : (sLevel === 'sedang' || pLevel === 'sedang') ? 'sedang' : 'rendah';

    const li = levelInfo(overall, isDarurat);
    levelRisikoGlobal = li.value;
    tindakLanjutGlobal = tlBalita[overall];

    const sLi = levelInfo(sLevel, false);
    const pLi = levelInfo(pLevel, isDarurat && pLevel === 'tinggi');

    area.innerHTML = `
      <div class="risk-badge ${li.cls}">
        <span class="risk-icon">${li.icon}</span>
        <span>${li.label}</span>
      </div>
      <div class="score-row">
        ${buildScoreBox(sYa + '/6', 'Stunting', sYa >= 4 ? 'c-red' : (sYa >= 2 ? 'c-yellow' : 'c-green'))}
        ${buildScoreBox(pYa + '/6', 'Penyakit', pYa >= 2 ? 'c-red' : (pYa >= 1 ? 'c-yellow' : 'c-green'))}
        ${buildScoreBox(sLi.icon + ' ' + pLi.icon, 'Status', 'c-green')}
      </div>
      <div class="tl-section">
        <div class="tl-title">📋 Tindak Lanjut – ${li.label}</div>
        ${renderTL(tindakLanjutGlobal, isDarurat)}
      </div>`;

  } else {
    area.innerHTML = `<div class="tl-section"><div class="tl-title">Hasil</div>
      <div class="tl-item">Pemeriksaan selesai. Dokumentasi sudah tersimpan.</div></div>`;
  }
});

async function selesai() {
  const p = JSON.parse(localStorage.getItem('currentPatient') || '{}');
  const l2 = JSON.parse(localStorage.getItem('langkah2Data') || '{}');
  const l3 = JSON.parse(localStorage.getItem('langkah3Data') || '{}');

  const payload = {
    patient_id: p.id,
    tgl_periksa: l2.tgl_periksa,
    usia_hamil: l2.usiaHamil || null,
    berat_badan: l2.beratBadan || null,
    tinggi_badan: l2.tinggiBadan || null,
    lingkar_kepala: l2.lingkarKepala || null,
    lila: l2.lila || null,
    tekanan_darah: l2.tekananDarah || null,
    hb: l2.hb || null,
    imunisasi: l2.imunisasi || null,
    jawaban_skrining: l3,
    level_risiko: levelRisikoGlobal,
    tindak_lanjut: tindakLanjutGlobal,
    catatan: `Skrining otomatis: ${levelRisikoGlobal.toUpperCase()}`
  };

  try {
    const response = await fetch('/pemeriksaan', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Accept': 'application/json'
      },
      body: JSON.stringify(payload)
    });

    if (response.ok) {
      localStorage.removeItem('langkah3Data');
      localStorage.removeItem('langkah2Data');
      localStorage.removeItem('currentPatient');
      document.getElementById('overlay').classList.add('show');
      setTimeout(() => { window.location.href = '/list_data_pasien'; }, 2200);
    } else {
      const err = await response.json();
      alert('Gagal menyimpan hasil skrining: ' + (err.message || 'Error tidak diketahui'));
    }
  } catch (error) {
    console.error(error);
    alert('Terjadi kesalahan jaringan saat menyimpan data.');
  }
}
</script>
</body>
</html>