<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>List Data Pasien — POSYANDU</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
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
                        'pos-green': '#1a8a6a',
                        'pos-green-dark': '#0f6e56',
                    },
                    borderRadius: {
                        'pos-radius': '12px',
                        'pos-radius-sm': '8px',
                    },
                    boxShadow: {
                        'pos-shadow': '0 2px 16px rgba(0,0,0,.06)',
                    }
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer components {
            .btn-tambah {
                @apply flex items-center gap-[10px] px-5 py-[11px] bg-pos-teal text-white text-[0.88rem] font-bold rounded-[10px] shadow-[0_4px_14px_rgba(14,118,109,0.1)] transition-all hover:bg-pos-teal-dark hover:-translate-y-[1px];
            }
            .dd-trigger {
                @apply flex items-center gap-[10px] px-[14px] py-[10px] min-w-[170px] border-[1.5px] border-pos-border rounded-[10px] bg-white cursor-pointer shadow-[0_1px_4px_rgba(0,0,0,0.04)] transition-all hover:border-pos-teal hover:shadow-[0_0_0_3px_rgba(14,118,109,0.08)];
            }
            .search-input {
                @apply pl-[38px] pr-4 py-[10px] border-[1.5px] border-pos-border rounded-[10px] bg-white text-[0.87rem] outline-none w-[220px] shadow-[0_1px_4px_rgba(0,0,0,0.04)] transition-all focus:border-pos-teal focus:shadow-[0_0_0_3px_rgba(14,118,109,0.1)];
            }
            .tbl-header-cell {
                @apply px-3 py-4 text-[0.8rem] font-bold text-white tracking-wider uppercase;
            }
            .badge-kategori {
                @apply inline-flex items-center justify-center py-[5px] rounded-[20px] text-[0.76rem] font-bold whitespace-nowrap min-w-[90px];
            }
            .badge-kategori.ibu { @apply bg-[#d4edda] text-[#1a6b30] border border-[#a8d5b5]; }
            .badge-kategori.balita { @apply bg-[#fce4ec] text-[#ad1457] border border-[#f48fb1]; }
        }
    </style>
</head>
<body class="bg-pos-bg text-pos-text min-h-screen flex flex-col font-sans">
    <!-- ── TOP BAR ── -->
    <header class="w-full h-[70px] bg-pos-teal flex items-center px-10 shadow-[0_2px_12px_rgba(0,0,0,0.12)] shrink-0">
        <div class="text-[1.1rem] font-extrabold text-white tracking-[0.08em]">POSYANDU</div>
    </header>

    <main class="flex-1 px-10 py-9 pb-12 max-w-[1300px] w-full mx-auto">
        <h1 class="text-[1.75rem] font-extrabold text-pos-text mb-6">List Data Pasien</h1>

        <div class="toolbar flex items-center gap-[14px] mb-6 flex-wrap">
            <button class="btn-tambah" onclick="document.getElementById('katOverlay').classList.add('open')">
                Tambah Data
                <span class="w-[26px] h-[26px] bg-white/25 rounded-md flex items-center justify-center text-[1.1rem] font-black leading-none">+</span>
            </button>
            <span class="text-[0.87rem] text-pos-muted whitespace-nowrap mr-1" id="infoCount">Menampilkan 5 dari 5 data</span>
            <div class="grow"></div>

            <!-- Dropdown: Kategori -->
            <div class="relative select-none" id="ddKategori">
                <div class="dd-trigger" onclick="toggleDD('ddKategori')">
                    <span class="grow font-semibold text-[0.87rem] text-pos-text" id="ddKatLabel">Semua Kategori</span>
                    <svg class="text-pos-muted shrink-0 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m19 9-7 7-7-7"/></svg>
                </div>
                <div class="hidden absolute top-[calc(100%+8px)] left-0 min-w-full bg-white border-[1.5px] border-pos-border rounded-xl shadow-[0_8px_28px_rgba(0,0,0,0.1)] overflow-hidden z-50">
                    <div class="px-[14px] py-[10px] text-[0.86rem] font-medium text-pos-text cursor-pointer hover:bg-pos-teal-light hover:text-pos-teal-dark transition-colors active" data-val="" data-label="Semua Kategori" onclick="pickKat(this)">Semua Kategori</div>
                    <div class="h-px bg-pos-border my-1"></div>
                    <div class="px-[14px] py-[10px] text-[0.86rem] font-medium text-pos-text cursor-pointer hover:bg-pos-teal-light hover:text-pos-teal-dark transition-colors" data-val="ibu" data-label="Ibu Hamil" onclick="pickKat(this)">Ibu Hamil</div>
                    <div class="px-[14px] py-[10px] text-[0.86rem] font-medium text-pos-text cursor-pointer hover:bg-pos-teal-light hover:text-pos-teal-dark transition-colors" data-val="balita" data-label="Balita" onclick="pickKat(this)">Balita</div>
                </div>
            </div>

            <div class="relative">
                <svg class="absolute left-[11px] top-1/2 -translate-y-1/2 text-[#bbb] pointer-events-none" xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/></svg>
                <input type="text" id="searchInput" class="search-input" placeholder="Telusuri..." oninput="applyFilter()" />
            </div>

            <!-- Dropdown: Urutkan -->
            <div class="relative select-none" id="ddSort">
                <div class="dd-trigger" onclick="toggleDD('ddSort')">
                    <span class="grow font-semibold text-[0.87rem] text-pos-text" id="ddSortLabel">Urutkan</span>
                    <svg class="text-pos-muted shrink-0 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m19 9-7 7-7-7"/></svg>
                </div>
                <div class="hidden absolute top-[calc(100%+8px)] left-0 min-w-full bg-white border-[1.5px] border-pos-border rounded-xl shadow-[0_8px_28px_rgba(0,0,0,0.1)] overflow-hidden z-50">
                    <div class="px-[14px] py-[10px] text-[0.86rem] font-medium text-pos-text cursor-pointer hover:bg-pos-teal-light hover:text-pos-teal-dark transition-colors active" data-val="" data-label="Urutkan" onclick="pickSort(this)">Default</div>
                    <div class="h-px bg-pos-border my-1"></div>
                    <div class="px-[14px] py-[10px] text-[0.86rem] font-medium text-pos-text cursor-pointer hover:bg-pos-teal-light hover:text-pos-teal-dark transition-colors" data-val="nama" data-label="Nama A–Z" onclick="pickSort(this)">Nama A–Z</div>
                    <div class="px-[14px] py-[10px] text-[0.86rem] font-medium text-pos-text cursor-pointer hover:bg-pos-teal-light hover:text-pos-teal-dark transition-colors" data-val="nik" data-label="NIK" onclick="pickSort(this)">NIK</div>
                    <div class="px-[14px] py-[10px] text-[0.86rem] font-medium text-pos-text cursor-pointer hover:bg-pos-teal-light hover:text-pos-teal-dark transition-colors" data-val="kecamatan" data-label="Kecamatan" onclick="pickSort(this)">Kecamatan</div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl overflow-hidden shadow-pos-shadow border border-pos-border">
            <div class="grid grid-cols-[46px_1.3fr_178px_1fr_115px_115px_60px] bg-pos-teal px-5">
                <div class="tbl-header-cell">No.</div>
                <div class="tbl-header-cell">Nama</div>
                <div class="tbl-header-cell">NIK</div>
                <div class="tbl-header-cell">Alamat</div>
                <div class="tbl-header-cell">Kecamatan</div>
                <div class="tbl-header-cell">Kategori</div>
                <div class="tbl-header-cell">Aksi</div>
            </div>
            <div class="p-2.5 flex flex-col gap-2" id="tblBody"></div>
        </div>

        <div class="flex items-center justify-end gap-[6px] mt-5" id="pagination"></div>
    </main>

    <!-- POPUP PILIH KATEGORI -->
    <div class="hidden fixed inset-0 bg-black/45 z-[200] items-center justify-center backdrop-blur-[4px] animate-[fadeIn_0.2s_ease]" id="katOverlay" onclick="if(event.target===this) this.classList.remove('open')">
        <div class="bg-white rounded-[20px] p-9 pb-10 w-full max-w-[480px] shadow-[0_24px_64px_rgba(0,0,0,0.22)] animate-[slideUp_0.28s_cubic-bezier(0.22,0.68,0,1.2)] relative">
            <button class="absolute top-4 right-[18px] bg-none border-none text-[1.3rem] text-pos-muted hover:text-pos-text transition-colors leading-none" onclick="document.getElementById('katOverlay').classList.remove('open')">✕</button>
            <h2 class="text-[1.1rem] font-extrabold text-pos-text mb-[6px] text-center">Pilih Kategori Pasien</h2>
            <p class="text-[0.84rem] text-pos-muted text-center mb-7">Pilih kategori untuk melanjutkan pendaftaran</p>
            <div class="flex gap-[14px] justify-center">
                <a href="/form_ibu_hamil" class="flex-1 max-w-[130px] bg-pos-bg border-2 border-pos-border rounded-[16px] p-[22px_14px_18px] flex flex-col items-center gap-[10px] cursor-pointer no-underline transition-all hover:border-pos-teal hover:bg-white hover:-translate-y-1 hover:shadow-[0_10px_28px_rgba(14,118,109,0.15)] group">
                    <div class="w-[52px] h-[52px] rounded-14px bg-[#d4eeeb] flex items-center justify-center text-[1.6rem] transition-colors group-hover:bg-pos-teal">
                        <span class="group-hover:brightness-[10]">🤰</span>
                    </div>
                    <div class="text-[0.88rem] font-bold text-pos-text text-center">Ibu Hamil</div>
                </a>
                <a href="/form_balita" class="flex-1 max-w-[130px] bg-pos-bg border-2 border-pos-border rounded-[16px] p-[22px_14px_18px] flex flex-col items-center gap-[10px] cursor-pointer no-underline transition-all hover:border-pos-teal hover:bg-white hover:-translate-y-1 hover:shadow-[0_10px_28px_rgba(14,118,109,0.15)] group">
                    <div class="w-[52px] h-[52px] rounded-14px bg-[#d4eeeb] flex items-center justify-center text-[1.6rem] transition-colors group-hover:bg-pos-teal">
                        <span class="group-hover:brightness-[10]">👶</span>
                    </div>
                    <div class="text-[0.88rem] font-bold text-pos-text text-center">Balita</div>
                </a>
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH/EDIT -->
    <div class="hidden fixed inset-0 bg-black/40 z-[100] items-center justify-center backdrop-blur-[3px] animate-[fadeIn_0.2s_ease]" id="modalOverlay">
        <div class="bg-white rounded-2xl p-[32px_36px] w-full max-w-[520px] shadow-[0_20px_60px_rgba(0,0,0,0.2)] animate-[slideUp_0.25s_cubic-bezier(0.22,0.68,0,1.2)]">
            <h2 id="modalTitle" class="text-[1.15rem] font-extrabold text-pos-text mb-6">Tambah Data Pasien</h2>
            <div class="grid grid-cols-2 gap-4 mb-6">
                <div class="col-span-full">
                    <label class="block text-[0.8rem] font-bold text-pos-teal-dark mb-[5px] uppercase tracking-wider">Nama Lengkap</label>
                    <input type="text" id="fNama" class="w-full px-[14px] py-[10px] border-[1.5px] border-pos-border rounded-lg text-[0.9rem] outline-none transition-all focus:border-pos-teal focus:shadow-[0_0_0_3px_rgba(14,118,109,0.1)]" placeholder="Nama lengkap pasien" />
                </div>
                <div>
                    <label class="block text-[0.8rem] font-bold text-pos-teal-dark mb-[5px] uppercase tracking-wider">NIK</label>
                    <input type="text" id="fNik" class="w-full px-[14px] py-[10px] border-[1.5px] border-pos-border rounded-lg text-[0.9rem] outline-none transition-all focus:border-pos-teal focus:shadow-[0_0_0_3px_rgba(14,118,109,0.1)]" placeholder="16 digit NIK" maxlength="16" />
                </div>
                <div>
                    <label class="block text-[0.8rem] font-bold text-pos-teal-dark mb-[5px] uppercase tracking-wider">No. HP</label>
                    <input type="text" id="fHp" class="w-full px-[14px] py-[10px] border-[1.5px] border-pos-border rounded-lg text-[0.9rem] outline-none transition-all focus:border-pos-teal focus:shadow-[0_0_0_3px_rgba(14,118,109,0.1)]" placeholder="08xx-xxxx-xxxx" />
                </div>
                <div class="col-span-full">
                    <label class="block text-[0.8rem] font-bold text-pos-teal-dark mb-[5px] uppercase tracking-wider">Alamat</label>
                    <input type="text" id="fAlamat" class="w-full px-[14px] py-[10px] border-[1.5px] border-pos-border rounded-lg text-[0.9rem] outline-none transition-all focus:border-pos-teal focus:shadow-[0_0_0_3px_rgba(14,118,109,0.1)]" placeholder="Jl. ..." />
                </div>
                <div>
                    <label class="block text-[0.8rem] font-bold text-pos-teal-dark mb-[5px] uppercase tracking-wider">Dusun</label>
                    <input type="text" id="fDusun" class="w-full px-[14px] py-[10px] border-[1.5px] border-pos-border rounded-lg text-[0.9rem] outline-none transition-all focus:border-pos-teal focus:shadow-[0_0_0_3px_rgba(14,118,109,0.1)]" placeholder="Nama dusun" />
                </div>
                <div>
                    <label class="block text-[0.8rem] font-bold text-pos-teal-dark mb-[5px] uppercase tracking-wider">Kecamatan</label>
                    <input type="text" id="fKecamatan" class="w-full px-[14px] py-[10px] border-[1.5px] border-pos-border rounded-lg text-[0.9rem] outline-none transition-all focus:border-pos-teal focus:shadow-[0_0_0_3px_rgba(14,118,109,0.1)]" placeholder="Nama kecamatan" />
                </div>
            </div>
            <div class="flex gap-[10px] justify-end">
                <button class="px-5 py-[10px] border-[1.5px] border-pos-border rounded-lg bg-white font-bold text-[0.88rem] text-pos-muted transition-colors hover:border-pos-muted" onclick="closeModal()">Batal</button>
                <button class="px-6 py-[10px] border-none rounded-lg bg-pos-teal text-white font-bold text-[0.88rem] shadow-[0_4px_12px_rgba(14,118,109,0.1)] transition-all hover:bg-pos-teal-dark hover:-translate-y-[1px]" onclick="saveData()">Simpan</button>
            </div>
        </div>
    </div>

    <!-- ═══════════════════════════════════════════════════
         DETAIL SIDE PANEL
    ═══════════════════════════════════════════════════ -->
    <div id="detailOverlay" class="hidden fixed inset-0 bg-black/35 z-[999] animate-[fadeIn_0.25s_ease]" onclick="handleOverlayClick(event)">
      <div id="detailPanel" class="fixed top-0 right-0 w-[420px] h-screen bg-pos-bg overflow-y-auto translate-x-full transition-transform duration-300 ease-[cubic-bezier(0.4,0,0.2,1)] flex flex-col z-[1000] shadow-[-8px_0_40px_rgba(0,0,0,0.18)]">
        <div id="dpBody" class="grow p-[14px] flex flex-col gap-3 pb-[90px]"></div>
        <div class="sticky bottom-0 bg-white border-t border-pos-border p-[13px_16px]">
          <button class="w-full p-[15px] bg-pos-navy text-white rounded-[50px] text-[15px] font-medium tracking-[0.3px] transition-all active:scale-[0.98] hover:bg-pos-navy-dark" onclick="closeDetailPanel()">Kembali</button>
        </div>
      </div>
    </div>

    <script>
        /* ── DATA ── */
        let data = [
            { id:1, nama:'Siti Aminah',     nik:'3508010101980001', hp:'081234567890', alamat:'Jl. Mawar No. 12',   dusun:'Krajan',     kecamatan:'Sumbersari', kategori:'ibu',    anakKe:1, tglKunjungan:'2025-02-28', usiaHamil:28 },
            { id:2, nama:'Dewi Rahayu',     nik:'3508010202990002', hp:'082345678901', alamat:'Jl. Melati No. 5',   dusun:'Tegal Boto', kecamatan:'Kaliwates',  kategori:'balita', anakKe:2, tglKunjungan:'2026-01-05', usiaHamil:null },
            { id:3, nama:'Nur Halimah',     nik:'3508010303000003', hp:'083456789012', alamat:'Jl. Kenanga No. 8',  dusun:'Patrang',    kecamatan:'Patrang',    kategori:'ibu',    anakKe:1, tglKunjungan:'2025-11-20', usiaHamil:32 },
            { id:4, nama:'Fatimah Azzahra', nik:'3508010505020005', hp:'085678901234', alamat:'Jl. Anggrek No. 17', dusun:'Mojosari',   kecamatan:'Ajung',      kategori:'ibu',    anakKe:1, tglKunjungan:'2026-02-28', usiaHamil:20 },
            { id:5, nama:'Bagas Pratama',   nik:'3508010606030005', hp:'086789012345', alamat:'Jl. Cempaka No. 4',  dusun:'Mangli',     kecamatan:'Kaliwates',  kategori:'balita', anakKe:1, tglKunjungan:'2026-03-10', usiaHamil:null },
        ];

        let nextId = 6;
        let editId = null;
        let filtered = [...data];

        const riwayatDummy = {
            1: [{ tgl: '29-02-2003' }, { tgl: '29-02-2003' }],
            2: [{ tgl: '10-01-2025' }],
            3: [{ tgl: '15-03-2025' }, { tgl: '20-04-2025' }],
            4: [{ tgl: '05-02-2025' }],
            5: [{ tgl: '28-02-2025' }, { tgl: '28-02-2025' }],
        };

        function render() {
            const body = document.getElementById('tblBody');
            document.getElementById('infoCount').textContent = 'Menampilkan ' + filtered.length + ' dari ' + data.length + ' data';

            if (filtered.length === 0) {
                body.innerHTML = '<div class="flex flex-col items-center justify-center p-[60px_20px] text-pos-muted gap-2.5"><svg class="opacity-30" xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v7m16 0v5a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-5m16 0H4"/></svg><p class="text-[0.9rem]">Tidak ada data ditemukan</p></div>';
                return;
            }

            body.innerHTML = filtered.map((d, i) => {
                const kategoriLabel = d.kategori === 'ibu' ? 'Ibu Hamil' : 'Balita';
                return `
                <div class="grid grid-cols-[46px_1.3fr_178px_1fr_115px_115px_60px] items-center px-2 border-[1.5px] border-pos-border rounded-[10px] min-h-[58px] bg-white transition-all duration-200 hover:shadow-[0_4px_16px_rgba(14,118,109,0.1)] hover:border-[#b0d5d1] hover:bg-[#f9fffe] animate-[rowIn_0.4s_ease_both] cursor-pointer" style="animation-delay:${i * 0.05}s" onclick="goToForm(${d.id}, '${d.kategori}')">
                    <div class="px-3 py-[14px] text-sm font-bold text-pos-teal text-center">${i + 1}</div>
                    <div class="px-3 py-[14px] text-[0.875rem] text-pos-text leading-[1.4]">${d.nama}</div>
                    <div class="px-3 py-[14px] text-[0.875rem] text-pos-text leading-[1.4]">${d.nik}</div>
                    <div class="px-3 py-[14px] text-[0.875rem] text-pos-text leading-[1.4]">${d.alamat}</div>
                    <div class="px-3 py-[14px] text-[0.875rem] text-pos-text leading-[1.4]">${d.kecamatan}</div>
                    <div class="px-3 py-[14px] text-[0.875rem] text-pos-text leading-[1.4]"><span class="badge-kategori ${d.kategori}">${kategoriLabel}</span></div>
                    <div class="px-3 py-[14px] flex gap-[6px] items-center justify-center">
                        <button class="w-8 h-8 flex items-center justify-center bg-pos-teal-light text-pos-teal-dark rounded-md border-none cursor-pointer transition-all hover:opacity-85 hover:-translate-y-[1px]" onclick="event.stopPropagation(); lihat(${d.id})" title="Lihat Detail">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.27 2.943 9.542 7-1.272 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </button>
                    </div>
                </div>
            `;
            }).join('');
        }

        let activeKat  = '';
        let activeSort = '';

        function toggleDD(id) {
            const el = document.getElementById(id).querySelector('div:nth-child(2)');
            const isOpen = !el.classList.contains('hidden');
            document.querySelectorAll('.relative.select-none div:nth-child(2)').forEach(d => d.classList.add('hidden'));
            if (!isOpen) el.classList.remove('hidden');
        }

        function pickKat(item) {
            activeKat = item.dataset.val;
            document.getElementById('ddKatLabel').textContent = item.dataset.label;
            item.closest('div').querySelectorAll('div').forEach(i => i.classList.remove('active', 'bg-pos-teal-light', 'text-pos-teal-dark', 'font-bold'));
            item.classList.add('active', 'bg-pos-teal-light', 'text-pos-teal-dark', 'font-bold');
            item.closest('div').classList.add('hidden');
            applyFilter();
        }

        function pickSort(item) {
            activeSort = item.dataset.val;
            document.getElementById('ddSortLabel').textContent = item.dataset.label;
            item.closest('div').querySelectorAll('div').forEach(i => i.classList.remove('active', 'bg-pos-teal-light', 'text-pos-teal-dark', 'font-bold'));
            item.classList.add('active', 'bg-pos-teal-light', 'text-pos-teal-dark', 'font-bold');
            item.closest('div').classList.add('hidden');
            applyFilter();
        }

        document.addEventListener('click', function(e) {
            if (!e.target.closest('.relative.select-none')) {
                document.querySelectorAll('.relative.select-none div:nth-child(2)').forEach(d => d.classList.add('hidden'));
            }
        });

        function applyFilter() {
            const q = document.getElementById('searchInput').value.toLowerCase();
            filtered = data.filter(d => {
                const matchKat = !activeKat || d.kategori === activeKat;
                const matchQ   = !q || d.nama.toLowerCase().includes(q) || d.nik.includes(q) || d.alamat.toLowerCase().includes(q) || d.kecamatan.toLowerCase().includes(q);
                return matchKat && matchQ;
            });
            if (activeSort === 'nama')           filtered.sort((a,b) => a.nama.localeCompare(b.nama));
            else if (activeSort === 'nik')       filtered.sort((a,b) => a.nik.localeCompare(b.nik));
            else if (activeSort === 'kecamatan') filtered.sort((a,b) => a.kecamatan.localeCompare(b.kecamatan));
            render();
        }

        function openModal(prefill = null) {
            editId = prefill ? prefill.id : null;
            document.getElementById('modalTitle').textContent = prefill ? 'Edit Data Pasien' : 'Tambah Data Pasien';
            ['Nama','Nik','Hp','Alamat','Dusun','Kecamatan'].forEach(f => {
                document.getElementById('f'+f).value = prefill ? prefill[f.toLowerCase()] : '';
            });
            document.getElementById('modalOverlay').classList.remove('hidden');
            document.getElementById('modalOverlay').classList.add('flex');
        }
        function closeModal() {
            document.getElementById('modalOverlay').classList.add('hidden');
            document.getElementById('modalOverlay').classList.remove('flex');
            editId = null;
        }
        function saveData() {
            const nama      = document.getElementById('fNama').value.trim();
            const nik       = document.getElementById('fNik').value.trim();
            const hp        = document.getElementById('fHp').value.trim();
            const alamat    = document.getElementById('fAlamat').value.trim();
            const dusun     = document.getElementById('fDusun').value.trim();
            const kecamatan = document.getElementById('fKecamatan').value.trim();
            if (!nama || !nik || !hp) { alert('Nama, NIK, dan No. HP wajib diisi.'); return; }
            if (editId) {
                const idx = data.findIndex(d => d.id === editId);
                data[idx] = { ...data[idx], nama, nik, hp, alamat, dusun, kecamatan };
            } else {
                data.push({ id: nextId++, nama, nik, hp, alamat, dusun, kecamatan, kategori:'', anakKe:1, tglKunjungan:'-', usiaHamil:null });
            }
            closeModal();
            applyFilter();
        }
        document.getElementById('modalOverlay').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        function goToForm(id, kategori) {
            const pasien = data.find(d => d.id === id);
            if (!pasien) return;
            localStorage.setItem('currentPasien', JSON.stringify(pasien));
            window.location.href = '/langkah-1';
        }

        function lihat(id) {
            const d = data.find(d => d.id === id);
            if (!d) return;
            const riwayat = riwayatDummy[id] || [];
            const langkahLabels = ['Langkah 1', 'Langkah 2', 'Langkah 3', 'Langkah 4'];
            const accordions = langkahLabels.map((label, idx) => {
              const accId = `acc-${id}-${idx}`;
              const isOpen = idx === 0;
              let fieldsHTML = '';
              if (idx === 0) {
                fieldsHTML = `<div class="flex flex-col gap-[11px] pt-[13px]"><div class="flex flex-col gap-[5px]"><div class="text-[12px] text-pos-muted flex items-center gap-[5px]"><i class="ti ti-clock text-sm"></i> Waktu Ke Posyandu</div><input class="w-full px-[13px] py-[10px] border-[0.5px] border-pos-border rounded-pos-radius-sm text-[14px] text-pos-text bg-[#f9f9f9] text-pos-muted cursor-default outline-none" type="date" value="${d.tglKunjungan}" readonly /></div>${d.usiaHamil != null ? `<div class="flex flex-col gap-[5px]"><div class="text-[12px] text-pos-muted flex items-center gap-[5px]"><i class="ti ti-heart text-sm"></i> Usia Kehamilan (Minggu)</div><input class="w-full px-[13px] py-[10px] border-[0.5px] border-pos-border rounded-pos-radius-sm text-[14px] text-pos-text bg-[#f9f9f9] text-pos-muted cursor-default outline-none" type="number" value="${d.usiaHamil}" readonly /></div>` : ''}</div>`;
              } else {
                fieldsHTML = `<p class="text-[13px] text-pos-muted pt-3">Data belum tersedia</p>`;
              }
              return `<div class="bg-white border-[0.5px] border-pos-border rounded-pos-radius overflow-hidden mb-3" id="${accId}"><button class="w-full flex items-center gap-[10px] p-[14px_16px] bg-none border-none cursor-pointer text-left transition-colors hover:bg-gray-50" onclick="toggleAcc('${accId}')"><i class="ti ti-file-description text-[17px] text-pos-muted"></i><span class="grow text-[14px] text-pos-text">${label}</span><i class="ti ti-chevron-down text-[15px] text-pos-muted transition-transform duration-200 ${isOpen ? 'rotate-180' : ''}"></i></button><div class="px-4 pb-[14px] border-t border-pos-border ${isOpen ? 'block' : 'hidden'}">${fieldsHTML}</div></div>`;
            }).join('');

            const riwayatRows = riwayat.length > 0
              ? riwayat.map(r => `<div class="grid grid-cols-2 border-b border-pos-border last:border-none"><div class="p-[11px_12px]"><div class="text-[11px] text-pos-muted flex items-center gap-1 mb-[6px] font-medium"><i class="ti ti-clock text-[13px]"></i> Tanggal Riwayat Pemeriksaan</div><input class="w-full px-[11px] py-2 border-[0.5px] border-pos-border rounded-pos-radius-sm text-[13px] text-pos-text bg-[#f9f9f9] cursor-default outline-none" type="text" value="${r.tgl}" readonly /></div><div class="p-[11px_12px] border-l border-pos-border flex flex-col justify-center"><div class="text-[11px] text-pos-muted flex items-center gap-1 mb-[6px] font-medium"><i class="ti ti-map-pin text-[13px]"></i> Aksi</div><a href="/riwayat?id=${d.id}&tgl=${r.tgl}" class="w-full p-[8px_10px] border-[0.5px] border-pos-border rounded-pos-radius-sm bg-none cursor-pointer text-[12px] text-pos-text transition-colors hover:bg-gray-100 no-underline text-center">Lihat Detail Riwayat</a></div></div>`).join('')
              : `<p class="text-[13px] text-pos-muted p-[12px_16px]">Belum ada riwayat pemeriksaan</p>`;

            document.getElementById('dpBody').innerHTML = `
              <div class="bg-white flex flex-col items-center p-[28px_16px_8px]"><img src="{{ asset('image/logo.png') }}" class="w-[100px] h-auto" /></div>
              <div class="bg-white flex items-center justify-center gap-[5px] py-2 pb-[14px] border-b border-pos-border"><div class="w-[7px] h-[7px] rounded-full bg-pos-green"></div><div class="w-1 h-1 rounded-full bg-pos-green opacity-30"></div><div class="w-1 h-1 rounded-full bg-pos-green opacity-30"></div></div>
              <div class="bg-white border-[0.5px] border-pos-border rounded-pos-radius overflow-hidden"><div class="p-[13px_16px] border-b border-pos-border flex items-center gap-2 text-pos-muted"><i class="ti ti-user text-[17px]"></i><span class="text-[14px] font-semibold text-pos-text">Informasi Dasar</span></div><div class="p-[14px_16px] flex flex-col gap-[13px]"><div class="flex flex-col gap-[5px]"><div class="text-[12px] text-pos-muted flex items-center gap-[5px]"><i class="ti ti-user text-sm"></i> Nama Ibu</div><input class="w-full px-[13px] py-[10px] border-[0.5px] border-pos-border rounded-pos-radius-sm text-[14px] text-pos-text bg-[#f9f9f9] text-pos-muted cursor-default outline-none" type="text" value="${d.nama}" readonly /></div><div class="flex flex-col gap-[5px]"><div class="text-[12px] text-pos-muted flex items-center gap-[5px]"><i class="ti ti-baby-carriage text-sm"></i> Anak ke</div><input class="w-full px-[13px] py-[10px] border-[0.5px] border-pos-border rounded-pos-radius-sm text-[14px] text-pos-text bg-[#f9f9f9] text-pos-muted cursor-default outline-none" type="number" value="${d.anakKe}" readonly /></div></div></div>
              ${accordions}
              <div class="bg-white border-[0.5px] border-pos-border rounded-pos-radius overflow-hidden"><div class="p-[13px_16px] border-b border-pos-border font-semibold text-[14px] text-pos-text">Riwayat Pemeriksaan</div>${riwayatRows}</div>
            `;
            document.getElementById('detailOverlay').classList.remove('hidden');
            setTimeout(() => document.getElementById('detailPanel').classList.remove('translate-x-full'), 10);
        }

        function toggleAcc(id) {
          const el = document.getElementById(id);
          const body = el.querySelector('div:nth-child(2)');
          const arrow = el.querySelector('i.ti-chevron-down');
          body.classList.toggle('hidden');
          arrow.classList.toggle('rotate-180');
        }

        function closeDetailPanel() {
          document.getElementById('detailPanel').classList.add('translate-x-full');
          setTimeout(() => document.getElementById('detailOverlay').classList.add('hidden'), 300);
        }

        function handleOverlayClick(e) {
          if (e.target === document.getElementById('detailOverlay')) closeDetailPanel();
        }

        render();
    </script>
</body>
</html>