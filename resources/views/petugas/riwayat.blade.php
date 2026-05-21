<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Detail Riwayat Pemeriksaan — POSYANDU</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] },
          colors: {
            'pos-teal': '#0E766D',
            'pos-teal-dark': '#0a5c55',
            'pos-teal-light': '#e8f5f4',
            'pos-navy': '#1e2a6e',
            'pos-navy-dark': '#162060',
            'pos-bg': '#f5f7f6',
            'pos-border': '#e0ebe9',
            'pos-text': '#1a1a1a',
            'pos-muted': '#888',
          },
          borderRadius: { 'pos-radius': '12px' },
          boxShadow: { 'pos-shadow': '0 2px 16px rgba(0,0,0,.06)' }
        }
      }
    }
  </script>
</head>
<body class="bg-pos-bg text-pos-text min-h-screen flex flex-col font-sans">

  @include('layouts.header_step')

  <main class="flex-1 max-w-[860px] w-full mx-auto px-6 py-9 pb-16">

    <!-- Back Button -->
    <button onclick="history.back()" class="flex items-center gap-2 text-pos-muted hover:text-pos-teal transition-colors mb-6 text-sm font-bold">
      <i class="ti ti-arrow-left text-lg"></i> Kembali ke List Data Pasien
    </button>

    <!-- Loading State -->
    <div id="loadingState" class="flex flex-col items-center justify-center py-24 gap-3">
      <i class="ti ti-loader animate-spin text-4xl text-pos-teal"></i>
      <p class="text-sm text-pos-muted font-medium">Memuat data riwayat...</p>
    </div>

    <!-- Error State -->
    <div id="errorState" class="hidden flex-col items-center justify-center py-24 gap-3 text-center">
      <i class="ti ti-alert-triangle text-4xl text-red-400"></i>
      <p class="text-base font-bold text-red-600">Gagal memuat data</p>
      <p id="errorMsg" class="text-sm text-pos-muted"></p>
    </div>

    <!-- Content -->
    <div id="mainContent" class="hidden flex-col gap-6">

      <!-- Patient Info Card -->
      <div class="bg-white rounded-2xl border border-pos-border shadow-pos-shadow overflow-hidden">
        <div class="bg-pos-teal px-7 py-5 flex items-center gap-4">
          <div class="w-14 h-14 rounded-full bg-white/20 flex items-center justify-center">
            <i class="ti ti-user text-3xl text-white"></i>
          </div>
          <div>
            <h1 id="patientName" class="text-xl font-extrabold text-white leading-none"></h1>
            <p id="patientNik" class="text-white/70 text-xs font-bold tracking-widest mt-1.5 uppercase"></p>
          </div>
          <div id="risikoBadge" class="ml-auto px-4 py-2 rounded-full text-xs font-extrabold uppercase tracking-wider"></div>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-0 divide-x divide-pos-border border-t border-pos-border">
          <div class="px-5 py-4">
            <p class="text-[10px] font-bold text-pos-muted uppercase tracking-wider mb-1">Kategori</p>
            <p id="patientKategori" class="text-sm font-extrabold text-pos-navy"></p>
          </div>
          <div class="px-5 py-4">
            <p class="text-[10px] font-bold text-pos-muted uppercase tracking-wider mb-1">Tanggal Periksa</p>
            <p id="tglPeriksa" class="text-sm font-extrabold text-pos-navy"></p>
          </div>
          <div class="px-5 py-4">
            <p class="text-[10px] font-bold text-pos-muted uppercase tracking-wider mb-1">Kecamatan</p>
            <p id="patientKecamatan" class="text-sm font-extrabold text-pos-navy"></p>
          </div>
          <div class="px-5 py-4">
            <p class="text-[10px] font-bold text-pos-muted uppercase tracking-wider mb-1">Petugas</p>
            <p id="petugasName" class="text-sm font-extrabold text-pos-navy"></p>
          </div>
        </div>
      </div>

      <!-- Informasi Lengkap Pasien -->
      <div class="bg-white rounded-2xl border border-pos-border shadow-pos-shadow p-6">
        <div class="flex items-center gap-2.5 mb-5">
          <div class="w-9 h-9 rounded-xl bg-pos-teal-light flex items-center justify-center">
            <i class="ti ti-id-badge text-lg text-pos-teal"></i>
          </div>
          <div>
            <p class="text-[10px] font-bold text-pos-muted uppercase tracking-wider">Langkah 1</p>
            <h2 class="text-sm font-extrabold text-pos-navy leading-none mt-0.5">Informasi Lengkap Pasien</h2>
          </div>
        </div>
        <div id="infoLengkap" class="grid grid-cols-2 sm:grid-cols-3 gap-3"></div>
      </div>

      <!-- 4 Langkah Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <!-- Langkah 2: Pemeriksaan Fisik -->
        <div class="bg-white rounded-2xl border border-pos-border shadow-pos-shadow p-6">
          <div class="flex items-center gap-2.5 mb-5">
            <div class="w-9 h-9 rounded-xl bg-pos-teal-light flex items-center justify-center">
              <i class="ti ti-stethoscope text-lg text-pos-teal"></i>
            </div>
            <div>
              <p class="text-[10px] font-bold text-pos-muted uppercase tracking-wider">Langkah 2</p>
              <h2 class="text-sm font-extrabold text-pos-navy leading-none mt-0.5">Pemeriksaan Fisik</h2>
            </div>
          </div>
          <div id="pemeriksaanFisik" class="grid grid-cols-2 gap-3"></div>
        </div>

        <!-- Langkah 3: Skrining Risiko -->
        <div class="bg-white rounded-2xl border border-pos-border shadow-pos-shadow p-6">
          <div class="flex items-center gap-2.5 mb-5">
            <div class="w-9 h-9 rounded-xl bg-orange-50 flex items-center justify-center">
              <i class="ti ti-clipboard-check text-lg text-orange-500"></i>
            </div>
            <div>
              <p class="text-[10px] font-bold text-pos-muted uppercase tracking-wider">Langkah 3</p>
              <h2 class="text-sm font-extrabold text-pos-navy leading-none mt-0.5">Kuesioner Skrining</h2>
            </div>
          </div>
          <div id="skriningRisiko" class="flex flex-col gap-2"></div>
        </div>

      </div>

      <!-- Langkah 4: Hasil & Tindak Lanjut -->
      <div class="bg-white rounded-2xl border border-pos-border shadow-pos-shadow p-6">
        <div class="flex items-center gap-2.5 mb-5">
          <div class="w-9 h-9 rounded-xl bg-blue-50 flex items-center justify-center">
            <i class="ti ti-report-medical text-lg text-blue-500"></i>
          </div>
          <div>
            <p class="text-[10px] font-bold text-pos-muted uppercase tracking-wider">Langkah 4</p>
            <h2 class="text-sm font-extrabold text-pos-navy leading-none mt-0.5">Hasil & Tindak Lanjut</h2>
          </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <p class="text-[10px] font-bold text-pos-muted uppercase tracking-wider mb-3">Tindak Lanjut</p>
            <div id="tindakLanjutList" class="flex flex-col gap-2"></div>
          </div>
          <div>
            <p class="text-[10px] font-bold text-pos-muted uppercase tracking-wider mb-3">Catatan Petugas</p>
            <div id="catatanBox" class="bg-pos-bg border border-pos-border rounded-xl p-4 text-sm text-pos-text leading-relaxed min-h-[80px]"></div>
          </div>
        </div>
      </div>

    </div><!-- end mainContent -->
  </main>

  <script>
    const params   = new URLSearchParams(window.location.search);
    const patientId     = params.get('id');
    const pemeriksaanId = params.get('pemeriksaan_id');

    function showError(msg) {
      document.getElementById('loadingState').classList.add('hidden');
      const err = document.getElementById('errorState');
      err.classList.remove('hidden');
      err.classList.add('flex');
      document.getElementById('errorMsg').textContent = msg;
    }

    function setBadge(risiko) {
      const badge = document.getElementById('risikoBadge');
      const map = {
        'rendah':  { bg: 'bg-green-100 text-green-700',   icon: 'ti-circle-check' },
        'sedang':  { bg: 'bg-orange-100 text-orange-700', icon: 'ti-alert-circle' },
        'tinggi':  { bg: 'bg-red-100 text-red-700',       icon: 'ti-alert-triangle' },
        'darurat': { bg: 'bg-red-600 text-white animate-pulse', icon: 'ti-ambulance' },
      };
      const style = map[(risiko||'').toLowerCase()] || map['rendah'];
      badge.className = `ml-auto px-4 py-2 rounded-full text-xs font-extrabold uppercase tracking-wider flex items-center gap-1.5 ${style.bg}`;
      badge.innerHTML = `<i class="ti ${style.icon}"></i> Risiko ${risiko || 'Rendah'}`;
    }

    function metricCard(label, value) {
      return `<div class="bg-pos-bg border border-pos-border rounded-xl p-3">
        <p class="text-[9px] font-bold text-pos-muted uppercase tracking-wider mb-1">${label}</p>
        <p class="text-sm font-extrabold text-pos-navy">${value || '-'}</p>
      </div>`;
    }

    async function loadData() {
      if (!patientId || !pemeriksaanId) {
        showError('Parameter URL tidak valid. Pastikan id dan pemeriksaan_id tersedia.');
        return;
      }

      try {
        const res    = await fetch(`/patients/${patientId}`, { headers: { 'Accept': 'application/json' } });
        if (!res.ok) throw new Error('HTTP ' + res.status);
        const detail = await res.json();

        const pemeriksaan = (detail.pemeriksaans || []).find(p => String(p.id) === String(pemeriksaanId));
        if (!pemeriksaan) {
          showError('Data pemeriksaan tidak ditemukan.');
          return;
        }

        const h  = pemeriksaan;
        const isIbu = detail.kategori === 'ibu';

        // Patient header
        document.getElementById('patientName').textContent     = detail.nama || '-';
        document.getElementById('patientNik').textContent      = detail.nik  || '-';
        document.getElementById('patientKategori').textContent = isIbu ? 'Ibu Hamil' : 'Balita';
        document.getElementById('patientKecamatan').textContent= detail.kecamatan || '-';
        document.getElementById('tglPeriksa').textContent      = new Date(h.tgl_periksa).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
        document.getElementById('petugasName').textContent     = h.petugas ? h.petugas.name : '-';
        setBadge(h.level_risiko);

        // Informasi Lengkap Pasien
        function infoCard(label, value) {
          return `<div class="bg-pos-bg border border-pos-border rounded-xl p-3">
            <p class="text-[9px] font-bold text-pos-muted uppercase tracking-wider mb-1">${label}</p>
            <p class="text-sm font-extrabold text-pos-navy">${value || '-'}</p>
          </div>`;
        }
        const tglLahirFmt = detail.tglLahir ? new Date(detail.tglLahir).toLocaleDateString('id-ID', {day:'numeric',month:'long',year:'numeric'}) : '-';
        const tglKunjunganFmt = detail.tglKunjungan ? new Date(detail.tglKunjungan).toLocaleDateString('id-ID', {day:'numeric',month:'long',year:'numeric'}) : '-';
        let infoHtml = '';
        infoHtml += infoCard(isIbu ? 'Nama Ibu' : 'Nama Balita', detail.nama);
        infoHtml += infoCard('NIK', detail.nik);
        infoHtml += infoCard('No. HP', detail.noHp);
        infoHtml += infoCard('Tanggal Lahir', tglLahirFmt);
        infoHtml += infoCard('Kategori', isIbu ? 'Ibu Hamil' : 'Balita');
        infoHtml += infoCard('Kecamatan', detail.kecamatan);
        infoHtml += `<div class="bg-pos-bg border border-pos-border rounded-xl p-3 col-span-2 sm:col-span-1">${'<p class="text-[9px] font-bold text-pos-muted uppercase tracking-wider mb-1">Alamat</p><p class="text-sm font-extrabold text-pos-navy">' + (detail.alamat || '-') + '</p>'}</div>`;
        infoHtml += infoCard('Dusun / RT RW', detail.dusun);
        if (isIbu) {
          infoHtml += infoCard('Hamil Anak ke', detail.anakKe ? detail.anakKe + '' : '-');
          infoHtml += infoCard('Usia Kehamilan', detail.usiaHamil ? detail.usiaHamil + ' minggu' : '-');
        }
        infoHtml += infoCard('Tgl. Kunjungan Terakhir', tglKunjunganFmt);
        document.getElementById('infoLengkap').innerHTML = infoHtml;

        // Langkah 2 – Pemeriksaan Fisik
        let fisikHtml = '';
        if (isIbu) {
          fisikHtml += metricCard('Usia Kehamilan', (h.usia_hamil || '-') + ' minggu');
          fisikHtml += metricCard('Berat Badan', (h.berat_badan || '-') + ' kg');
          fisikHtml += metricCard('Tinggi Badan', (h.tinggi_badan || '-') + ' cm');
          fisikHtml += metricCard('LILA', (h.lila || '-') + ' cm');
          fisikHtml += metricCard('Tekanan Darah', (h.tekanan_darah || '-') + ' mmHg');
          fisikHtml += metricCard('Kadar Hb', (h.hb || '-') + ' g/dL');
        } else {
          fisikHtml += metricCard('Usia Balita', (h.usia_balita || '-') + ' bulan');
          fisikHtml += metricCard('Berat Badan', (h.berat_badan || '-') + ' kg');
          fisikHtml += metricCard('Tinggi/Panjang', (h.tinggi_badan || '-') + ' cm');
          fisikHtml += metricCard('Lingkar Kepala', (h.lingkar_kepala || '-') + ' cm');
          fisikHtml += `<div class="col-span-2">${metricCard('Status Imunisasi', (h.imunisasi || '-').replace(/_/g, ' '))}</div>`;
        }
        document.getElementById('pemeriksaanFisik').innerHTML = fisikHtml;

        // Langkah 3 – Skrining
        const skriningEl = document.getElementById('skriningRisiko');
        if (h.jawaban_skrining && Object.keys(h.jawaban_skrining).length > 0) {
          skriningEl.innerHTML = Object.entries(h.jawaban_skrining).map(([q, val]) => {
            const isYa = val === 'ya';
            return `<div class="flex items-start justify-between gap-3 py-2 border-b border-pos-border last:border-0">
              <span class="text-[12px] text-pos-text leading-snug flex-1">${q}</span>
              <span class="px-2 py-0.5 rounded text-[9px] font-extrabold uppercase shrink-0 ${isYa ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700'}">${val.toUpperCase()}</span>
            </div>`;
          }).join('');
        } else {
          skriningEl.innerHTML = '<p class="text-sm text-pos-muted italic">Tidak ada data kuesioner.</p>';
        }

        // Langkah 4 – Tindak Lanjut
        const tlEl = document.getElementById('tindakLanjutList');
        if (h.tindak_lanjut && h.tindak_lanjut.length > 0) {
          tlEl.innerHTML = h.tindak_lanjut.map(tl =>
            `<div class="flex items-start gap-2 text-sm text-pos-text">
              <i class="ti ti-circle-check text-pos-teal text-base shrink-0 mt-0.5"></i>
              <span>${tl}</span>
            </div>`
          ).join('');
        } else {
          tlEl.innerHTML = '<p class="text-sm text-pos-muted italic">Tidak ada tindak lanjut.</p>';
        }

        document.getElementById('catatanBox').textContent = h.catatan || 'Tidak ada catatan.';

        // Show content
        document.getElementById('loadingState').classList.add('hidden');
        const mc = document.getElementById('mainContent');
        mc.classList.remove('hidden');
        mc.classList.add('flex');

      } catch (err) {
        console.error(err);
        showError('Terjadi kesalahan saat mengambil data: ' + err.message);
      }
    }

    loadData();
  </script>

</body>
</html>
