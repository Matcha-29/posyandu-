@extends('layouts.app')

@section('title', 'Dashboard Admin – Posyandu')

@section('content')
    <!-- Topbar -->
    <div class="topbar flex items-center justify-between mb-8">
        <div class="topbar-title">
            <h1 class="text-[36px] font-extrabold text-pos-gray-900 leading-none">Dashboard</h1>
            <p class="mt-2 text-[14px] text-pos-gray-500 font-medium">Pantau perkembangan data dan aktivitas Posyandu hari ini.</p>
        </div>
        <div class="admin-badge flex items-center gap-3 bg-white border border-pos-gray-100 rounded-full px-4 py-2 shadow-pos-shadow">
            <img class="w-10 h-10 rounded-full object-cover border border-pos-green-light" src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=80&h=80&q=80' }}" alt="Admin" />
            <div class="text-left">
                <p class="text-xs font-bold leading-none text-pos-gray-900">{{ Auth::user()->name }}</p>
                <p class="text-[9px] font-bold text-pos-gray-500 uppercase tracking-widest mt-1">{{ Auth::user()->role }}</p>
            </div>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="stats-row grid grid-cols-3 gap-5 mb-7">
        <div class="stat-card [animation-delay:0.05s]">
            <div class="stat-icon w-[52px] h-[52px] rounded-xl flex items-center justify-center shrink-0 bg-[#fff4e5]">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-label text-[12px] text-pos-gray-500 font-semibold uppercase tracking-wider">Total Pasien Hari ini</div>
                <div class="stat-value text-[28px] font-extrabold text-pos-gray-900 leading-tight mt-[2px]">{{ number_format($totalPasien) }}</div>
            </div>
        </div>

        <div class="stat-card [animation-delay:0.10s]">
            <div class="stat-icon w-[52px] h-[52px] rounded-xl flex items-center justify-center shrink-0 bg-[#e4f7f5]">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#1e9e8c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="9" cy="6" r="3"/>
                    <path d="M4 20v-2a5 5 0 015-5h0a5 5 0 015 5v2"/>
                    <circle cx="17" cy="4" r="2" opacity=".6"/>
                    <path d="M14 8h3" opacity=".6"/>
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-label text-[12px] text-pos-gray-500 font-semibold uppercase tracking-wider">Balita</div>
                <div class="stat-value text-[28px] font-extrabold text-pos-gray-900 leading-tight mt-[2px]">{{ number_format($totalBalita) }}</div>
            </div>
        </div>

        <div class="stat-card [animation-delay:0.15s]">
            <div class="stat-icon w-[52px] h-[52px] rounded-xl flex items-center justify-center shrink-0 bg-pos-green-pale">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#2d8653" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="7" r="4"/>
                    <path d="M6 21v-1a6 6 0 0112 0v1"/>
                    <path d="M9 14c1 4 5 4 6 0" stroke-width="1.5" opacity=".7"/>
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-label text-[12px] text-pos-gray-500 font-semibold uppercase tracking-wider">Ibu Hamil</div>
                <div class="stat-value text-[28px] font-extrabold text-pos-gray-900 leading-tight mt-[2px]">{{ number_format($totalIbu) }}</div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="charts-row grid grid-cols-[1fr_320px] gap-5 mb-7">
        <div class="chart-card bg-white rounded-pos-radius p-6 shadow-pos-shadow border border-pos-gray-100 animate-fade-up [animation-delay:0.2s]">
            <div class="chart-card-title text-[15px] font-bold text-pos-gray-900 mb-5">Statistik Pasien Bulanan</div>
            <div class="line-chart-wrap relative h-[220px]">
                <canvas id="lineChart" class="!w-full !h-full"></canvas>
            </div>
        </div>

        <div class="donut-card bg-white rounded-pos-radius p-6 shadow-pos-shadow border border-pos-gray-100 flex flex-col items-center animate-fade-up [animation-delay:0.25s]">
            <div class="donut-card-title text-[15px] font-bold text-pos-gray-900 mb-[18px] self-start">Top Kategori</div>
            <div class="donut-wrap relative w-[160px] h-[160px] mx-auto mb-[18px]">
                <canvas id="donutChart" width="160" height="160" class="!w-[160px] !h-[160px]"></canvas>
            </div>
            <div class="donut-legend flex gap-5 justify-center flex-wrap">
                <div class="legend-item flex items-center gap-[6px] text-xs font-semibold text-pos-gray-700">
                    <div class="legend-dot w-[10px] h-[10px] rounded-full shrink-0 bg-[#1a5c38]"></div>
                    Balita {{ $totalPasien > 0 ? round(($totalBalita / $totalPasien) * 100) : 0 }}%
                </div>
                <div class="legend-item flex items-center gap-[6px] text-xs font-semibold text-pos-gray-700">
                    <div class="legend-dot w-[10px] h-[10px] rounded-full shrink-0 bg-[#d1d5db]"></div>
                    Ibu Hamil {{ $totalPasien > 0 ? round(($totalIbu / $totalPasien) * 100) : 0 }}%
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="pos-table-card [animation-delay:0.3s]">
        <div class="table-header flex items-center justify-between px-6 py-5 border-b border-pos-gray-100">
            <span class="table-header-title text-base font-bold text-pos-gray-900">Kunjungan Pasien Terbaru</span>
            <a class="view-all text-[13px] font-semibold text-pos-teal no-underline hover:underline" href="/list_data_pasien">View all</a>
        </div>
        <table class="pos-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Kategori</th>
                    <th>Tanggal Periksa</th>
                </tr>
            </thead>
            <tbody>
                @forelse($latestPemeriksaans as $index => $pem)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="!font-bold !text-pos-gray-900">{{ $pem->patient->nama }}</td>
                    <td class="!font-bold !text-pos-gray-900">{{ $pem->patient->nik }}</td>
                    <td>
                        <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase {{ $pem->patient->kategori === 'ibu' ? 'bg-[#e4f7f5] text-pos-teal' : 'bg-pos-green-pale text-pos-green-dark' }}">
                            {{ $pem->patient->kategori === 'ibu' ? 'Ibu Hamil' : 'Balita' }}
                        </span>
                    </td>
                    <td>{{ $pem->tgl_periksa->format('M d, Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-6 text-pos-gray-400 font-semibold">Belum ada data pemeriksaan terbaru.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <!-- Chart.js CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
    <script>
    // ── LINE CHART ──────────────────────────────────
    const lineCtx = document.getElementById('lineChart').getContext('2d');

    const gradient = lineCtx.createLinearGradient(0, 0, 0, 220);
    gradient.addColorStop(0,   'rgba(61,171,106,0.28)');
    gradient.addColorStop(1,   'rgba(61,171,106,0.00)');

    new Chart(lineCtx, {
      type: 'line',
      data: {
        labels: @json($chartData['labels']),
        datasets: [{
          data: @json($chartData['values']),
          borderColor: '#3dab6a',
          borderWidth: 2.5,
          backgroundColor: gradient,
          tension: 0.45,
          fill: true,
          pointRadius: 0,
          pointHoverRadius: 6,
          pointHoverBackgroundColor: '#3dab6a',
          pointHoverBorderColor: '#fff',
          pointHoverBorderWidth: 2,
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false }, tooltip: {
          backgroundColor: '#1a2e26',
          titleColor: '#fff',
          bodyColor: '#a8c4b5',
          cornerRadius: 8,
          padding: 10,
        }},
        scales: {
          x: {
            grid: { display: false },
            border: { display: false },
            ticks: { color: '#7a9186', font: { size: 11, weight: '600' } }
          },
          y: {
            min: 0,
            grid: { color: '#eef2f0', drawBorder: false },
            border: { display: false },
            ticks: { 
              color: '#7a9186', 
              font: { size: 11 },
              precision: 0 // Hanya tampilkan angka bulat untuk kunjungan
            }
          }
        }
      }
    });

    // ── DONUT CHART ──────────────────────────────────
    const dCtx = document.getElementById('donutChart').getContext('2d');
    new Chart(dCtx, {
      type: 'doughnut',
      data: {
        labels: ['Balita', 'Ibu Hamil'],
        datasets: [{
          data: [{{ $totalPasien > 0 ? round(($totalBalita / $totalPasien) * 100) : 0 }}, {{ $totalPasien > 0 ? round(($totalIbu / $totalPasien) * 100) : 0 }}],
          backgroundColor: ['#1a5c38', '#d1d5db'],
          borderWidth: 0,
          hoverOffset: 6,
        }]
      },
      options: {
        responsive: false,
        cutout: '70%',
        plugins: { legend: { display: false }, tooltip: {
          backgroundColor: '#1a2e26',
          titleColor: '#fff',
          bodyColor: '#a8c4b5',
          cornerRadius: 8,
          padding: 10,
        }}
      }
    });
    </script>
@endsection
