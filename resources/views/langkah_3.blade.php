<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Posyandu – Langkah 3 – Kuesioner Skrining</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  :root { --teal:#0E766D; --navy:#1a2e6e; --orange:#e85d26; --bg:#f0f4f8; --border:#d0d8e4; --text:#1c2340; }
  *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
  body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--bg);min-height:100vh}
  .topbar{width:100%;height:80px;background:var(--teal)}

  /* STEPPER */
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

  /* LAYOUT */
  .main{padding:20px 32px 40px;max-width:1100px;margin:0 auto}
  .card{background:#fff;border-radius:16px;border:2px solid #c8d5e0;padding:28px;display:flex;gap:24px;align-items:stretch}

  /* LEFT */
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
  .right-panel{flex:1;border:2px solid #c8d5e0;border-radius:12px;padding:22px;display:flex;flex-direction:column;gap:0;margin-top:72px;min-height:520px;overflow:hidden}
  .panel-title{background:var(--teal);color:#fff;border-radius:8px;padding:11px 16px;font-size:13px;font-weight:700;letter-spacing:.5px;text-align:center;width:100%;margin-bottom:14px;flex-shrink:0}

  /* SECTION HEADING */
  .section-heading{font-size:12px;font-weight:800;color:var(--teal);text-transform:uppercase;letter-spacing:.8px;border-bottom:2px solid #d4f0ec;padding-bottom:6px;margin-bottom:12px;margin-top:10px}

  /* SCROLLABLE question area */
  .q-scroll{flex:1;overflow-y:auto;padding-right:4px;display:flex;flex-direction:column;gap:0}
  .q-scroll::-webkit-scrollbar{width:5px}
  .q-scroll::-webkit-scrollbar-thumb{background:#c5dde8;border-radius:4px}

  /* QUESTION BLOCK */
  .q-block{padding:11px 0;border-bottom:1px solid #eef2f6}
  .q-block:last-child{border-bottom:none}
  .q-text{font-size:12.5px;font-weight:600;color:var(--text);line-height:1.55;margin-bottom:8px}
  .q-text .q-num{color:var(--teal);font-weight:800;margin-right:4px}

  .radio-row{display:flex;gap:24px}
  .radio-opt{display:flex;align-items:center;gap:7px;cursor:pointer}
  .radio-opt input[type="radio"]{display:none}
  .r-custom{width:20px;height:20px;border-radius:50%;border:2px solid #ccc;background:#fff;display:flex;align-items:center;justify-content:center;transition:all .2s;flex-shrink:0}
  .r-custom::after{content:'';width:9px;height:9px;border-radius:50%;background:transparent;transition:all .2s}
  .radio-opt input[type="radio"]:checked + .r-custom{border-color:var(--teal)}
  .radio-opt input[type="radio"]:checked + .r-custom::after{background:var(--teal)}
  .r-label-ya{font-size:12px;font-weight:800;color:#e74c3c;letter-spacing:.3px}
  .r-label-tidak{font-size:12px;font-weight:800;color:#27ae60;letter-spacing:.3px}

  /* DARURAT warning */
  .darurat-note{font-size:10.5px;color:#c0392b;font-weight:600;margin-top:4px;display:flex;align-items:center;gap:4px}

  /* ACTIONS */
  .form-actions{display:flex;gap:12px;justify-content:flex-end;padding-top:12px;flex-shrink:0;border-top:1px solid #eef2f6;margin-top:10px}
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
      <div class="step-circle done">
        <svg class="check-icon" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8L6.5 11.5L13 5" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <span class="step-num">2</span>
      </div>
      <div class="step-label done-label">Langkah 2 <span class="step-done-badge"><svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M2 5L4.2 7.2L8 3" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></div>
    </div>
    <div class="connector done-line"></div>
    <div class="step">
      <div class="step-circle active"><span class="step-num">3</span></div>
      <div class="step-label active-label">Langkah 3</div>
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
      <div class="panel-title" id="panelTitle">KUESIONER SKRINING</div>
      <div class="q-scroll" id="qArea">
        <p style="text-align:center;color:#999;padding:20px">Memuat kuesioner...</p>
      </div>
      <div class="form-actions">
        <button class="btn-back" onclick="window.location.href='/langkah-2'">Kembali</button>
        <button class="btn-next" onclick="simpanDanLanjut()">Lanjut</button>
      </div>
    </div>
  </div>
</div>

<script>
  // ── IBU HAMIL – 10 pertanyaan ───────────────────────────────────────────────
  const ibuQ = [
    { id:'q1',  text:'Apakah ibu mengalami perdarahan dari jalan lahir?',            darurat:true  },
    { id:'q2',  text:'Apakah gerakan janin berkurang / tidak terasa?',               darurat:false },
    { id:'q3',  text:'Apakah ibu mengalami sakit kepala hebat + pandangan kabur?',   darurat:false },
    { id:'q4',  text:'Apakah ada bengkak mendadak pada wajah / tangan / kaki?',      darurat:false },
    { id:'q5',  text:'Apakah ibu mengalami kejang atau pingsan?',                     darurat:true  },
    { id:'q6',  text:'Apakah ibu mengalami nyeri perut hebat?',                       darurat:false },
    { id:'q7',  text:'Apakah ibu mengalami demam tinggi?',                            darurat:false },
    { id:'q8',  text:'Apakah ibu tidak bisa makan/minum sama sekali (mual muntah berat)?', darurat:false },
    { id:'q9',  text:'Apakah berat badan ibu tidak naik atau turun?',                 darurat:false },
    { id:'q10', text:'Apakah ibu terlihat pucat dan sangat lemas?',                   darurat:false },
  ];

  // ── BALITA STUNTING – 6 pertanyaan ─────────────────────────────────────────
  const balitaStunting = [
    { id:'s1', text:'Apakah tinggi badan anak lebih pendek dari anak seusianya?' },
    { id:'s2', text:'Apakah berat badan anak tidak naik dalam 2–3 bulan terakhir?' },
    { id:'s3', text:'Apakah anak sering sakit berulang (batuk / diare)?' },
    { id:'s4', text:'Apakah anak tidak mendapat ASI eksklusif?' },
    { id:'s5', text:'Apakah anak jarang makan makanan bergizi (protein)?' },
    { id:'s6', text:'Apakah anak sulit makan / tidak nafsu makan?' },
  ];

  // ── BALITA PENYAKIT SERIUS – 6 pertanyaan ──────────────────────────────────
  const balitaSakit = [
    { id:'p1', text:'Apakah anak mengalami demam tinggi terus-menerus?',            darurat:false },
    { id:'p2', text:'Apakah anak mengalami diare lebih dari 3 hari?',               darurat:false },
    { id:'p3', text:'Apakah anak mengalami sesak napas / napas cepat?',             darurat:true  },
    { id:'p4', text:'Apakah anak tidak mau makan / minum sama sekali?',             darurat:false },
    { id:'p5', text:'Apakah anak lemas / tidak aktif?',                             darurat:false },
    { id:'p6', text:'Apakah anak sulit dibangunkan atau tidak responsif?',          darurat:true  },
  ];

  function buildRadio(q, idx) {
    const saved = JSON.parse(localStorage.getItem('langkah3Data') || '{}');
    const val = saved[q.id] || '';
    const yaChecked = val === 'ya' ? 'checked' : '';
    const tidakChecked = val === 'tidak' ? 'checked' : '';
    const daruratNote = q.darurat
      ? `<div class="darurat-note">⚠ Kondisi darurat — jika Ya, langsung rujuk!</div>`
      : '';
    return `
      <div class="q-block">
        <div class="q-text"><span class="q-num">${idx}.</span>${q.text}</div>
        ${daruratNote}
        <div class="radio-row">
          <label class="radio-opt">
            <input type="radio" name="${q.id}" value="ya" ${yaChecked}>
            <span class="r-custom"></span>
            <span class="r-label-ya">YA</span>
          </label>
          <label class="radio-opt">
            <input type="radio" name="${q.id}" value="tidak" ${tidakChecked}>
            <span class="r-custom"></span>
            <span class="r-label-tidak">TIDAK</span>
          </label>
        </div>
      </div>`;
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

    document.getElementById('pasienTable').innerHTML = `
      <tr>
        <td>1</td><td>${p.nama||'-'}</td><td>${p.nik||'-'}</td>
        <td>${p.tglKunjungan||'-'}</td><td>${katLabel}</td>
      </tr>`;

    const qArea = document.getElementById('qArea');

    if (isIbu) {
      document.getElementById('panelTitle').textContent = 'SKRINING RISIKO KEHAMILAN';
      let html = '<div class="section-heading">🔴 Deteksi Risiko Kehamilan Berbahaya (Jawab YA / TIDAK)</div>';
      ibuQ.forEach((q, i) => html += buildRadio(q, i+1));
      qArea.innerHTML = html;

    } else if (isBalita) {
      document.getElementById('panelTitle').textContent = 'SKRINING STUNTING & PENYAKIT BALITA';
      let html = '<div class="section-heading">🔴 Gejala Stunting</div>';
      balitaStunting.forEach((q, i) => html += buildRadio(q, i+1));
      html += '<div class="section-heading" style="margin-top:14px">🔴 Gejala Penyakit Serius</div>';
      balitaSakit.forEach((q, i) => html += buildRadio(q, i+1));
      qArea.innerHTML = html;

    } else {
      qArea.innerHTML = '<p style="color:#888;text-align:center;padding:20px">Kuesioner untuk kategori ini belum tersedia.</p>';
    }
  });

  function simpanDanLanjut() {
    const radios = document.querySelectorAll('input[type="radio"]');
    const names = new Set();
    radios.forEach(r => names.add(r.name));
    
    const data = {};
    let answeredCount = 0;
    document.querySelectorAll('input[type="radio"]:checked').forEach(el => {
      data[el.name] = el.value;
      answeredCount++;
    });

    if (answeredCount < names.size) {
      alert('Harap jawab semua pertanyaan kuesioner.');
      return;
    }

    localStorage.setItem('langkah3Data', JSON.stringify(data));
    window.location.href = '/langkah-4';
  }
</script>
</body>
</html>