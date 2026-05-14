<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Dashboard Admin – Posyandu</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        'pos-green-dark': '#1a5c38',
                        'pos-green-mid': '#2d8653',
                        'pos-green-light': '#3dab6a',
                        'pos-green-pale': '#e8f5ee',
                        'pos-teal': '#1e9e8c',
                        'pos-gray-50': '#f7f9f8',
                        'pos-gray-100': '#eef2f0',
                        'pos-gray-500': '#7a9186',
                        'pos-gray-900': '#1a2e26',
                    },
                    borderRadius: {
                        'pos-radius': '14px',
                    },
                    boxShadow: {
                        'pos-shadow': '0 2px 16px rgba(26,92,56,.10)',
                        'pos-shadow-lg': '0 6px 32px rgba(26,92,56,.14)',
                    },
                    keyframes: {
                        fadeUp: {
                            'from': { opacity: '0', transform: 'translateY(18px)' },
                            'to': { opacity: '1', transform: 'translateY(0)' },
                        },
                        sideIn: {
                            'from': { transform: 'translateX(-30px)', opacity: '0' },
                            'to': { transform: 'none', opacity: '1' },
                        }
                    },
                    animation: {
                        'fade-up': 'fadeUp 0.5s ease both',
                        'side-in': 'sideIn 0.4s ease both',
                    }
                }
            }
        }
    </script>
    <style type="text/tailwindcss">
        @layer components {
            .nav-item {
                @apply flex items-center gap-[14px] px-[18px] py-[13px] rounded-[10px] text-white/65 text-[15px] font-semibold cursor-pointer transition-all no-underline hover:bg-white/10 hover:text-white;
            }
            .nav-item.active {
                @apply bg-pos-green-light text-white shadow-[0_4px_14px_rgba(61,171,106,0.35)];
            }
            .stat-card {
                @apply bg-white rounded-pos-radius px-6 py-[22px] shadow-pos-shadow flex items-center gap-[18px] border border-pos-gray-100 transition-all hover:-translate-y-[3px] hover:shadow-pos-shadow-lg animate-fade-up;
            }
            .badge {
                @apply inline-block px-3 py-1 rounded-[20px] text-[12px] font-bold;
            }
        }
    </style>
</head>
<body class="bg-pos-gray-50 text-pos-gray-900 flex min-h-screen overflow-x-hidden font-sans">

<!-- ══ SIDEBAR ══════════════════════════════════════════ -->
<aside class="sidebar fixed left-0 top-0 bottom-0 w-[260px] bg-pos-green-dark flex flex-col items-center py-8 z-[100] shadow-[4px_0_24px_rgba(26,92,56,0.18)] animate-side-in">
    <div class="sidebar-logo flex flex-col items-center gap-[10px] mb-10 px-5">
        <div class="logo-wrap w-[100px] h-[100px] flex items-center justify-center">
            <img src="{{ asset('image/logo.png') }}" alt="Logo POSYANDU" class="w-full h-full object-contain" />
        </div>
    </div>

    <nav class="nav w-full px-4 flex flex-col gap-1">
        <a class="nav-item active" href="/dashboard">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                <path d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
                <path d="M9 21V12h6v9"/>
            </svg>
            Dashboard
        </a>
        <a class="nav-item" href="/data_pasien">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
            </svg>
            Data Pasien
        </a>
        <a class="nav-item" href="/data_akun">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                <circle cx="12" cy="8" r="4"/>
                <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
            </svg>
            Data Akun
        </a>
    </nav>

    <div class="nav-logout mt-auto w-full px-4 pb-2">
        <a class="nav-item !text-white/50 hover:!text-red-400 hover:!bg-red-400/10" href="/login">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
            Logout
        </a>
    </div>
</aside>

