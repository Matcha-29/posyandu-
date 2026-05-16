<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laporan Skrining — POSYANDU</title>
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
                        'pos-bg': '#f5f7f6',
                        'pos-border': '#e0ebe9',
                        'pos-text': '#1a1a1a',
                        'pos-navy': '#1e2a6e',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-pos-bg text-pos-text min-h-screen flex flex-col font-sans">
    <header class="w-full h-[70px] bg-pos-teal flex items-center justify-between px-10 shadow-md shrink-0">
      <div class="flex items-center gap-3">
        <a href="/list_data_pasien" class="text-white/80 hover:text-white transition-colors">
          <i class="ti ti-arrow-left text-2xl"></i>
        </a>
        <span class="text-white font-bold text-xl tracking-tight">Laporan Skrining</span>
      </div>
      <div class="flex items-center gap-6">
        <div class="text-white text-right">
          <p class="text-sm font-bold leading-none">{{ Auth::user()->name }}</p>
          <p class="text-[0.7rem] opacity-80 uppercase tracking-widest mt-1">{{ Auth::user()->role }}</p>
        </div>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center text-white hover:bg-white/20 transition-all" title="Logout">
            <i class="ti ti-logout text-lg"></i>
          </button>
        </form>
      </div>
    </header>

    <main class="flex-1 px-10 py-9 max-w-[1300px] w-full mx-auto">
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-pos-border mb-8">
            <h2 class="text-lg font-extrabold text-pos-navy mb-6 flex items-center gap-2">
                <i class="ti ti-filter text-pos-teal"></i> Filter Laporan
            </h2>
            <form action="/laporan" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
                <div>
                    <label class="block text-xs font-bold text-pos-teal-dark mb-2 uppercase tracking-wider">Dari Tanggal</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full px-4 py-2.5 border border-pos-border rounded-lg text-sm focus:border-pos-teal outline-none transition-all" />
                </div>
                <div>
                    <label class="block text-xs font-bold text-pos-teal-dark mb-2 uppercase tracking-wider">Sampai Tanggal</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full px-4 py-2.5 border border-pos-border rounded-lg text-sm focus:border-pos-teal outline-none transition-all" />
                </div>
                <div>
                    <label class="block text-xs font-bold text-pos-teal-dark mb-2 uppercase tracking-wider">Kategori</label>
                    <select name="kategori" class="w-full px-4 py-2.5 border border-pos-border rounded-lg text-sm focus:border-pos-teal outline-none transition-all">
                        <option value="">Semua Kategori</option>
                        <option value="ibu" {{ request('kategori') == 'ibu' ? 'selected' : '' }}>Ibu Hamil</option>
                        <option value="balita" {{ request('kategori') == 'balita' ? 'selected' : '' }}>Balita</option>
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="flex-1 bg-pos-teal text-white font-bold py-2.5 rounded-lg text-sm hover:bg-pos-teal-dark transition-all shadow-sm">
                        Terapkan
                    </button>
                    <a href="/laporan/export?{{ http_build_query(request()->all()) }}" class="flex items-center justify-center bg-pos-navy text-white font-bold px-4 py-2.5 rounded-lg text-sm hover:bg-opacity-90 transition-all shadow-sm" title="Export CSV">
                        <i class="ti ti-download text-lg"></i>
                    </a>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-pos-border">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-pos-teal text-white">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Nama Pasien</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Petugas</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Risiko</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-pos-border">
                        @forelse($pemeriksaans as $p)
                        <tr class="hover:bg-pos-teal-light transition-colors">
                            <td class="px-6 py-4 text-sm font-medium">{{ \Carbon\Carbon::parse($p->tgl_periksa)->format('d/m/Y') }}</td>
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-pos-text">{{ $p->patient->nama }}</p>
                                <p class="text-[10px] text-pos-muted font-bold tracking-tight uppercase">{{ $p->patient->nik }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $p->patient->kategori == 'ibu' ? 'bg-orange-100 text-orange-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ $p->patient->kategori == 'ibu' ? 'Ibu Hamil' : 'Balita' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-pos-muted font-medium">{{ $p->user->name }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $riskColors = [
                                        'rendah' => 'bg-green-100 text-green-700',
                                        'sedang' => 'bg-yellow-100 text-yellow-700',
                                        'tinggi' => 'bg-red-100 text-red-700',
                                        'darurat' => 'bg-red-600 text-white animate-pulse'
                                    ];
                                @endphp
                                <span class="px-3 py-1 rounded-lg text-[10px] font-bold uppercase {{ $riskColors[$p->level_risiko] ?? 'bg-gray-100' }}">
                                    {{ $p->level_risiko }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <button onclick="showDetail({{ $p->id }})" class="text-pos-teal hover:text-pos-teal-dark transition-colors" title="Lihat Hasil">
                                    <i class="ti ti-file-text text-xl"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-pos-muted">
                                <i class="ti ti-search text-4xl opacity-20 block mb-2"></i>
                                Tidak ada data pemeriksaan ditemukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($pemeriksaans->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t border-pos-border">
                {{ $pemeriksaans->links() }}
            </div>
            @endif
        </div>
    </main>

    <!-- Modal Detail Laporan -->
    <div id="modalDetail" class="hidden fixed inset-0 bg-black/50 z-[100] items-center justify-center backdrop-blur-sm p-4">
        <div class="bg-white rounded-2xl w-full max-w-2xl max-h-[90vh] overflow-hidden flex flex-col shadow-2xl animate-[slideUp_0.3s_ease]">
            <div class="bg-pos-teal p-6 text-white flex justify-between items-center">
                <h3 class="font-extrabold text-lg">Detail Hasil Skrining</h3>
                <button onclick="closeModal()" class="text-2xl leading-none">&times;</button>
            </div>
            <div class="p-8 overflow-y-auto" id="modalContent">
                <!-- Content injected via JS -->
            </div>
            <div class="p-4 bg-gray-50 border-t flex justify-end">
                <button onclick="closeModal()" class="px-6 py-2 bg-pos-navy text-white font-bold rounded-lg hover:bg-opacity-90 transition-all">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        function showDetail(id) {
            const items = @json($pemeriksaans->items());
            const data = items.find(i => i.id === id);
            if (!data) return;

            const content = document.getElementById('modalContent');
            
            const answersHtml = Object.entries(data.jawaban_skrining || {}).map(([q, val]) => `
                <div class="flex justify-between py-2 border-b border-gray-50">
                    <span class="text-xs text-pos-muted font-bold uppercase">${q}</span>
                    <span class="text-xs font-extrabold ${val === 'ya' ? 'text-red-600' : 'text-green-600'} uppercase">${val}</span>
                </div>
            `).join('');

            const tlHtml = (data.tindak_lanjut || []).map(tl => `
                <div class="flex items-start gap-2 text-sm text-pos-text py-1">
                    <i class="ti ti-circle-check text-pos-teal mt-0.5"></i>
                    <span>${tl}</span>
                </div>
            `).join('');

            content.innerHTML = `
                <div class="grid grid-cols-2 gap-8 mb-8">
                    <div>
                        <h4 class="text-[10px] font-bold text-pos-teal uppercase tracking-widest mb-3">Informasi Pasien</h4>
                        <div class="space-y-2">
                            <p class="text-sm font-bold">${data.patient.nama}</p>
                            <p class="text-xs text-pos-muted">${data.patient.nik}</p>
                            <p class="text-xs text-pos-muted">${data.patient.alamat}</p>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-[10px] font-bold text-pos-teal uppercase tracking-widest mb-3">Hasil Skrining</h4>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-xs text-pos-muted">Level Risiko:</span>
                                <span class="text-xs font-bold uppercase text-red-600">${data.level_risiko}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-xs text-pos-muted">Tanggal:</span>
                                <span class="text-xs font-bold">${new Date(data.tgl_periksa).toLocaleDateString('id-ID')}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-xs text-pos-muted">Petugas:</span>
                                <span class="text-xs font-bold">${data.user.name}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-8">
                    <h4 class="text-[10px] font-bold text-pos-teal uppercase tracking-widest mb-4 border-b pb-2">Kuesioner</h4>
                    <div class="grid grid-cols-2 gap-x-8 gap-y-1">
                        ${answersHtml || '<p class="text-xs text-pos-muted italic">Tidak ada data kuesioner</p>'}
                    </div>
                </div>

                <div>
                    <h4 class="text-[10px] font-bold text-pos-teal uppercase tracking-widest mb-4 border-b pb-2">Tindak Lanjut</h4>
                    <div class="space-y-1">
                        ${tlHtml || '<p class="text-xs text-pos-muted italic">Tidak ada rekomendasi tindak lanjut</p>'}
                    </div>
                </div>
            `;

            document.getElementById('modalDetail').classList.remove('hidden');
            document.getElementById('modalDetail').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('modalDetail').classList.add('hidden');
            document.getElementById('modalDetail').classList.remove('flex');
        }
    </script>
</body>
</html>
