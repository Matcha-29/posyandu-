<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'POSYANDU')</title>
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
    <style>
        .nav-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 13px 18px;
            border-radius: 10px;
            color: rgba(255, 255, 255, 0.65);
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .nav-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: #ffffff;
        }
        .nav-item.active {
            background-color: #3dab6a;
            color: #ffffff;
            box-shadow: 0 4px 14px rgba(61, 171, 106, 0.35);
        }
        .stat-card {
            background-color: #ffffff;
            border-radius: 14px;
            padding: 24px;
            border: 1px solid #eef2f0;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: all 0.2s ease;
            box-shadow: 0 2px 16px rgba(26,92,56,.10);
            animation: fadeUp 0.5s ease both;
        }
        .stat-card:hover {
            box-shadow: 0 6px 32px rgba(26,92,56,.14);
            transform: translateY(-3px);
        }
        .stat-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .stat-label {
            font-size: 12px;
            color: #7a9186;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .stat-value {
            font-size: 28px;
            font-weight: 800;
            color: #1a2e26;
            line-height: 1.25;
            margin-top: 2px;
        }
        .pos-table-card {
            background-color: #ffffff;
            border-radius: 14px;
            box-shadow: 0 2px 16px rgba(26,92,56,.10);
            border: 1px solid #eef2f0;
            overflow: hidden;
            margin-bottom: 24px;
            animation: fadeUp 0.5s ease both;
        }
        .pos-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }
        .pos-table thead tr {
            background-color: #1a5c38;
        }
        .pos-table thead th {
            padding: 14px 20px;
            font-size: 12px;
            font-weight: 700;
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .pos-table tbody tr {
            border-bottom: 1px solid #eef2f0;
            transition: background-color 0.15s ease;
        }
        .pos-table tbody tr:last-child {
            border-bottom: none;
        }
        .pos-table tbody tr:nth-child(even) {
            background-color: #f0f8f4;
        }
        .pos-table tbody tr:hover {
            background-color: #e8f5ee;
        }
        .pos-table tbody td {
            padding: 14px 20px;
            font-size: 14px;
            font-weight: 600;
            color: #4b5563;
        }
    </style>
    @yield('styles')
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
            <a class="nav-item @if(Request::is('dashboard')) active @endif" href="/dashboard">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                    <path d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
                    <path d="M9 21V12h6v9"/>
                </svg>
                Dashboard
            </a>
            <a class="nav-item @if(Request::is('data_pasien') || Request::is('list_data_pasien')) active @endif" href="/data_pasien">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                </svg>
                Data Pasien
            </a>
            <a class="nav-item @if(Request::is('data_akun')) active @endif" href="/data_akun">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                    <circle cx="12" cy="8" r="4"/>
                    <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                </svg>
                Data Akun
            </a>
        </nav>

        <div class="nav-logout mt-auto w-full px-4 pb-2">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-item w-full !text-white/50 hover:!text-red-400 hover:!bg-red-400/10 border-none bg-transparent text-left">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                        <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- ══ MAIN ═════════════════════════════════════════════ -->
    <main class="main ml-[260px] flex-1 px-10 py-9 min-h-screen">
        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>
