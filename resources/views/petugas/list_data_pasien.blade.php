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
    <header class="w-full h-[70px] bg-pos-teal flex items-center justify-between px-10 shadow-[0_2px_12px_rgba(0,0,0,0.12)] shrink-0">
      <div class="flex items-center gap-3">
        <img src="{{ asset('image/logo.png') }}" class="h-10 w-auto brightness-0 invert" alt="Logo" />
        <span class="text-white font-bold text-xl tracking-tight">POSYANDU</span>
      </div>
      <div class="flex items-center gap-6">
        <div class="text-white text-right">
          <p class="text-sm font-bold leading-none">{{ Auth::user()->name }}</p>
          <p class="text-[0.7rem] opacity-80 uppercase tracking-widest mt-1">{{ Auth::user()->role }}</p>
        </div>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-all" title="Logout">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
          </button>
        </form>
      </div>
    </header>

    <main class="flex-1 px-10 py-9 pb-12 max-w-[1300px] w-full mx-auto">
        <div class="flex items-center justify-between mb-6">
          <h1 class="text-[1.75rem] font-extrabold text-pos-text">List Data Pasien</h1>
          <div class="flex items-center gap-3">
            <a href="/laporan" class="flex items-center gap-2 px-4 py-[10px] bg-white border border-pos-border rounded-lg text-[0.87rem] font-bold text-pos-text hover:bg-pos-teal-light hover:text-pos-teal hover:border-pos-teal transition-all">
              <i class="ti ti-report text-lg"></i> Laporan
            </a>
            @if(Auth::user()->role === 'admin')
            <a href="/data_akun" class="flex items-center gap-2 px-4 py-[10px] bg-white border border-pos-border rounded-lg text-[0.87rem] font-bold text-pos-text hover:bg-pos-teal-light hover:text-pos-teal hover:border-pos-teal transition-all">
              <i class="ti ti-users text-lg"></i> Kelola Akun
            </a>
            @endif
          </div>
        </div>

        <div class="toolbar flex items-center gap-[14px] mb-6 flex-wrap">
            <button class="btn-tambah" onclick="document.getElementById('katOverlay').classList.remove('hidden'); document.getElementById('katOverlay').classList.add('flex')">
                Tambah Data
                <span class="w-[26px] h-[26px] bg-white/25 rounded-md flex items-center justify-center text-[1.1rem] font-black leading-none">+</span>
            </button>
            <span class="text-[0.87rem] text-pos-muted whitespace-nowrap mr-1" id="infoCount">Menampilkan 0 dari 0 data</span>
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
    </main>

    <!-- POPUP PILIH KATEGORI -->
    <div class="hidden fixed inset-0 bg-black/45 z-[200] items-center justify-center backdrop-blur-[4px] animate-[fadeIn_0.2s_ease]" id="katOverlay" onclick="if(event.target===this) { this.classList.add('hidden'); this.classList.remove('flex'); }">
        <div class="bg-white rounded-[20px] p-9 pb-10 w-full max-w-[480px] shadow-[0_24px_64px_rgba(0,0,0,0.22)] animate-[slideUp_0.28s_cubic-bezier(0.22,0.68,0,1.2)] relative">
            <button class="absolute top-4 right-[18px] bg-none border-none text-[1.3rem] text-pos-muted hover:text-pos-text transition-colors leading-none" onclick="document.getElementById('katOverlay').classList.add('hidden'); document.getElementById('katOverlay').classList.remove('flex');">✕</button>
            <h2 class="text-[1.1rem] font-extrabold text-pos-text mb-[6px] text-center">Pilih Kategori Pasien</h2>
            <p class="text-[0.84rem] text-pos-muted text-center mb-7">Pilih kategori untuk melanjutkan pendaftaran</p>
            <div class="flex gap-[14px] justify-center">
                <button onclick="openForm('ibu')" class="flex-1 max-w-[130px] bg-pos-bg border-2 border-pos-border rounded-[16px] p-[22px_14px_18px] flex flex-col items-center gap-[10px] cursor-pointer no-underline transition-all hover:border-pos-teal hover:bg-white hover:-translate-y-1 hover:shadow-[0_10px_28px_rgba(14,118,109,0.15)] group">
                    <div class="w-[52px] h-[52px] rounded-14px bg-[#d4eeeb] flex items-center justify-center text-[1.6rem] transition-colors group-hover:bg-pos-teal">
                        <span class="group-hover:brightness-[10]">🤰</span>
                    </div>
                    <div class="text-[0.88rem] font-bold text-pos-text text-center">Ibu Hamil</div>
                </button>
                <button onclick="openForm('balita')" class="flex-1 max-w-[130px] bg-pos-bg border-2 border-pos-border rounded-[16px] p-[22px_14px_18px] flex flex-col items-center gap-[10px] cursor-pointer no-underline transition-all hover:border-pos-teal hover:bg-white hover:-translate-y-1 hover:shadow-[0_10px_28px_rgba(14,118,109,0.15)] group">
                    <div class="w-[52px] h-[52px] rounded-14px bg-[#d4eeeb] flex items-center justify-center text-[1.6rem] transition-colors group-hover:bg-pos-teal">
                        <span class="group-hover:brightness-[10]">👶</span>
                    </div>
                    <div class="text-[0.88rem] font-bold text-pos-text text-center">Balita</div>
                </button>
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH/EDIT -->
    <div class="hidden fixed inset-0 bg-black/40 z-[100] items-center justify-center backdrop-blur-[3px] animate-[fadeIn_0.2s_ease]" id="modalOverlay">
        <div class="bg-white rounded-2xl p-[32px_36px] w-full max-w-[520px] shadow-[0_20px_60px_rgba(0,0,0,0.2)] animate-[slideUp_0.25s_cubic-bezier(0.22,0.68,0,1.2)]">
            <h2 id="modalTitle" class="text-[1.15rem] font-extrabold text-pos-text mb-6">Tambah Data Pasien</h2>
            <div class="grid grid-cols-2 gap-4 mb-6">
                <input type="hidden" id="fKategori" />
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

    <!-- DETAIL SIDE PANEL -->
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
        let data = @json($patients);
        let filtered = [...data];
        let currentSort = '';
        let currentKat = '';

        function render() {
            const body = document.getElementById('tblBody');
            document.getElementById('infoCount').textContent = 'Menampilkan ' + filtered.length + ' dari ' + data.length + ' data';

            if (filtered.length === 0) {
                body.innerHTML = '<div class="flex flex-col items-center justify-center p-[60px_20px] text-pos-muted gap-2.5"><i class="ti ti-database-off text-5xl opacity-20"></i><p class="text-[0.9rem]">Tidak ada data ditemukan</p></div>';
                return;
            }

            body.innerHTML = filtered.map((d, i) => {
                const kategoriLabel = d.kategori === 'ibu' ? 'Ibu Hamil' : (d.kategori === 'balita' ? 'Balita' : 'Lansia');
                return `
                <div class="grid grid-cols-[46px_1.3fr_178px_1fr_115px_115px_60px] items-center px-2 border-[1.5px] border-pos-border rounded-[10px] min-h-[58px] bg-white transition-all duration-200 hover:shadow-[0_4px_16px_rgba(14,118,109,0.1)] hover:border-[#b0d5d1] hover:bg-[#f9fffe] animate-[rowIn_0.4s_ease_both] cursor-pointer" style="animation-delay:${i * 0.05}s" onclick="goToForm(${d.id})">
                    <div class="px-3 py-[14px] text-sm font-bold text-pos-teal text-center">${i + 1}</div>
                    <div class="px-3 py-[14px] text-[0.875rem] text-pos-text leading-[1.4]">${d.nama}</div>
                    <div class="px-3 py-[14px] text-[0.875rem] text-pos-text leading-[1.4]">${d.nik}</div>
                    <div class="px-3 py-[14px] text-[0.875rem] text-pos-text leading-[1.4]">${d.alamat}</div>
                    <div class="px-3 py-[14px] text-[0.875rem] text-pos-text leading-[1.4]">${d.kecamatan}</div>
                    <div class="px-3 py-[14px] text-[0.875rem] text-pos-text leading-[1.4]"><span class="badge-kategori ${d.kategori}">${kategoriLabel}</span></div>
                    <div class="px-3 py-[14px] flex gap-[6px] items-center justify-center">
                        <button class="w-8 h-8 flex items-center justify-center bg-pos-teal-light text-pos-teal-dark rounded-md border-none cursor-pointer transition-all hover:opacity-85 hover:-translate-y-[1px]" onclick="event.stopPropagation(); lihat(${d.id})" title="Lihat Detail">
                            <i class="ti ti-eye"></i>
                        </button>
                    </div>
                </div>`;
            }).join('');
        }

        function toggleDD(id) {
            const dd = document.getElementById(id).querySelector('div:last-child');
            const svg = document.getElementById(id).querySelector('svg');
            const isHidden = dd.classList.contains('hidden');
            document.querySelectorAll('[id^="dd"] div:last-child').forEach(d => d.classList.add('hidden'));
            document.querySelectorAll('[id^="dd"] svg').forEach(s => s.classList.remove('rotate-180'));
            if(isHidden) { dd.classList.remove('hidden'); svg.classList.add('rotate-180'); }
        }

        function pickKat(el) {
            currentKat = el.dataset.val;
            document.getElementById('ddKatLabel').textContent = el.dataset.label;
            document.querySelectorAll('#ddKategori div:last-child div').forEach(d => d.classList.remove('active', 'bg-pos-teal-light', 'text-pos-teal-dark', 'font-bold'));
            el.classList.add('active', 'bg-pos-teal-light', 'text-pos-teal-dark', 'font-bold');
            applyFilter();
        }

        function pickSort(el) {
            currentSort = el.dataset.val;
            document.getElementById('ddSortLabel').textContent = el.dataset.label;
            document.querySelectorAll('#ddSort div:last-child div').forEach(d => d.classList.remove('active', 'bg-pos-teal-light', 'text-pos-teal-dark', 'font-bold'));
            el.classList.add('active', 'bg-pos-teal-light', 'text-pos-teal-dark', 'font-bold');
            applyFilter();
        }

        function applyFilter() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            filtered = data.filter(d => {
                const matchKat = !currentKat || d.kategori === currentKat;
                const matchSearch = !search || d.nama.toLowerCase().includes(search) || d.nik.includes(search) || d.alamat.toLowerCase().includes(search) || d.kecamatan.toLowerCase().includes(search);
                return matchKat && matchSearch;
            });

            if (currentSort === 'nama')           filtered.sort((a,b) => a.nama.localeCompare(b.nama));
            else if (currentSort === 'nik')       filtered.sort((a,b) => a.nik.localeCompare(b.nik));
            else if (currentSort === 'kecamatan') filtered.sort((a,b) => a.kecamatan.localeCompare(b.kecamatan));
            else                                  filtered.sort((a,b) => b.id - a.id);
            
            render();
        }

        function openForm(kat) {
            if (kat === 'ibu') window.location.href = '/form_ibu_hamil';
            else if (kat === 'balita') window.location.href = '/form_balita';
        }

        function closeModal() {
            document.getElementById('katOverlay').classList.add('hidden');
            document.getElementById('katOverlay').classList.remove('flex');
        }

        function goToForm(id) {
            const p = data.find(x => x.id === id);
            if(!p) return;
            localStorage.setItem('currentPatient', JSON.stringify(p));
            localStorage.removeItem('langkah1Data');
            localStorage.removeItem('langkah2Data');
            localStorage.removeItem('langkah3Data');
            window.location.href = '/langkah-1';
        }

        let activePatientDetail = null;
        let activePemeriksaanIndex = 0;

        function renderPatientDetails() {
            const detail = activePatientDetail;
            const hIdx = activePemeriksaanIndex;
            const body = document.getElementById('dpBody');
            
            if (!detail) return;
            
            // 1. Logo POSYANDU di bagian atas
            let logoHtml = `
                <div class="flex flex-col items-center justify-center pt-2 pb-4 mb-1">
                    <img src="/image/logo.png" class="w-16 h-16 object-contain" alt="Logo POSYANDU" />
                    <h2 class="text-pos-teal text-xl font-extrabold tracking-wider mt-2.5">POSYANDU</h2>
                    <p class="text-[10px] text-pos-gray-500 font-extrabold tracking-widest uppercase italic mt-0.5">Dekat Balita, Dekat Ibu, Dekat Kita</p>
                </div>
            `;
            
            // 2. Informasi Dasar
            let infoDasarHtml = `
                <div class="bg-white rounded-pos-radius p-4 border border-pos-border shadow-sm mb-3">
                    <p class="text-[11px] font-extrabold text-pos-navy mb-3.5 uppercase tracking-wider text-left">Informasi Dasar</p>
                    
                    <div class="mb-3.5 text-left">
                        <label class="flex items-center gap-2 text-[10px] font-extrabold text-pos-navy mb-1.5 uppercase tracking-wider">
                            <i class="ti ti-woman text-[13px] text-pos-teal"></i>
                            <span>${detail.kategori === 'ibu' ? 'Nama Ibu' : 'Nama Balita'}</span>
                        </label>
                        <div class="w-full px-3 py-2.5 border border-pos-border rounded-lg bg-pos-bg text-[13px] font-bold text-pos-navy shadow-inner">
                            ${detail.nama}
                        </div>
                    </div>

                    <div class="text-left">
                        <label class="flex items-center gap-2 text-[10px] font-extrabold text-pos-navy mb-1.5 uppercase tracking-wider">
                            <i class="ti ti-world text-[13px] text-pos-teal"></i>
                            <span>Anak ke</span>
                        </label>
                        <div class="w-full px-3 py-2.5 border border-pos-border rounded-lg bg-pos-bg text-[13px] font-bold text-pos-navy shadow-inner">
                            ${detail.anakKe || '1'}
                        </div>
                    </div>
                </div>
            `;
            
            // 3. Render 4 Langkah Accordion
            let stepsHtml = '';
            const hasCheckups = detail.pemeriksaans && detail.pemeriksaans.length > 0;
            const h = hasCheckups ? detail.pemeriksaans[hIdx] : null;
            
            let step1Content = '';
            let step2Content = '';
            let step3Content = '';
            let step4Content = '';
            
            if (hasCheckups && h) {
                // Langkah 1: Pengukuran Utama
                step1Content = `
                    <div class="grid grid-cols-2 gap-3 pt-2 pb-1 text-left">
                        <div class="bg-pos-bg border border-pos-border rounded-lg p-2.5">
                            <span class="block text-[9px] font-extrabold text-pos-muted uppercase tracking-wider mb-1">${detail.kategori === 'ibu' ? 'Usia Kehamilan' : 'Usia Balita'}</span>
                            <span class="text-xs font-extrabold text-pos-navy">${detail.kategori === 'ibu' ? (h.usia_hamil || '-') + ' minggu' : (h.usia_balita || '-') + ' bulan'}</span>
                        </div>
                        <div class="bg-pos-bg border border-pos-border rounded-lg p-2.5">
                            <span class="block text-[9px] font-extrabold text-pos-muted uppercase tracking-wider mb-1">Berat Badan</span>
                            <span class="text-xs font-extrabold text-pos-navy">${h.berat_badan || '-'} kg</span>
                        </div>
                        <div class="bg-pos-bg border border-pos-border rounded-lg p-2.5 col-span-2">
                            <span class="block text-[9px] font-extrabold text-pos-muted uppercase tracking-wider mb-1">Tinggi Badan</span>
                            <span class="text-xs font-extrabold text-pos-navy">${h.tinggi_badan || '-'} cm</span>
                        </div>
                    </div>
                `;
                
                // Langkah 2: Pengukuran Tambahan
                if (detail.kategori === 'ibu') {
                    step2Content = `
                        <div class="grid grid-cols-2 gap-3 pt-2 pb-1 text-left">
                            <div class="bg-pos-bg border border-pos-border rounded-lg p-2.5">
                                <span class="block text-[9px] font-extrabold text-pos-muted uppercase tracking-wider mb-1">LILA</span>
                                <span class="text-xs font-extrabold text-pos-navy">${h.lila || '-'} cm</span>
                            </div>
                            <div class="bg-pos-bg border border-pos-border rounded-lg p-2.5">
                                <span class="block text-[9px] font-extrabold text-pos-muted uppercase tracking-wider mb-1">Kadar Hb</span>
                                <span class="text-xs font-extrabold text-pos-navy">${h.hb || '-'} g/dL</span>
                            </div>
                            <div class="bg-pos-bg border border-pos-border rounded-lg p-2.5 col-span-2">
                                <span class="block text-[9px] font-extrabold text-pos-muted uppercase tracking-wider mb-1">Tekanan Darah</span>
                                <span class="text-xs font-extrabold text-pos-navy">${h.tekanan_darah || '-'} mmHg</span>
                            </div>
                        </div>
                    `;
                } else {
                    step2Content = `
                        <div class="grid grid-cols-2 gap-3 pt-2 pb-1 text-left">
                            <div class="bg-pos-bg border border-pos-border rounded-lg p-2.5 col-span-2">
                                <span class="block text-[9px] font-extrabold text-pos-muted uppercase tracking-wider mb-1">Lingkar Kepala</span>
                                <span class="text-xs font-extrabold text-pos-navy">${h.lingkar_kepala || '-'} cm</span>
                            </div>
                            <div class="bg-pos-bg border border-pos-border rounded-lg p-2.5 col-span-2">
                                <span class="block text-[9px] font-extrabold text-pos-muted uppercase tracking-wider mb-1">Status Imunisasi</span>
                                <span class="text-xs font-extrabold text-pos-navy uppercase">${h.imunisasi ? h.imunisasi.replace('_', ' ') : '-'}</span>
                            </div>
                        </div>
                    `;
                }
                
                // Langkah 3: Kuesioner Skrining
                const qTexts = {
                    q1: 'Mengalami perdarahan dari jalan lahir?',
                    q2: 'Gerakan janin berkurang / tidak terasa?',
                    q3: 'Sakit kepala hebat + pandangan kabur?',
                    q4: 'Bengkak mendadak pada wajah/tangan/kaki?',
                    q5: 'Mengalami kejang atau pingsan?',
                    q6: 'Mengalami nyeri perut hebat?',
                    q7: 'Mengalami demam tinggi?',
                    q8: 'Tidak bisa makan/minum sama sekali?',
                    q9: 'Berat badan tidak naik atau turun?',
                    q10: 'Terlihat pucat dan sangat lemas?',
                    s1: 'Tinggi badan lebih pendek dari seusianya?',
                    s2: 'Berat badan tidak naik 2-3 bulan terakhir?',
                    s3: 'Sering sakit berulang (batuk / diare)?',
                    s4: 'Tidak mendapat ASI eksklusif?',
                    s5: 'Jarang makan makanan bergizi (protein)?',
                    s6: 'Sulit makan / tidak nafsu makan?',
                    p1: 'Mengalami demam tinggi terus-menerus?',
                    p2: 'Mengalami diare lebih dari 3 hari?',
                    p3: 'Mengalami sesak napas / napas cepat?',
                    p4: 'Tidak mau makan / minum sama sekali?',
                    p5: 'Lemas / tidak aktif?',
                    p6: 'Sulit dibangunkan atau tidak responsif?'
                };
                
                let qHtml = '<div class="flex flex-col gap-2 pt-2 pb-1 text-left">';
                if (h.jawaban_skrining && Object.keys(h.jawaban_skrining).length > 0) {
                    Object.entries(h.jawaban_skrining).forEach(([key, val]) => {
                        const qText = qTexts[key] || key;
                        const isYa = val === 'ya';
                        qHtml += `
                            <div class="flex items-start justify-between gap-3 text-[11px] border-b border-pos-bg pb-2 last:border-b-0">
                                <span class="text-pos-navy font-semibold leading-relaxed">${qText}</span>
                                <span class="px-1.5 py-0.5 rounded text-[8px] font-extrabold uppercase shrink-0 ${isYa ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700'}">${val.toUpperCase()}</span>
                            </div>
                        `;
                    });
                } else {
                    qHtml += '<p class="text-[11px] text-pos-muted italic">Tidak ada data kuesioner</p>';
                }
                qHtml += '</div>';
                step3Content = qHtml;
                
                // Langkah 4: Hasil & Tindak Lanjut
                step4Content = `
                    <div class="flex flex-col gap-2.5 pt-2 pb-1 text-left">
                        <div class="flex justify-between items-center bg-pos-bg border border-pos-border rounded-lg p-2.5">
                            <span class="text-[10px] font-extrabold text-pos-muted uppercase tracking-wider">Level Risiko</span>
                            <span class="px-2 py-0.5 rounded text-[8.5px] font-extrabold uppercase ${h.level_risiko === 'rendah' ? 'bg-green-100 text-green-700' : (h.level_risiko === 'darurat' ? 'bg-red-600 text-white animate-pulse' : 'bg-orange-100 text-orange-700')}">
                                ${h.level_risiko || '-'}
                            </span>
                        </div>
                        <div class="flex justify-between items-center bg-pos-bg border border-pos-border rounded-lg p-2.5">
                            <span class="text-[10px] font-extrabold text-pos-muted uppercase tracking-wider">Skor YA</span>
                            <span class="text-xs font-extrabold text-pos-navy">${h.skor_ya || 0} Jawaban YA</span>
                        </div>
                        <div class="bg-pos-bg border border-pos-border rounded-lg p-2.5">
                            <span class="block text-[9px] font-extrabold text-pos-muted uppercase tracking-wider mb-2">Tindak Lanjut</span>
                            <div class="flex flex-col gap-1.5">
                                ${h.tindak_lanjut && h.tindak_lanjut.length > 0 
                                    ? h.tindak_lanjut.map(tl => `
                                        <div class="flex items-start gap-1.5 text-[11px] text-pos-navy">
                                            <i class="ti ti-circle-check text-pos-teal text-sm shrink-0 mt-0.5"></i>
                                            <span>${tl}</span>
                                        </div>
                                    `).join('')
                                    : '<p class="text-[11px] text-pos-muted italic">Tidak ada tindak lanjut</p>'
                                }
                            </div>
                        </div>
                        ${h.catatan ? `
                            <div class="bg-pos-bg border border-pos-border rounded-lg p-2.5">
                                <span class="block text-[9px] font-extrabold text-pos-muted uppercase tracking-wider mb-1">Catatan Petugas</span>
                                <p class="text-[11px] text-pos-navy leading-relaxed">${h.catatan}</p>
                            </div>
                        ` : ''}
                    </div>
                `;
            } else {
                const noData = '<p class="text-xs text-pos-muted italic p-3 text-center">Belum ada rekam medis</p>';
                step1Content = noData;
                step2Content = noData;
                step3Content = noData;
                step4Content = noData;
            }
            
            const steps = [
                { num: 1, title: 'Langkah 1 (Pengukuran Utama)', content: step1Content },
                { num: 2, title: 'Langkah 2 (Pengukuran Tambahan)', content: step2Content },
                { num: 3, title: 'Langkah 3 (Kuesioner Skrining)', content: step3Content },
                { num: 4, title: 'Langkah 4 (Hasil & Tindak Lanjut)', content: step4Content }
            ];
            
            steps.forEach(step => {
                stepsHtml += `
                    <div class="bg-white border border-pos-border rounded-pos-radius overflow-hidden mb-2.5 shadow-sm">
                        <button class="w-full flex items-center justify-between p-3.5 bg-none border-none cursor-pointer text-left transition-colors hover:bg-pos-bg/50" onclick="toggleDetailStep(${step.num})">
                            <div class="flex items-center gap-2.5">
                                <i class="ti ti-file-text text-[18px] text-pos-teal"></i>
                                <span class="text-[13px] font-bold text-pos-navy">${step.title}</span>
                            </div>
                            <i class="ti ti-chevron-down text-[15px] text-pos-muted transition-transform duration-200" id="step-arrow-${step.num}"></i>
                        </button>
                        <div class="px-3.5 pb-3.5 border-t border-pos-bg hidden" id="step-content-${step.num}">
                            ${step.content}
                        </div>
                    </div>
                `;
            });
            
            // 4. Riwayat Pemeriksaan
            let riwayatRowsHtml = '';
            if (hasCheckups) {
                detail.pemeriksaans.forEach((pemeriksaan, pIdx) => {
                    const isSelected = pIdx === hIdx;
                    const dateFormatted = new Date(pemeriksaan.tgl_periksa).toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric'
                    });
                    
                    riwayatRowsHtml += `
                        <div class="flex gap-3 items-end mb-3.5 last:mb-0 text-left">
                            <div class="flex-1">
                                <label class="flex items-center gap-1.5 text-[9px] font-extrabold text-pos-muted mb-1 uppercase tracking-wider">
                                    <i class="ti ti-calendar text-[12px] text-pos-teal"></i>
                                    <span>Tanggal Riwayat Pemeriksaan</span>
                                </label>
                                <div class="w-full px-3 py-2.5 border border-pos-border rounded-lg bg-pos-bg text-[12px] font-extrabold text-pos-navy shadow-inner flex items-center gap-2">
                                    <span>${dateFormatted}</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <label class="flex items-center gap-1.5 text-[9px] font-extrabold text-pos-muted mb-1 uppercase tracking-wider">
                                    <i class="ti ti-pointer text-[12px] text-pos-teal"></i>
                                    <span>Aksi</span>
                                </label>
                                <button onclick="selectPemeriksaan(${pIdx})" class="w-full px-3 py-2.5 border ${isSelected ? 'border-pos-teal bg-pos-teal text-white' : 'border-pos-border bg-white text-pos-navy'} hover:border-pos-teal hover:bg-pos-teal-light hover:text-pos-teal-dark rounded-lg text-[11px] font-extrabold transition-all duration-200 flex items-center justify-center gap-1 shadow-sm">
                                    <span>Lihat Detail Riwayat</span>
                                </button>
                            </div>
                        </div>
                    `;
                });
            } else {
                riwayatRowsHtml = '<p class="text-xs text-pos-muted italic py-2 text-center">Belum ada riwayat pemeriksaan.</p>';
            }
            
            let riwayatCardHtml = `
                <div class="bg-white rounded-pos-radius p-4 border border-pos-border shadow-sm mt-1.5">
                    <p class="text-[11px] font-extrabold text-pos-navy mb-3.5 uppercase tracking-wider text-left">Riwayat Pemeriksaan</p>
                    <div class="flex flex-col">
                        ${riwayatRowsHtml}
                    </div>
                </div>
            `;
            
            body.innerHTML = logoHtml + infoDasarHtml + stepsHtml + riwayatCardHtml;
        }

        window.toggleDetailStep = function(stepNum) {
            const content = document.getElementById(`step-content-${stepNum}`);
            const arrow = document.getElementById(`step-arrow-${stepNum}`);
            if (!content || !arrow) return;
            const isHidden = content.classList.contains('hidden');
            
            // Close all step contents first to make it a true accordion
            for (let i = 1; i <= 4; i++) {
                const c = document.getElementById(`step-content-${i}`);
                const a = document.getElementById(`step-arrow-${i}`);
                if (c && a) {
                    c.classList.add('hidden');
                    a.classList.remove('rotate-180');
                }
            }
            
            // If it was hidden, open it
            if (isHidden) {
                content.classList.remove('hidden');
                arrow.classList.add('rotate-180');
            }
        };

        window.selectPemeriksaan = function(idx) {
            activePemeriksaanIndex = idx;
            renderPatientDetails();
            window.toggleDetailStep(1);
        };

        async function lihat(id) {
            const p = data.find(x => x.id === id);
            if(!p) return;

            const overlay = document.getElementById('detailOverlay');
            const panel = document.getElementById('detailPanel');
            const body = document.getElementById('dpBody');

            body.innerHTML = '<div class="p-8 text-center text-pos-muted"><i class="ti ti-loader animate-spin text-3xl"></i><p class="mt-2 text-sm font-medium">Mengambil riwayat medis...</p></div>';
            overlay.classList.remove('hidden');
            setTimeout(() => panel.classList.remove('translate-x-full'), 10);

            try {
                const response = await fetch(`/patients/${id}`, {
                    headers: { 'Accept': 'application/json' }
                });
                const detail = await response.json();

                activePatientDetail = detail;
                activePemeriksaanIndex = 0;
                renderPatientDetails();
            } catch (error) {
                console.error(error);
                body.innerHTML = '<div class="p-8 text-center text-red-500 font-bold"><i class="ti ti-alert-triangle text-3xl mb-2"></i><p>Gagal memuat data</p></div>';
            }
        }

        function closeDetailPanel() {
            const panel = document.getElementById('detailPanel');
            panel.classList.add('translate-x-full');
            setTimeout(() => document.getElementById('detailOverlay').classList.add('hidden'), 300);
        }

        function handleOverlayClick(e) {
            if (e.target.id === 'detailOverlay') closeDetailPanel();
        }

        window.onclick = function(event) {
            if (!event.target.closest('.relative')) {
                document.querySelectorAll('[id^="dd"] div:last-child').forEach(d => d.classList.add('hidden'));
                document.querySelectorAll('[id^="dd"] svg').forEach(s => s.classList.remove('rotate-180'));
            }
        }

        document.addEventListener('DOMContentLoaded', render);
    </script>
</body>
</html>
