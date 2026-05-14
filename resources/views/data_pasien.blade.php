<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Data Pasien – Posyandu</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <style>
        :root {
            --green-dark: #1a5c38;
            --green-mid: #2d8653;
            --green-light: #3dab6a;
            --green-pale: #e8f5ee;
            --teal: #1e9e8c;
            --white: #ffffff;
            --gray-50: #f7f9f8;
            --gray-100: #eef2f0;
            --gray-300: #c4d0ca;
            --gray-500: #7a9186;
            --gray-700: #3c524a;
            --gray-900: #1a2e26;
            --sidebar-w: 260px;
            --radius: 14px;
            --shadow: 0 2px 16px rgba(26, 92, 56, .10);
            --shadow-lg: 0 6px 32px rgba(26, 92, 56, .14);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--gray-50);
            color: var(--gray-900);
            display: flex;
            min-height: 100vh;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--green-dark);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 32px 0 24px;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 100;
            box-shadow: 4px 0 24px rgba(26, 92, 56, .18);
        }

        .sidebar-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            margin-bottom: 40px;
            padding: 0 20px;
        }

        .logo-wrap {
            width: 100px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-wrap img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .nav {
            width: 100%;
            padding: 0 16px;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 13px 18px;
            border-radius: 10px;
            color: rgba(255, 255, 255, .65);
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
            text-decoration: none;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, .08);
            color: #fff;
        }

        .nav-item.active {
            background: var(--green-light);
            color: #fff;
            box-shadow: 0 4px 14px rgba(61, 171, 106, .35);
        }

        .nav-logout {
            margin-top: auto;
            width: 100%;
            padding: 0 16px 8px;
        }

        .nav-logout .nav-item {
            color: rgba(255, 255, 255, .5);
        }

        .nav-logout .nav-item:hover {
            color: #ff8080;
            background: rgba(255, 80, 80, .08);
        }

        /* ── MAIN ── */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            padding: 36px 40px;
            min-height: 100vh;
        }

        /* ── TOPBAR ── */
        .topbar {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .topbar h1 {
            font-size: 36px;
            font-weight: 800;
            color: var(--gray-900);
        }

        .admin-badge {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--white);
            border: 1px solid var(--gray-100);
            border-radius: 50px;
            padding: 8px 16px 8px 8px;
            box-shadow: var(--shadow);
        }

        .admin-avatar-placeholder {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--green-light), var(--teal));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 16px;
        }

        .admin-name {
            font-size: 14px;
            font-weight: 700;
            color: var(--gray-900);
        }

        /* ── FILTER ROW ── */
        .filter-row {
            display: flex;
            gap: 12px;
            margin-bottom: 14px;
            animation: fadeUp .4s ease both;
        }

        .select-wrap {
            position: relative;
            display: inline-flex;
            align-items: center;
        }

        .select-wrap select {
            appearance: none;
            background: var(--white);
            border: 1.5px solid var(--gray-300);
            border-radius: 8px;
            padding: 10px 40px 10px 16px;
            font-size: 14px;
            font-weight: 600;
            color: var(--gray-700);
            font-family: inherit;
            cursor: pointer;
            outline: none;
            transition: border-color .2s;
            min-width: 130px;
        }

        .select-wrap select:focus {
            border-color: var(--green-light);
        }

        .select-wrap::after {
            content: '';
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 6px solid var(--gray-500);
            pointer-events: none;
        }

        /* ── SEARCH ── */
        .search-wrap {
            position: relative;
            margin-bottom: 24px;
            animation: fadeUp .4s .05s ease both;
        }

        .search-wrap svg {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-500);
        }

        .search-wrap input {
            width: 100%;
            background: var(--white);
            border: 1.5px solid var(--gray-300);
            border-radius: 10px;
            padding: 13px 16px 13px 46px;
            font-size: 14px;
            font-weight: 600;
            color: var(--gray-700);
            font-family: inherit;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }

        .search-wrap input::placeholder {
            color: var(--gray-500);
            font-weight: 500;
        }

        .search-wrap input:focus {
            border-color: var(--green-light);
            box-shadow: 0 0 0 3px rgba(61, 171, 106, .12);
        }

        /* ── STAT CARDS ── */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 22px 28px;
            box-shadow: var(--shadow);
            border: 1px solid var(--gray-100);
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: transform .2s, box-shadow .2s;
            animation: fadeUp .4s ease both;
        }

        .stat-card:nth-child(1) {
            animation-delay: .08s;
        }

        .stat-card:nth-child(2) {
            animation-delay: .13s;
        }

        .stat-card:nth-child(3) {
            animation-delay: .18s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
        }

        .stat-info .stat-label {
            font-size: 13px;
            color: var(--gray-500);
            font-weight: 600;
            margin-bottom: 4px;
        }

        .stat-info .stat-value {
            font-size: 32px;
            font-weight: 800;
            color: var(--gray-900);
            line-height: 1;
        }

        .stat-icon-img {
            width: 56px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: .85;
        }

        .stat-icon-img svg {
            width: 52px;
            height: 52px;
        }

        /* ── TABLE ── */
        .table-card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            border: 1px solid var(--gray-100);
            overflow: hidden;
            margin-bottom: 24px;
            animation: fadeUp .4s .22s ease both;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead tr {
            background: var(--green-dark);
        }

        thead th {
            padding: 14px 20px;
            text-align: left;
            font-size: 13px;
            font-weight: 700;
            color: #fff;
            letter-spacing: .3px;
        }

        tbody tr {
            border-bottom: 1px solid var(--gray-100);
            transition: background .15s;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        tbody tr:nth-child(even) {
            background: #f0f8f4;
        }

        tbody tr:hover {
            background: var(--green-pale);
        }

        tbody td {
            padding: 14px 20px;
            font-size: 14px;
            color: var(--gray-700);
            font-weight: 500;
        }

        /* Action icons */
        .action-btns {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn-icon {
            width: 30px;
            height: 30px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: none;
            background: transparent;
            transition: background .15s, transform .15s;
        }

        .btn-icon:hover {
            transform: scale(1.15);
        }

        .btn-view {
            color: var(--teal);
        }

        .btn-view:hover {
            background: #e4f7f5;
        }

        .btn-block {
            color: #f59e0b;
        }

        .btn-block:hover {
            background: #fff8e1;
        }

        .btn-edit {
            color: var(--green-mid);
        }

        .btn-edit:hover {
            background: var(--green-pale);
        }

        /* ── BOTTOM ROW ── */
        .bottom-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            animation: fadeUp .4s .28s ease both;
        }

        /* Print button */
        .btn-print {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #1e3a5f;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 12px 22px;
            font-size: 14px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(30, 58, 95, .35);
            transition: background .2s, transform .2s;
        }

        .btn-print:hover {
            background: #162d4a;
            transform: translateY(-2px);
        }

        /* Pagination */
        .pagination {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .page-btn {
            min-width: 36px;
            height: 36px;
            border-radius: 8px;
            border: 1.5px solid var(--gray-300);
            background: var(--white);
            color: var(--gray-700);
            font-size: 13px;
            font-weight: 700;
            font-family: inherit;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all .15s;
            padding: 0 10px;
        }

        .page-btn:hover {
            border-color: var(--green-light);
            color: var(--green-dark);
        }

        .page-btn.active {
            background: var(--green-dark);
            border-color: var(--green-dark);
            color: #fff;
            box-shadow: 0 3px 10px rgba(26, 92, 56, .25);
        }

        .page-btn.arrow {
            font-size: 15px;
        }

        .page-dots {
            color: var(--gray-500);
            font-size: 14px;
            font-weight: 600;
            padding: 0 4px;
        }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ── MODAL OVERLAY ── */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .5);
            z-index: 999;
            align-items: center;
            justify-content: center;
            animation: fadeIn .2s ease;
        }

        .modal-overlay.open {
            display: flex;
        }

        @keyframes fadeIn {
            from {
                opacity: 0
            }

            to {
                opacity: 1
            }
        }

        .modal-box {
            background: #f0f0f0;
            border-radius: 12px;
            width: 90vw;
            max-width: 820px;
            max-height: 90vh;
            height: auto;
            overflow: hidden;
            display: flex;
            gap: 0;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .3);
            animation: slideUp .25s ease;
        }

        @keyframes slideUp {
            from {
                transform: translateY(30px);
                opacity: 0
            }

            to {
                transform: none;
                opacity: 1
            }
        }

        /* Left: paper preview */
        .modal-paper-wrap {
            flex: 1;
            padding: 24px;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            overflow-y: auto;
        }

        .modal-paper {
            background: #fff;
            width: 100%;
            max-width: 480px;
            padding: 32px 36px;
            box-shadow: 0 2px 16px rgba(0, 0, 0, .15);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 12px;
            color: #111;
            height: auto;
            min-height: 0;
        }

        /* Kop surat */
        .kop {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding-bottom: 14px;
            border-bottom: 2px solid #111;
            margin-bottom: 16px;
        }

        .kop-logo {
            width: 60px;
            height: 60px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .kop-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .kop-logo-placeholder {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            background: var(--green-pale);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            font-weight: 800;
            color: var(--green-dark);
            text-align: center;
            border: 1.5px solid var(--green-light);
        }

        .kop-info p {
            margin: 1px 0;
            font-size: 11.5px;
            line-height: 1.5;
        }

        .kop-info .kop-name {
            font-size: 13px;
            font-weight: 800;
        }

        .report-title {
            text-align: center;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .report-meta {
            font-size: 11.5px;
            margin-bottom: 4px;
            line-height: 1.6;
        }

        .print-table-wrap {
            width: 100%;
            overflow-x: auto;
            margin-top: 12px;
            margin-bottom: 24px;
            border-radius: 4px;
            /* custom scrollbar */
            scrollbar-width: thin;
            scrollbar-color: #aaa #f0f0f0;
        }

        .print-table-wrap::-webkit-scrollbar {
            height: 6px;
        }

        .print-table-wrap::-webkit-scrollbar-track {
            background: #f0f0f0;
            border-radius: 4px;
        }

        .print-table-wrap::-webkit-scrollbar-thumb {
            background: #bbb;
            border-radius: 4px;
        }

        .print-table-wrap::-webkit-scrollbar-thumb:hover {
            background: #888;
        }

        .print-table {
            width: 100%;
            min-width: 560px;
            border-collapse: collapse;
            font-size: 11.5px;
        }

        .print-table th,
        .print-table td {
            border: 1px solid #555;
            padding: 7px 10px;
            text-align: left;
            white-space: nowrap;
        }

        .print-table th {
            background: #e8e8e8;
            font-weight: 700;
        }

        /* Right: print settings panel */
        .modal-settings {
            width: 300px;
            flex-shrink: 0;
            background: #fff;
            border-radius: 0 12px 12px 0;
            padding: 28px 24px;
            display: flex;
            flex-direction: column;
            gap: 0;
            border-left: 1px solid #e8e8e8;
            align-self: stretch;
            overflow-y: auto;
        }

        .settings-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid #eee;
        }

        .settings-header span {
            font-size: 16px;
            font-weight: 800;
            color: #111;
        }

        .settings-sheet {
            font-size: 12px;
            color: #888;
            font-weight: 500;
        }

        .setting-row {
            padding: 14px 0;
            border-bottom: 1px solid #eee;
        }

        .setting-row:last-of-type {
            border-bottom: none;
        }

        .setting-label {
            font-size: 12px;
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
            letter-spacing: .3px;
        }

        /* select wrapper with arrow */
        .select-field {
            position: relative;
            width: 100%;
        }

        .setting-select {
            width: 100%;
            background: #f5f5f5;
            border: 1.5px solid #ddd;
            border-radius: 8px;
            padding: 9px 36px 9px 12px;
            font-size: 13px;
            font-weight: 600;
            color: #333;
            font-family: inherit;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            outline: none;
            transition: border-color .2s, background .2s;
        }

        .setting-select:hover {
            border-color: #bbb;
            background: #efefef;
        }

        .setting-select:focus {
            border-color: #1e3a5f;
            background: #fff;
        }

        .select-field::after {
            content: '';
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 6px solid #666;
            pointer-events: none;
            transition: transform .2s;
        }

        .select-field:focus-within::after {
            transform: translateY(-50%) rotate(180deg);
        }

        .more-settings {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 0;
            font-size: 13px;
            font-weight: 700;
            color: #333;
            cursor: pointer;
            border-top: 1px solid #eee;
            margin-top: 4px;
            transition: color .2s;
        }

        .more-settings:hover {
            color: #1e3a5f;
        }

        .more-settings svg {
            transition: transform .2s;
        }

        .more-settings:hover svg {
            transform: translateY(2px);
        }

        .modal-actions {
            margin-top: auto;
            padding-top: 20px;
            display: flex;
            gap: 10px;
        }

        .btn-modal-print {
            flex: 1;
            padding: 12px;
            background: #1e3a5f;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            transition: background .2s, transform .15s;
            box-shadow: 0 3px 12px rgba(30, 58, 95, .25);
        }

        .btn-modal-print:hover {
            background: #162d4a;
            transform: translateY(-1px);
        }

        .btn-modal-cancel {
            flex: 1;
            padding: 12px;
            background: #fff;
            color: #555;
            border: 1.5px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            transition: background .2s, border-color .2s;
        }

        .btn-modal-cancel:hover {
            background: #f5f5f5;
            border-color: #bbb;
        }

        /* print media — only show the paper */
        @media print {
            body * {
                visibility: hidden;
            }

            .modal-paper,
            .modal-paper * {
                visibility: visible;
            }

            .modal-paper {
                position: fixed;
                inset: 0;
                width: 100vw;
                box-shadow: none;
            }

            .modal-overlay,
            .modal-box {
                display: block !important;
                background: none !important;
                box-shadow: none !important;
            }

            .modal-settings {
                display: none;
            }
        }
    </style>
</head>

<body>

    <!-- ══ SIDEBAR ══ -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <div class="logo-wrap">
                <img src="{{ asset('image/logo.png') }}" alt="Logo POSYANDU" />
            </div>
        </div>

        <nav class="nav">
            <a class="nav-item" href="/dashboard">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z" />
                    <path d="M9 21V12h6v9" />
                </svg>
                Dashboard
            </a>
            <a class="nav-item active" href="/data_pasien">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                </svg>
                Data Pasien
            </a>
            <a class="nav-item" href="/data_akun">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="8" r="4" />
                    <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7" />
                </svg>
                Data Akun
            </a>
        </nav>

        <div class="nav-logout">
            <a class="nav-item" href="/login">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4" />
                    <polyline points="16 17 21 12 16 7" />
                    <line x1="21" y1="12" x2="9" y2="12" />
                </svg>
                Logout
            </a>
        </div>
    </aside>

    <!-- ══ MAIN ══ -->
    <main class="main">

        <!-- Topbar -->
        <div class="topbar">
            <h1>Data Pasien</h1>
            <div class="admin-badge">
                <div class="admin-avatar-placeholder">A</div>
                <span class="admin-name">Admin</span>
            </div>
        </div>

        <!-- Filter -->
        <div class="filter-row">
            <div class="select-wrap">
                <select>
                    <option>Kategori</option>
                    <option>Ibu Hamil</option>
                    <option>Balita</option>
                </select>
            </div>
            <div class="select-wrap">
                <select>
                    <option>Filter</option>
                    <option>Terbaru</option>
                    <option>Terlama</option>
                    <option>A–Z</option>
                </select>
            </div>
        </div>

        <!-- Search -->
        <div class="search-wrap">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8" />
                <line x1="21" y1="21" x2="16.65" y2="16.65" />
            </svg>
            <input type="text" placeholder="Search user" id="searchInput" oninput="filterTable()" />
        </div>

        <!-- Stat Cards -->
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-info">
                    <div class="stat-label">Total Pasien</div>
                    <div class="stat-value">4,222</div>
                </div>
                <div class="stat-icon-img">
                    <!-- hand + people icon -->
                    <svg viewBox="0 0 52 52" fill="none" stroke="#1a2e26" stroke-width="1.6" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="20" cy="12" r="5" />
                        <path d="M10 30c0-5.5 4.5-9 10-9s10 3.5 10 9" />
                        <circle cx="34" cy="14" r="4" />
                        <path d="M26 30c1-4 4-7 8-7s7 3 8 7" opacity=".5" />
                        <path d="M8 38c3 3 8 5 14 5s11-2 14-5" stroke-width="1.4" opacity=".4" />
                        <path d="M6 34c0 0 4 6 20 6" stroke-width="1.4" opacity=".4" />
                    </svg>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-info">
                    <div class="stat-label">Total Ibu Hamil</div>
                    <div class="stat-value">2,222</div>
                </div>
                <div class="stat-icon-img">
                    <!-- pregnant woman icon -->
                    <svg viewBox="0 0 52 52" fill="none" stroke="#1a2e26" stroke-width="1.6" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="26" cy="10" r="5" />
                        <path d="M20 20h12" />
                        <path d="M22 20v8c0 5 3 9 4 9s4-4 4-9v-8" />
                        <ellipse cx="30" cy="30" rx="4" ry="5" opacity=".5" />
                        <path d="M20 44v-6M32 44v-6" opacity=".5" />
                    </svg>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-info">
                    <div class="stat-label">Total Balita</div>
                    <div class="stat-value">122</div>
                </div>
                <div class="stat-icon-img">
                    <!-- baby / child icon -->
                    <svg viewBox="0 0 52 52" fill="none" stroke="#1a2e26" stroke-width="1.6" stroke-linecap="round"
                        stroke-linejoin="round">
                        <circle cx="26" cy="14" r="6" />
                        <path d="M18 28c0-4.4 3.6-8 8-8s8 3.6 8 8" />
                        <path d="M14 36c0 0 3-4 12-4s12 4 12 4" opacity=".5" />
                        <circle cx="22" cy="13" r="1" fill="#1a2e26" stroke="none" />
                        <circle cx="30" cy="13" r="1" fill="#1a2e26" stroke="none" />
                        <path d="M23 17c1 1.5 3 1.5 4 0" stroke-width="1.4" />
                        <!-- ears -->
                        <path d="M20 12c-2-1-4 1-3 4" stroke-width="1.3" opacity=".6" />
                        <path d="M32 12c2-1 4 1 3 4" stroke-width="1.3" opacity=".6" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="table-card">
            <table id="pasienTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Alamat</th>
                        <th>Kategori</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <tr>
                        <td>1</td>
                        <td>Alex</td>
                        <td>3476537829398</td>
                        <td>Jln. Mawar</td>
                        <td>Ibu Hamil</td>
                        <td>
                            <div class="action-btns">
                                <button class="btn-icon btn-view" title="Lihat"><svg width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg></button>
                                <button class="btn-icon btn-block" title="Blokir"><svg width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <line x1="4.93" y1="4.93" x2="19.07" y2="19.07" />
                                    </svg></button>
                                <button class="btn-icon btn-edit" title="Edit"><svg width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                                        <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                                    </svg></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Alex</td>
                        <td>3476537829398</td>
                        <td>Jln. Mawar</td>
                        <td>Ibu Hamil</td>
                        <td>
                            <div class="action-btns">
                                <button class="btn-icon btn-view" title="Lihat"><svg width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg></button>
                                <button class="btn-icon btn-block" title="Blokir"><svg width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <line x1="4.93" y1="4.93" x2="19.07" y2="19.07" />
                                    </svg></button>
                                <button class="btn-icon btn-edit" title="Edit"><svg width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                                        <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                                    </svg></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Siti Rahma</td>
                        <td>3512019845612</td>
                        <td>Jln. Melati</td>
                        <td>Balita</td>
                        <td>
                            <div class="action-btns">
                                <button class="btn-icon btn-view" title="Lihat"><svg width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg></button>
                                <button class="btn-icon btn-block" title="Blokir"><svg width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <line x1="4.93" y1="4.93" x2="19.07" y2="19.07" />
                                    </svg></button>
                                <button class="btn-icon btn-edit" title="Edit"><svg width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                                        <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                                    </svg></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Dewi Kusuma</td>
                        <td>3578023451289</td>
                        <td>Jln. Anggrek</td>
                        <td>Ibu Hamil</td>
                        <td>
                            <div class="action-btns">
                                <button class="btn-icon btn-view" title="Lihat"><svg width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg></button>
                                <button class="btn-icon btn-block" title="Blokir"><svg width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <line x1="4.93" y1="4.93" x2="19.07" y2="19.07" />
                                    </svg></button>
                                <button class="btn-icon btn-edit" title="Edit"><svg width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                                        <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                                    </svg></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Rina Wati</td>
                        <td>3507112367891</td>
                        <td>Jln. Dahlia</td>
                        <td>Balita</td>
                        <td>
                            <div class="action-btns">
                                <button class="btn-icon btn-view" title="Lihat"><svg width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg></button>
                                <button class="btn-icon btn-block" title="Blokir"><svg width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <line x1="4.93" y1="4.93" x2="19.07" y2="19.07" />
                                    </svg></button>
                                <button class="btn-icon btn-edit" title="Edit"><svg width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                                        <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                                    </svg></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Bottom row -->
        <div class="bottom-row">
            <button class="btn-print" onclick="openPrintModal()">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="6 9 6 2 18 2 18 9" />
                    <path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2" />
                    <rect x="6" y="14" width="12" height="8" />
                </svg>
                Cetak laporan
            </button>

            <div class="pagination">
                <button class="page-btn arrow" onclick="changePage(currentPage-1)">&#8249;</button>
                <button class="page-btn active" id="pg1" onclick="changePage(1)">1</button>
                <button class="page-btn" id="pg2" onclick="changePage(2)">2</button>
                <span class="page-dots">...</span>
                <button class="page-btn" id="pg9" onclick="changePage(9)">9</button>
                <button class="page-btn" id="pg10" onclick="changePage(10)">10</button>
                <button class="page-btn arrow" onclick="changePage(currentPage+1)">&#8250;</button>
            </div>
        </div>

    </main>

    <!-- ══ MODAL CETAK LAPORAN ══ -->
    <div class="modal-overlay" id="printModal">
        <div class="modal-box">

            <!-- Paper preview -->
            <div class="modal-paper-wrap">
                <div class="modal-paper" id="printArea">
                    <!-- Kop -->
                    <div class="kop">
                        <div class="kop-logo">

                            <img src="{{ asset('image/logo.png') }}" alt="Logo POSYANDU" />
                        </div>
                        <div class="kop-info">
                            <p class="kop-name">POSYANDU ALAMAN 87</p>
                            <p>Telepon : 0878667363</p>
                            <p>Jln. Nusa Indah No. 155</p>
                            <p>Website : posyandualamanda.com</p>
                            <p>Email : alamandahengker@gmail.com</p>
                        </div>
                    </div>

                    <div class="report-title">Laporan Data Pasien</div>
                    <div class="report-meta">Di Cetak Pada : <span id="printDate"></span></div>
                    <div class="report-meta">Laporan Data Pasien Pada : '<span id="printDateShort"></span>'</div>

                    <div class="print-table-wrap">
                        <table class="print-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nik</th>
                                    <th>No. Telpon</th>
                                    <th>Alamat</th>
                                    <th>Dusun</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Badrul</td>
                                    <td>009747391</td>
                                    <td>0877788</td>
                                    <td>Jln. Nuaasss</td>
                                    <td>Patrang</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Hamidun</td>
                                    <td>09876678</td>
                                    <td>08789987635</td>
                                    <td>Jln. Bakso</td>
                                    <td>Lalo</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Alex</td>
                                    <td>3476537829398</td>
                                    <td>08123456789</td>
                                    <td>Jln. Mawar</td>
                                    <td>Sumbersari</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Siti Rahma</td>
                                    <td>3512019845612</td>
                                    <td>08234567890</td>
                                    <td>Jln. Melati</td>
                                    <td>Kaliwates</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Dewi Kusuma</td>
                                    <td>3578023451289</td>
                                    <td>08345678901</td>
                                    <td>Jln. Anggrek</td>
                                    <td>Patrang</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Settings panel -->
            <div class="modal-settings">
                <div class="settings-header">
                    <span>Print</span>
                    <span class="settings-sheet">1 sheet of paper</span>
                </div>

                <div class="setting-row">
                    <div class="setting-label">Destination</div>
                    <div class="select-field">
                        <select class="setting-select">
                            <option>🖨 Destination</option>
                            <option>Save as PDF</option>
                            <option>Microsoft Print to PDF</option>
                        </select>
                    </div>
                </div>

                <div class="setting-row">
                    <div class="setting-label">Pages</div>
                    <div class="select-field">
                        <select class="setting-select">
                            <option>All</option>
                            <option>Current page</option>
                            <option>Custom range</option>
                        </select>
                    </div>
                </div>

                <div class="setting-row">
                    <div class="setting-label">Layout</div>
                    <div class="select-field">
                        <select class="setting-select">
                            <option>Portrait</option>
                            <option>Landscape</option>
                        </select>
                    </div>
                </div>

                <div class="setting-row">
                    <div class="setting-label">Color</div>
                    <div class="select-field">
                        <select class="setting-select">
                            <option>Color</option>
                            <option>Black and white</option>
                        </select>
                    </div>
                </div>

                <div class="more-settings">
                    More Settings
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9" />
                    </svg>
                </div>

                <div class="modal-actions">
                    <button class="btn-modal-print" onclick="doPrint()">Print</button>
                    <button class="btn-modal-cancel" onclick="closeModal()">Batal</button>
                </div>
            </div>

        </div>
    </div>

    <script>
        // Set print dates
        const now = new Date();
        const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        document.getElementById('printDate').textContent =
            now.getDate() + '-' + months[now.getMonth()] + '-' + now.getFullYear();
        const pad = n => String(n).padStart(2, '0');
        document.getElementById('printDateShort').textContent =
            pad(now.getDate()) + '-' + pad(now.getMonth() + 1) + '-' + now.getFullYear();

        function openPrintModal() {
            document.getElementById('printModal').classList.add('open');
            document.body.style.overflow = 'hidden';
        }
        function closeModal() {
            document.getElementById('printModal').classList.remove('open');
            document.body.style.overflow = '';
        }
        function doPrint() { window.print(); }

        // Close on overlay click
        document.getElementById('printModal').addEventListener('click', function (e) {
            if (e.target === this) closeModal();
        });

        // Search filter
        function filterTable() {
            const q = document.getElementById('searchInput').value.toLowerCase();
            document.querySelectorAll('#tableBody tr').forEach(r => {
                r.style.display = r.textContent.toLowerCase().includes(q) ? '' : 'none';
            });
        }

        // Pagination highlight
        let currentPage = 1;
        function changePage(p) {
            if (p < 1 || p > 10) return;
            currentPage = p;
            [1, 2, 9, 10].forEach(n => {
                const el = document.getElementById('pg' + n);
                if (el) el.classList.toggle('active', n === p);
            });
        }
    </script>
</body>

</html>