<!-- ══ MAIN ═════════════════════════════════════════════ -->
<main class="main ml-[260px] flex-1 px-10 py-9 min-h-screen">

    <!-- Topbar -->
    <div class="topbar flex items-start justify-between mb-8">
        <div class="topbar-title">
            <h1 class="text-[36px] font-extrabold text-pos-gray-900 leading-none">Dashboard</h1>
            <p class="mt-2 text-[14px] text-pos-gray-500 font-medium">Welcome back, Admin! Ready to manage today's content?</p>
        </div>
        <div class="admin-badge flex items-center gap-3 bg-white border border-pos-gray-100 rounded-full px-4 py-2 shadow-pos-shadow">
            <div class="admin-avatar-placeholder w-10 h-10 rounded-full bg-gradient-to-br from-pos-green-light to-pos-teal flex items-center justify-center text-white font-bold text-base">A</div>
            <span class="admin-name text-sm font-bold text-pos-gray-900">Admin</span>
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
                <div class="stat-value text-[28px] font-extrabold text-pos-gray-900 leading-tight mt-[2px]">1.459</div>
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
                <div class="stat-value text-[28px] font-extrabold text-pos-gray-900 leading-tight mt-[2px]">5.985</div>
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
                <div class="stat-value text-[28px] font-extrabold text-pos-gray-900 leading-tight mt-[2px]">253</div>
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
                    Balita 39%
                </div>
                <div class="legend-item flex items-center gap-[6px] text-xs font-semibold text-pos-gray-700">
                    <div class="legend-dot w-[10px] h-[10px] rounded-full shrink-0 bg-[#d1d5db]"></div>
                    Ibu Hamil 61%
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="table-card bg-white rounded-pos-radius shadow-pos-shadow border border-pos-gray-100 overflow-hidden animate-fade-up [animation-delay:0.3s]">
        <div class="table-header flex items-center justify-between px-6 py-5 border-b border-pos-gray-100">
            <span class="table-header-title text-base font-bold text-pos-gray-900">Latest Pasien</span>
            <a class="view-all text-[13px] font-semibold text-pos-teal no-underline hover:underline" href="#">View all</a>
        </div>
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-pos-green-pale">
                    <th class="px-5 py-[13px] text-left text-xs font-bold text-pos-green-dark tracking-wider">No</th>
                    <th class="px-5 py-[13px] text-left text-xs font-bold text-pos-green-dark tracking-wider">Nama</th>
                    <th class="px-5 py-[13px] text-left text-xs font-bold text-pos-green-dark tracking-wider">NIK</th>
                    <th class="px-5 py-[13px] text-left text-xs font-bold text-pos-green-dark tracking-wider">Kategori</th>
                    <th class="px-5 py-[13px] text-left text-xs font-bold text-pos-green-dark tracking-wider">Upload Date</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-pos-gray-100 last:border-none transition-colors hover:bg-pos-gray-50">
                    <td class="px-5 py-[14px] text-sm text-pos-gray-700 font-medium">1</td>
                    <td class="px-5 py-[14px] text-sm text-pos-gray-700 font-medium">Haya Haya</td>
                    <td class="px-5 py-[14px] text-sm text-pos-gray-700 font-medium">34506054933</td>
                    <td class="px-5 py-[14px] text-sm text-pos-gray-700 font-medium"><span class="badge bg-[#e4f7f5] text-pos-teal">Ibu Hamil</span></td>
                    <td class="px-5 py-[14px] text-sm text-pos-gray-700 font-medium">April 15, 2025</td>
                </tr>
                <tr class="border-b border-pos-gray-100 last:border-none transition-colors hover:bg-pos-gray-50">
                    <td class="px-5 py-[14px] text-sm text-pos-gray-700 font-medium">2</td>
                    <td class="px-5 py-[14px] text-sm text-pos-gray-700 font-medium">Haya Haya</td>
                    <td class="px-5 py-[14px] text-sm text-pos-gray-700 font-medium">34506054933</td>
                    <td class="px-5 py-[14px] text-sm text-pos-gray-700 font-medium"><span class="badge bg-[#e4f7f5] text-pos-teal">Ibu Hamil</span></td>
                    <td class="px-5 py-[14px] text-sm text-pos-gray-700 font-medium">April 15, 2025</td>
                </tr>
                <tr class="border-b border-pos-gray-100 last:border-none transition-colors hover:bg-pos-gray-50">
                    <td class="px-5 py-[14px] text-sm text-pos-gray-700 font-medium">3</td>
                    <td class="px-5 py-[14px] text-sm text-pos-gray-700 font-medium">Haya Haya</td>
                    <td class="px-5 py-[14px] text-sm text-pos-gray-700 font-medium">34506054933</td>
                    <td class="px-5 py-[14px] text-sm text-pos-gray-700 font-medium"><span class="badge bg-pos-green-pale text-pos-green-dark">Balita</span></td>
                    <td class="px-5 py-[14px] text-sm text-pos-gray-700 font-medium">April 15, 2025</td>
                </tr>
                <tr class="border-b border-pos-gray-100 last:border-none transition-colors hover:bg-pos-gray-50">
                    <td class="px-5 py-[14px] text-sm text-pos-gray-700 font-medium">4</td>
                    <td class="px-5 py-[14px] text-sm text-pos-gray-700 font-medium">Siti Rahma</td>
                    <td class="px-5 py-[14px] text-sm text-pos-gray-700 font-medium">35120198456</td>
                    <td class="px-5 py-[14px] text-sm text-pos-gray-700 font-medium"><span class="badge bg-[#e4f7f5] text-pos-teal">Ibu Hamil</span></td>
                    <td class="px-5 py-[14px] text-sm text-pos-gray-700 font-medium">April 16, 2025</td>
                </tr>
                <tr class="border-b border-pos-gray-100 last:border-none transition-colors hover:bg-pos-gray-50">
                    <td class="px-5 py-[14px] text-sm text-pos-gray-700 font-medium">5</td>
                    <td class="px-5 py-[14px] text-sm text-pos-gray-700 font-medium">Dewi Kusuma</td>
                    <td class="px-5 py-[14px] text-sm text-pos-gray-700 font-medium">35780234512</td>
                    <td class="px-5 py-[14px] text-sm text-pos-gray-700 font-medium"><span class="badge bg-pos-green-pale text-pos-green-dark">Balita</span></td>
                    <td class="px-5 py-[14px] text-sm text-pos-gray-700 font-medium">April 16, 2025</td>
                </tr>
            </tbody>
        </table>
    </div>

</main>

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
    labels: ['JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'],
    datasets: [{
      data: [180, 210, 195, 240, 300, 390, 460, 380, 310, 350, 420, 400],
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
        min: 0, max: 500,
        grid: { color: '#eef2f0', drawBorder: false },
        border: { display: false },
        ticks: { color: '#7a9186', font: { size: 11 }, stepSize: 100 }
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
      data: [39, 61],
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
</body>
</html>