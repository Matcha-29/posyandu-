<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Data Akun – Posyandu</title>
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
                        'pos-gray-300': '#c4d0ca',
                        'pos-gray-500': '#7a9186',
                        'pos-gray-700': '#3c524a',
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
                            'from': { opacity: '0', transform: 'translateY(16px)' },
                            'to': { opacity: '1', transform: 'translateY(0)' },
                        }
                    },
                    animation: {
                        'fade-up': 'fadeUp 0.4s ease both',
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
            .table-cell-head {
                @apply px-5 py-[15px] text-left text-[13px] font-bold text-white tracking-[0.3px];
            }
            .table-cell-body {
                @apply px-5 py-[14px] text-sm text-pos-gray-700 font-medium align-middle;
            }
            .page-btn {
                @apply min-w-[36px] h-9 rounded-lg border-[1.5px] border-pos-gray-300 bg-white text-pos-gray-700 text-[13px] font-bold flex items-center justify-center cursor-pointer transition-all px-[10px] hover:border-pos-green-light hover:text-pos-green-dark;
            }
            .page-btn.active {
                @apply bg-pos-green-dark border-pos-green-dark text-white shadow-[0_3px_10px_rgba(26,92,56,0.25)];
            }
        }
    </style>
</head>
<body class="bg-pos-gray-50 text-pos-gray-900 flex min-h-screen font-sans">

<!-- ══ SIDEBAR ══════════════════════════════════════════ -->
<aside class="fixed left-0 top-0 bottom-0 w-[260px] bg-pos-green-dark flex flex-col items-center py-8 z-[100] shadow-[4px_0_24px_rgba(26,92,56,0.18)]">
    <div class="sidebar-logo flex flex-col items-center gap-[10px] mb-10 px-5">
        <div class="logo-wrap w-[100px] h-[100px] flex items-center justify-center">
            <img src="{{ asset('image/logo.png') }}" alt="Logo POSYANDU" class="w-full h-full object-contain" />
        </div>
    </div>

    <nav class="nav w-full px-4 flex flex-col gap-1">
        <a class="nav-item" href="/dashboard">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
                <path d="M9 21V12h6v9"/>
            </svg>
            Dashboard
        </a>
        <a class="nav-item" href="/data_pasien">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
            </svg>
            Data Pasien
        </a>
        <a class="nav-item active" href="/data_akun">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="8" r="4"/>
                <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
            </svg>
            Data Akun
        </a>
    </nav>

    <div class="nav-logout mt-auto w-full px-4 pb-2">
        <a class="nav-item !text-white/50 hover:!text-red-400 hover:!bg-red-400/10" href="/login">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
            Logout
        </a>
    </div>
</aside>

<!-- ══ MAIN ═════════════════════════════════════════════ -->
<main class="ml-[260px] flex-1 px-10 py-9 min-h-screen">

    <!-- Topbar -->
    <div class="topbar flex items-start justify-between mb-7">
        <h1 class="text-[36px] font-extrabold text-pos-gray-900 leading-none">Data Akun</h1>
        <div class="admin-badge flex items-center gap-3 bg-white border border-pos-gray-100 rounded-full px-4 py-2 shadow-pos-shadow">
            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-pos-green-light to-pos-teal flex items-center justify-center text-white font-bold text-base">A</div>
            <span class="text-sm font-bold text-pos-gray-900">Admin</span>
        </div>
    </div>

    <!-- Search -->
    <div class="relative mb-6 animate-fade-up">
        <svg class="absolute left-4 top-1/2 -translate-y-1/2 text-pos-gray-500" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
        <input type="text" id="searchInput" class="w-full bg-white border-[1.5px] border-pos-gray-300 rounded-[10px] pl-[46px] pr-4 py-[13px] text-sm font-semibold text-pos-gray-700 outline-none transition-all focus:border-pos-green-light focus:shadow-[0_0_0_3px_rgba(61,171,106,0.12)]" placeholder="Search user" oninput="filterTable()" />
    </div>

    <!-- Table -->
    <div class="bg-white rounded-pos-radius shadow-pos-shadow border border-pos-gray-100 overflow-hidden mb-6 animate-fade-up [animation-delay:0.1s]">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-pos-green-dark text-white">
                    <th class="table-cell-head">Profile</th>
                    <th class="table-cell-head">Username</th>
                    <th class="table-cell-head">Email</th>
                    <th class="table-cell-head">Status</th>
                    <th class="table-cell-head">Joined</th>
                    <th class="table-cell-head">Action</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <tr class="border-b border-pos-gray-100 last:border-none even:bg-[#f0f8f4] hover:bg-pos-green-pale transition-colors">
                    <td class="table-cell-body"><div class="w-[38px] h-[38px] rounded-full bg-gradient-to-br from-pos-gray-300 to-[#a0b8ac]"></div></td>
                    <td class="table-cell-body">Alex</td>
                    <td class="table-cell-body">example@gmail.com</td>
                    <td class="table-cell-body"><span class="inline-flex items-center gap-[5px] bg-[#e4f7f5] text-pos-teal px-3 py-1 rounded-[20px] text-[12px] font-bold before:content-[''] before:w-[6px] before:h-[6px] before:rounded-full before:bg-pos-teal">Active</span></td>
                    <td class="table-cell-body">June 12, 2025</td>
                    <td class="table-cell-body">
                        <div class="flex items-center gap-[10px]">
                            <button class="w-[30px] h-[30px] flex items-center justify-center text-pos-teal hover:bg-[#e4f7f5] rounded-md transition-all hover:scale-[1.15]" title="Lihat"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></button>
                            <button class="w-[30px] h-[30px] flex items-center justify-center text-[#f59e0b] hover:bg-[#fff8e1] rounded-md transition-all hover:scale-[1.15]" title="Blokir"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg></button>
                            <button class="w-[30px] h-[30px] flex items-center justify-center text-pos-green-mid hover:bg-pos-green-pale rounded-md transition-all hover:scale-[1.15]" title="Edit"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></button>
                        </div>
                    </td>
                </tr>
                <tr class="border-b border-pos-gray-100 last:border-none even:bg-[#f0f8f4] hover:bg-pos-green-pale transition-colors">
                    <td class="table-cell-body"><div class="w-[38px] h-[38px] rounded-full bg-gradient-to-br from-pos-gray-300 to-[#a0b8ac]"></div></td>
                    <td class="table-cell-body">Alex</td>
                    <td class="table-cell-body">example@gmail.com</td>
                    <td class="table-cell-body"><span class="inline-flex items-center gap-[5px] bg-[#e4f7f5] text-pos-teal px-3 py-1 rounded-[20px] text-[12px] font-bold before:content-[''] before:w-[6px] before:h-[6px] before:rounded-full before:bg-pos-teal">Active</span></td>
                    <td class="table-cell-body">June 12, 2025</td>
                    <td class="table-cell-body">
                        <div class="flex items-center gap-[10px]">
                            <button class="w-[30px] h-[30px] flex items-center justify-center text-pos-teal hover:bg-[#e4f7f5] rounded-md transition-all hover:scale-[1.15]" title="Lihat"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></button>
                            <button class="w-[30px] h-[30px] flex items-center justify-center text-[#f59e0b] hover:bg-[#fff8e1] rounded-md transition-all hover:scale-[1.15]" title="Blokir"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg></button>
                            <button class="w-[30px] h-[30px] flex items-center justify-center text-pos-green-mid hover:bg-pos-green-pale rounded-md transition-all hover:scale-[1.15]" title="Edit"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></button>
                        </div>
                    </td>
                </tr>
                <tr class="border-b border-pos-gray-100 last:border-none even:bg-[#f0f8f4] hover:bg-pos-green-pale transition-colors">
                    <td class="table-cell-body"><div class="w-[38px] h-[38px] rounded-full bg-gradient-to-br from-pos-gray-300 to-[#a0b8ac]"></div></td>
                    <td class="table-cell-body">Siti Rahma</td>
                    <td class="table-cell-body">siti.rahma@gmail.com</td>
                    <td class="table-cell-body"><span class="inline-flex items-center gap-[5px] bg-[#e4f7f5] text-pos-teal px-3 py-1 rounded-[20px] text-[12px] font-bold before:content-[''] before:w-[6px] before:h-[6px] before:rounded-full before:bg-pos-teal">Active</span></td>
                    <td class="table-cell-body">May 3, 2025</td>
                    <td class="table-cell-body">
                        <div class="flex items-center gap-[10px]">
                            <button class="w-[30px] h-[30px] flex items-center justify-center text-pos-teal hover:bg-[#e4f7f5] rounded-md transition-all hover:scale-[1.15]" title="Lihat"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></button>
                            <button class="w-[30px] h-[30px] flex items-center justify-center text-[#f59e0b] hover:bg-[#fff8e1] rounded-md transition-all hover:scale-[1.15]" title="Blokir"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg></button>
                            <button class="w-[30px] h-[30px] flex items-center justify-center text-pos-green-mid hover:bg-pos-green-pale rounded-md transition-all hover:scale-[1.15]" title="Edit"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></button>
                        </div>
                    </td>
                </tr>
                <tr class="border-b border-pos-gray-100 last:border-none even:bg-[#f0f8f4] hover:bg-pos-green-pale transition-colors">
                    <td class="table-cell-body"><div class="w-[38px] h-[38px] rounded-full bg-gradient-to-br from-pos-gray-300 to-[#a0b8ac]"></div></td>
                    <td class="table-cell-body">Dewi Kusuma</td>
                    <td class="table-cell-body">dewi.k@gmail.com</td>
                    <td class="table-cell-body"><span class="inline-flex items-center gap-[5px] bg-[#fef3f2] text-[#e74c3c] px-3 py-1 rounded-[20px] text-[12px] font-bold before:content-[''] before:w-[6px] before:h-[6px] before:rounded-full before:bg-[#e74c3c]">Inactive</span></td>
                    <td class="table-cell-body">April 20, 2025</td>
                    <td class="table-cell-body">
                        <div class="flex items-center gap-[10px]">
                            <button class="w-[30px] h-[30px] flex items-center justify-center text-pos-teal hover:bg-[#e4f7f5] rounded-md transition-all hover:scale-[1.15]" title="Lihat"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></button>
                            <button class="w-[30px] h-[30px] flex items-center justify-center text-[#f59e0b] hover:bg-[#fff8e1] rounded-md transition-all hover:scale-[1.15]" title="Blokir"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg></button>
                            <button class="w-[30px] h-[30px] flex items-center justify-center text-pos-green-mid hover:bg-pos-green-pale rounded-md transition-all hover:scale-[1.15]" title="Edit"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></button>
                        </div>
                    </td>
                </tr>
                <tr class="border-b border-pos-gray-100 last:border-none even:bg-[#f0f8f4] hover:bg-pos-green-pale transition-colors">
                    <td class="table-cell-body"><div class="w-[38px] h-[38px] rounded-full bg-gradient-to-br from-pos-gray-300 to-[#a0b8ac]"></div></td>
                    <td class="table-cell-body">Rina Wati</td>
                    <td class="table-cell-body">rina.wati@gmail.com</td>
                    <td class="table-cell-body"><span class="inline-flex items-center gap-[5px] bg-[#e4f7f5] text-pos-teal px-3 py-1 rounded-[20px] text-[12px] font-bold before:content-[''] before:w-[6px] before:h-[6px] before:rounded-full before:bg-pos-teal">Active</span></td>
                    <td class="table-cell-body">March 8, 2025</td>
                    <td class="table-cell-body">
                        <div class="flex items-center gap-[10px]">
                            <button class="w-[30px] h-[30px] flex items-center justify-center text-pos-teal hover:bg-[#e4f7f5] rounded-md transition-all hover:scale-[1.15]" title="Lihat"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></button>
                            <button class="w-[30px] h-[30px] flex items-center justify-center text-[#f59e0b] hover:bg-[#fff8e1] rounded-md transition-all hover:scale-[1.15]" title="Blokir"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg></button>
                            <button class="w-[30px] h-[30px] flex items-center justify-center text-pos-green-mid hover:bg-pos-green-pale rounded-md transition-all hover:scale-[1.15]" title="Edit"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-end animate-fade-up [animation-delay:0.2s]">
        <div class="flex items-center gap-[6px]">
            <button class="page-btn text-[15px]" onclick="changePage(currentPage-1)">&#8249;</button>
            <button class="page-btn active" id="pg1" onclick="changePage(1)">1</button>
            <button class="page-btn" id="pg2" onclick="changePage(2)">2</button>
            <span class="text-pos-gray-500 text-sm font-semibold px-1">...</span>
            <button class="page-btn" id="pg9" onclick="changePage(9)">9</button>
            <button class="page-btn" id="pg10" onclick="changePage(10)">10</button>
            <button class="page-btn text-[15px]" onclick="changePage(currentPage+1)">&#8250;</button>
        </div>
    </div>

</main>

<script>
    function filterTable() {
        const q = document.getElementById('searchInput').value.toLowerCase();
        document.querySelectorAll('#tableBody tr').forEach(r => {
            r.style.display = r.textContent.toLowerCase().includes(q) ? '' : 'none';
        });
    }

    let currentPage = 1;
    function changePage(p) {
        if (p < 1 || p > 10) return;
        currentPage = p;
        [1,2,9,10].forEach(n => {
            const el = document.getElementById('pg'+n);
            if (el) el.classList.toggle('active', n === p);
        });
    }
</script>
</body>
</html>