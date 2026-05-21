@extends('layouts.app')

@section('title', 'Data Pasien — POSYANDU')

@section('content')
    <style>
        :root {
            --green-dark: #0A5C55;
            --green-mid: #0E766D;
            --green-light: #0D7E73;
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
        .stat-card:nth-child(1) { animation-delay: .05s; }
        .stat-card:nth-child(2) { animation-delay: .10s; }
        .stat-card:nth-child(3) { animation-delay: .15s; }

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
            @page {
                margin: 1cm;
            }

            body * {
                visibility: hidden;
            }

            .modal-paper,
            .modal-paper * {
                visibility: visible;
            }

            .modal-paper {
                position: absolute;
                left: 0;
                top: 0;
                width: 100% !important;
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                box-shadow: none !important;
                border: none !important;
            }

            .modal-overlay,
            .modal-box {
                position: static !important;
                display: block !important;
                background: none !important;
                box-shadow: none !important;
                width: 100% !important;
                max-width: 100% !important;
                height: auto !important;
                max-height: none !important;
                overflow: visible !important;
            }

            .modal-paper-wrap {
                overflow: visible !important;
                padding: 0 !important;
            }

            .print-table-wrap {
                overflow: visible !important;
                margin: 0 !important;
            }

            .print-table {
                width: 100% !important;
                min-width: 100% !important;
            }

            .modal-settings {
                display: none !important;
            }
        }
        .hidden {
            display: none !important;
        }
        .translate-x-full {
            transform: translateX(100%) !important;
        }

        /* ── UNIFIED TOOLBAR & CUSTOM DROPDOWNS ── */
        .btn-tambah {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 16px;
            background-color: var(--green-mid);
            color: #fff;
            font-size: 0.88rem;
            font-weight: 700;
            border-radius: 10px;
            box-shadow: 0 4px 14px rgba(14, 118, 109, 0.1);
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }
        .btn-tambah:hover {
            background-color: var(--green-dark);
            transform: translateY(-1px);
        }
        .dd-trigger {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            min-width: 140px;
            border: 1.5px solid #e0ebe9;
            border-radius: 10px;
            background-color: #fff;
            cursor: pointer;
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
            transition: all 0.2s ease;
            user-select: none;
        }
        .dd-trigger:hover {
            border-color: var(--green-light);
            box-shadow: 0 0 0 3px rgba(61, 171, 106, 0.08);
        }
        .search-input {
            padding-left: 36px;
            padding-right: 16px;
            padding-top: 10px;
            padding-bottom: 10px;
            border: 1.5px solid #e0ebe9;
            border-radius: 10px;
            background-color: #fff;
            color: var(--gray-900);
            font-size: 0.87rem;
            outline: none;
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
            transition: all 0.2s ease;
        }
        .search-input:focus {
            border-color: var(--green-light);
            box-shadow: 0 0 0 3px rgba(61, 171, 106, 0.1);
        }
        .btn-apply {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            background-color: var(--green-mid);
            color: #fff;
            font-size: 0.87rem;
            font-weight: 700;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(14,118,109,0.2);
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }
        .btn-apply:hover {
            background-color: var(--green-dark);
            transform: translateY(-1px);
        }
        .btn-reset-custom {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 12px;
            background-color: #fff;
            border: 1px solid #eef2f0;
            color: #888;
            font-size: 0.87rem;
            font-weight: 700;
            border-radius: 10px;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }
        .btn-reset-custom:hover {
            border-color: var(--green-light);
            color: var(--green-mid);
        }
    </style>

    <!-- Topbar -->
    <div class="topbar flex items-center justify-between mb-8">
        <div class="topbar-title">
            <h1 class="text-[36px] font-extrabold text-pos-gray-900 leading-none">Data Pasien</h1>
        </div>
        <div class="admin-badge flex items-center gap-3 bg-white border border-pos-gray-100 rounded-full px-4 py-2 shadow-pos-shadow">
            <img class="w-10 h-10 rounded-full object-cover border border-pos-green-light" src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=80&h=80&q=80' }}" alt="Admin" />
            <div class="text-left">
                <p class="text-xs font-bold leading-none text-pos-gray-900">{{ Auth::user()->name }}</p>
                <p class="text-[9px] font-bold text-pos-gray-500 uppercase tracking-widest mt-1">{{ Auth::user()->role }}</p>
            </div>
        </div>
    </div>

    <!-- Unified Toolbar (Info, Filters) -->
    <div class="bg-white border border-pos-gray-100 rounded-2xl shadow-pos-shadow p-3.5 mb-6 flex flex-wrap lg:flex-nowrap items-center justify-between gap-3 w-full">
        <!-- Left Section: Info Count -->
        <div class="flex items-center gap-4 shrink-0 w-full lg:w-auto">
            <span class="text-[0.87rem] text-pos-gray-500 font-bold whitespace-nowrap" id="infoCount">Menampilkan 0 dari 0 data</span>
        </div>

        <!-- Right Section: Filters -->
        <div class="flex items-center gap-2 grow justify-end w-full lg:w-auto">
            <!-- Dropdown: Kategori -->
            <div class="relative select-none shrink-0" id="ddKategori">
                    <div class="dd-trigger !min-w-[125px]" onclick="toggleDD('ddKategori')">
                        <i class="ti ti-category text-pos-teal text-base" style="color: var(--green-mid);"></i>
                        <span class="grow font-semibold text-[0.87rem] text-pos-gray-900" id="ddKatLabel">Semua Kategori</span>
                        <svg class="text-pos-gray-500 shrink-0 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m19 9-7 7-7-7"/></svg>
                    </div>
                    <div class="hidden absolute top-[calc(100%+8px)] left-0 min-w-full bg-white border-[1.5px] border-pos-gray-100 rounded-xl shadow-[0_8px_28px_rgba(0,0,0,0.1)] overflow-hidden z-50">
                        <div class="px-[14px] py-[10px] text-[0.86rem] font-medium text-pos-gray-900 cursor-pointer hover:bg-pos-green-pale hover:text-pos-green-dark transition-colors active" data-val="" data-label="Semua Kategori" onclick="pickKat(this)">Semua Kategori</div>
                        <div class="h-px bg-pos-gray-100 my-1"></div>
                        <div class="px-[14px] py-[10px] text-[0.86rem] font-medium text-pos-gray-900 cursor-pointer hover:bg-pos-green-pale hover:text-pos-green-dark transition-colors" data-val="ibu" data-label="Ibu Hamil" onclick="pickKat(this)">Ibu Hamil</div>
                        <div class="px-[14px] py-[10px] text-[0.86rem] font-medium text-pos-gray-900 cursor-pointer hover:bg-pos-green-pale hover:text-pos-green-dark transition-colors" data-val="balita" data-label="Balita" onclick="pickKat(this)">Balita</div>
                        <div class="px-[14px] py-[10px] text-[0.86rem] font-medium text-pos-gray-900 cursor-pointer hover:bg-pos-green-pale hover:text-pos-green-dark transition-colors" data-val="lansia" data-label="Lansia" onclick="pickKat(this)">Lansia</div>
                    </div>
                </div>

                <!-- Dropdown: Urutkan -->
                <div class="relative select-none" id="ddSort">
                    <div class="dd-trigger !min-w-[110px]" onclick="toggleDD('ddSort')">
                        <i class="ti ti-arrows-sort text-pos-teal text-base" style="color: var(--green-mid);"></i>
                        <span class="grow font-semibold text-[0.87rem] text-pos-gray-900" id="ddSortLabel">Urutkan</span>
                        <svg class="text-pos-gray-500 shrink-0 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m19 9-7 7-7-7"/></svg>
                    </div>
                    <div class="hidden absolute top-[calc(100%+8px)] left-0 min-w-full bg-white border-[1.5px] border-pos-gray-100 rounded-xl shadow-[0_8px_28px_rgba(0,0,0,0.1)] overflow-hidden z-50">
                        <div class="px-[14px] py-[10px] text-[0.86rem] font-medium text-pos-gray-900 cursor-pointer hover:bg-pos-green-pale hover:text-pos-green-dark transition-colors active" data-val="" data-label="Urutkan" onclick="pickSort(this)">Default</div>
                        <div class="h-px bg-pos-gray-100 my-1"></div>
                        <div class="px-[14px] py-[10px] text-[0.86rem] font-medium text-pos-gray-900 cursor-pointer hover:bg-pos-green-pale hover:text-pos-green-dark transition-colors" data-val="terbaru" data-label="Terbaru" onclick="pickSort(this)">Terbaru</div>
                        <div class="px-[14px] py-[10px] text-[0.86rem] font-medium text-pos-gray-900 cursor-pointer hover:bg-pos-green-pale hover:text-pos-green-dark transition-colors" data-val="terlama" data-label="Terlama" onclick="pickSort(this)">Terlama</div>
                        <div class="px-[14px] py-[10px] text-[0.86rem] font-medium text-pos-gray-900 cursor-pointer hover:bg-pos-green-pale hover:text-pos-green-dark transition-colors" data-val="nama" data-label="Nama A–Z" onclick="pickSort(this)">Nama A–Z</div>
                        <div class="px-[14px] py-[10px] text-[0.86rem] font-medium text-pos-gray-900 cursor-pointer hover:bg-pos-green-pale hover:text-pos-green-dark transition-colors" data-val="nik" data-label="NIK" onclick="pickSort(this)">NIK</div>
                    </div>
                </div>

            <!-- Search -->
            <div class="relative grow max-w-[180px] min-w-[130px]">
                <i class="ti ti-search absolute text-pos-gray-500 text-base pointer-events-none" style="left: 12px; top: 50%; transform: translateY(-50%); position: absolute;"></i>
                <input type="text" id="searchInput" class="search-input !w-full" placeholder="Cari nama, NIK..." style="padding-left: 36px; width: 100%;" />
            </div>

            <!-- Right: Action Buttons -->
            <!-- Tombol Terapkan -->
            <button onclick="applyFilter()" class="btn-apply shrink-0">
                <i class="ti ti-filter text-base"></i> Terapkan
            </button>

            <!-- Tombol Reset -->
            <button onclick="resetFilter()" class="btn-reset-custom hidden shrink-0" id="btnReset">
                <i class="ti ti-x text-base"></i> Reset
            </button>
        </div>
    </div>

        <!-- Stat Cards -->
        <div class="stats-row grid grid-cols-3 gap-5 mb-7">
            <div class="stat-card">
                <div class="stat-icon w-[52px] h-[52px] rounded-xl flex items-center justify-center shrink-0 bg-[#fff4e5]">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                    </svg>
                </div>
                <div class="stat-info">
                    <div class="stat-label">Total Pasien</div>
                    <div class="stat-value">{{ number_format($totalPasien) }}</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon w-[52px] h-[52px] rounded-xl flex items-center justify-center shrink-0 bg-[#e4f7f5]">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#1e9e8c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="9" cy="6" r="3"/>
                        <path d="M4 20v-2a5 5 0 015-5h0a5 5 0 015 5v2"/>
                        <circle cx="17" cy="4" r="2" opacity=".6"/>
                        <path d="M14 8h3" opacity=".6"/>
                    </svg>
                </div>
                <div class="stat-info">
                    <div class="stat-label">Balita</div>
                    <div class="stat-value">{{ number_format($totalBalita) }}</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon w-[52px] h-[52px] rounded-xl flex items-center justify-center shrink-0 bg-pos-green-pale">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#2d8653" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="7" r="4"/>
                        <path d="M6 21v-1a6 6 0 0112 0v1"/>
                        <path d="M9 14c1 4 5 4 6 0" stroke-width="1.5" opacity=".7"/>
                    </svg>
                </div>
                <div class="stat-info">
                    <div class="stat-label">Ibu Hamil</div>
                    <div class="stat-value">{{ number_format($totalIgu) }}</div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="pos-table-card">
            <table id="pasienTable" class="pos-table">
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
                    @foreach($patients as $index => $d)
                    <tr onclick="goToForm({{ $d->id }})" style="cursor: pointer;">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $d->nama }}</td>
                        <td>{{ $d->nik }}</td>
                        <td>{{ $d->alamat }}</td>
                        <td>
                            <span class="badge-kategori {{ $d->kategori }}" style="padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; background: {{ $d->kategori === 'ibu' ? '#e4f7f5' : '#e8f5ee' }}; color: {{ $d->kategori === 'ibu' ? '#1e9e8c' : '#1a5c38' }};">
                                {{ $d->kategori === 'ibu' ? 'Ibu Hamil' : 'Balita' }}
                            </span>
                        </td>
                        <td onclick="event.stopPropagation()">
                            <div class="action-btns">
                                <button class="btn-icon btn-view" onclick="lihat({{ $d->id }})" title="Lihat"><svg width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg></button>
                                <button class="btn-icon btn-block" onclick="hapus({{ $d->id }})" title="Hapus" style="color: #ef4444;"><svg width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <line x1="4.93" y1="4.93" x2="19.07" y2="19.07" />
                                    </svg></button>
                                <button class="btn-icon btn-edit" onclick="edit({{ $d->id }})" title="Edit"><svg width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                                        <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                                    </svg></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Bottom row -->
        <div class="bottom-row flex items-center justify-between flex-wrap gap-4 mt-6">
            <!-- Left: Cetak laporan -->
            <button class="btn-print shrink-0" onclick="openPrintModal()">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="6 9 6 2 18 2 18 9" />
                    <path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2" />
                    <rect x="6" y="14" width="12" height="8" />
                </svg>
                Cetak laporan
            </button>

            <!-- Right: Limit & Pagination -->
            <div class="flex items-center gap-6 flex-wrap">
                <!-- Limit Selector -->
                <div class="flex items-center gap-2">
                    <span class="text-[13px] font-bold text-pos-gray-500">Tampilkan:</span>
                    <div class="relative flex items-center group">
                        <select id="limitSelect" onchange="changeLimit(this.value)" class="h-9 pl-3.5 pr-8 border-[1.5px] border-pos-gray-300 rounded-lg bg-white text-[13px] font-bold text-pos-gray-700 outline-none focus:border-pos-teal cursor-pointer transition-all hover:border-pos-teal hover:text-pos-teal appearance-none shadow-sm" style="min-width: 90px; appearance: none; padding-right: 28px;">
                            <option value="5">5 data</option>
                            <option value="10">10 data</option>
                            <option value="20">20 data</option>
                        </select>
                        <svg class="absolute right-2.5 text-pos-gray-500 pointer-events-none w-3.5 h-3.5 transition-colors duration-200 group-hover:text-pos-teal" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" style="width: 12px; height: 12px;"><path stroke-linecap="round" stroke-linejoin="round" d="m19 9-7 7-7-7"/></svg>
                    </div>
                </div>

                <div class="pagination" id="paginationWrap"></div>
            </div>
        </div>

    <!-- ══ MODAL EDIT PASIEN ══ -->
    <div class="hidden fixed inset-0 bg-black/50 z-[300] items-center justify-center backdrop-blur-[4px]" id="editOverlay">
        <div class="bg-white rounded-[20px] w-full max-w-[620px] shadow-[0_24px_64px_rgba(0,0,0,0.22)] overflow-hidden" style="font-family: inherit;">
            <!-- Header -->
            <div style="background: linear-gradient(135deg, #0E766D, #0A5C55); padding: 22px 28px; display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 12px;">
                    <div style="width: 40px; height: 40px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <i class="ti ti-edit" style="color: #fff; font-size: 18px;"></i>
                    </div>
                    <div>
                        <h2 style="color: #fff; font-size: 17px; font-weight: 800; margin: 0;">Edit Data Pasien</h2>
                        <p style="color: rgba(255,255,255,0.7); font-size: 11px; margin: 2px 0 0; font-weight: 600;">Perbarui informasi data pasien</p>
                    </div>
                </div>
                <button onclick="closeEditModal()" style="background: rgba(255,255,255,0.15); border: none; border-radius: 8px; width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #fff; font-size: 18px; transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'">✕</button>
            </div>

            <!-- Body -->
            <div style="padding: 28px; max-height: 70vh; overflow-y: auto;">
                <input type="hidden" id="editId" />

                <!-- Alert -->
                <div id="editAlert" style="display: none; padding: 12px 16px; border-radius: 10px; font-size: 13px; font-weight: 600; margin-bottom: 20px;"></div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <!-- Nama -->
                    <div style="grid-column: span 2;">
                        <label style="display: block; font-size: 11px; font-weight: 800; color: #0E766D; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.05em;">Nama Lengkap <span style="color:#ef4444">*</span></label>
                        <input type="text" id="editNama" placeholder="Nama lengkap pasien" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e0ebe9; border-radius: 10px; font-size: 14px; font-family: inherit; outline: none; transition: border-color 0.2s; box-sizing: border-box;" onfocus="this.style.borderColor='#0E766D'" onblur="this.style.borderColor='#e0ebe9'" />
                    </div>

                    <!-- NIK -->
                    <div>
                        <label style="display: block; font-size: 11px; font-weight: 800; color: #0E766D; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.05em;">NIK <span style="color:#ef4444">*</span></label>
                        <input type="text" id="editNik" placeholder="16 digit NIK" maxlength="16" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e0ebe9; border-radius: 10px; font-size: 14px; font-family: inherit; outline: none; transition: border-color 0.2s; box-sizing: border-box;" onfocus="this.style.borderColor='#0E766D'" onblur="this.style.borderColor='#e0ebe9'" />
                    </div>

                    <!-- No HP -->
                    <div>
                        <label style="display: block; font-size: 11px; font-weight: 800; color: #0E766D; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.05em;">No. HP</label>
                        <input type="text" id="editNoHp" placeholder="08xx-xxxx-xxxx" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e0ebe9; border-radius: 10px; font-size: 14px; font-family: inherit; outline: none; transition: border-color 0.2s; box-sizing: border-box;" onfocus="this.style.borderColor='#0E766D'" onblur="this.style.borderColor='#e0ebe9'" />
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label style="display: block; font-size: 11px; font-weight: 800; color: #0E766D; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.05em;">Kategori <span style="color:#ef4444">*</span></label>
                        <select id="editKategori" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e0ebe9; border-radius: 10px; font-size: 14px; font-family: inherit; outline: none; background: #fff; cursor: pointer; box-sizing: border-box;">
                            <option value="ibu">Ibu Hamil</option>
                            <option value="balita">Balita</option>
                            <option value="lansia">Lansia</option>
                        </select>
                    </div>

                    <!-- Anak ke -->
                    <div>
                        <label style="display: block; font-size: 11px; font-weight: 800; color: #0E766D; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.05em;">Anak Ke</label>
                        <input type="number" id="editAnakKe" min="1" placeholder="1" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e0ebe9; border-radius: 10px; font-size: 14px; font-family: inherit; outline: none; transition: border-color 0.2s; box-sizing: border-box;" onfocus="this.style.borderColor='#0E766D'" onblur="this.style.borderColor='#e0ebe9'" />
                    </div>

                    <!-- Alamat -->
                    <div style="grid-column: span 2;">
                        <label style="display: block; font-size: 11px; font-weight: 800; color: #0E766D; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.05em;">Alamat <span style="color:#ef4444">*</span></label>
                        <textarea id="editAlamat" placeholder="Jl. ..." rows="2" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e0ebe9; border-radius: 10px; font-size: 14px; font-family: inherit; outline: none; resize: vertical; transition: border-color 0.2s; box-sizing: border-box;" onfocus="this.style.borderColor='#0E766D'" onblur="this.style.borderColor='#e0ebe9'"></textarea>
                    </div>

                    <!-- Dusun -->
                    <div>
                        <label style="display: block; font-size: 11px; font-weight: 800; color: #0E766D; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.05em;">Dusun <span style="color:#ef4444">*</span></label>
                        <input type="text" id="editDusun" placeholder="Nama dusun" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e0ebe9; border-radius: 10px; font-size: 14px; font-family: inherit; outline: none; transition: border-color 0.2s; box-sizing: border-box;" onfocus="this.style.borderColor='#0E766D'" onblur="this.style.borderColor='#e0ebe9'" />
                    </div>

                    <!-- Kecamatan -->
                    <div>
                        <label style="display: block; font-size: 11px; font-weight: 800; color: #0E766D; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.05em;">Kecamatan <span style="color:#ef4444">*</span></label>
                        <input type="text" id="editKecamatan" placeholder="Nama kecamatan" style="width: 100%; padding: 11px 14px; border: 1.5px solid #e0ebe9; border-radius: 10px; font-size: 14px; font-family: inherit; outline: none; transition: border-color 0.2s; box-sizing: border-box;" onfocus="this.style.borderColor='#0E766D'" onblur="this.style.borderColor='#e0ebe9'" />
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div style="padding: 18px 28px; border-top: 1px solid #e0ebe9; display: flex; gap: 12px; justify-content: flex-end; background: #f7f9f8;">
                <button onclick="closeEditModal()" style="padding: 11px 22px; border: 1.5px solid #c4d0ca; border-radius: 10px; background: #fff; font-size: 13px; font-weight: 700; color: #7a9186; cursor: pointer; font-family: inherit; transition: all 0.2s;" onmouseover="this.style.borderColor='#0E766D';this.style.color='#0E766D'" onmouseout="this.style.borderColor='#c4d0ca';this.style.color='#7a9186'">Batal</button>
                <button id="editSaveBtn" onclick="saveEdit()" style="padding: 11px 28px; border: none; border-radius: 10px; background: linear-gradient(135deg, #0E766D, #0A5C55); color: #fff; font-size: 13px; font-weight: 800; cursor: pointer; font-family: inherit; box-shadow: 0 4px 14px rgba(14,118,109,0.3); transition: all 0.2s; display: flex; align-items: center; gap: 8px;">
                    <i class="ti ti-device-floppy"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </div>

    <!-- POPUP PILIH KATEGORI -->
    <div class="hidden fixed inset-0 bg-black/45 z-[200] items-center justify-center backdrop-blur-[4px] animate-[fadeIn_0.2s_ease]" id="katOverlay" onclick="if(event.target===this) { this.classList.add('hidden'); this.classList.remove('flex'); }">
        <div class="bg-white rounded-[20px] p-9 pb-10 w-full max-w-[480px] shadow-[0_24px_64px_rgba(0,0,0,0.22)] animate-[slideUp_0.28s_cubic-bezier(0.22,0.68,0,1.2)] relative" style="font-family: inherit;">
            <button class="absolute top-4 right-[18px] bg-none border-none text-[1.3rem] text-pos-gray-500 hover:text-pos-gray-900 transition-colors leading-none cursor-pointer" onclick="document.getElementById('katOverlay').classList.add('hidden'); document.getElementById('katOverlay').classList.remove('flex');" style="background: none; border: none;">✕</button>
            <h2 class="text-[1.1rem] font-extrabold text-pos-gray-900 mb-[6px] text-center">Pilih Kategori Pasien</h2>
            <p class="text-[0.84rem] text-pos-gray-500 text-center mb-7">Pilih kategori untuk melanjutkan pendaftaran</p>
            <div class="flex gap-[14px] justify-center">
                <button onclick="openForm('ibu')" class="flex-1 max-w-[130px] bg-pos-gray-50 border-2 border-pos-gray-100 rounded-[16px] p-[22px_14px_18px] flex flex-col items-center gap-[10px] cursor-pointer no-underline transition-all hover:border-pos-teal hover:bg-white hover:-translate-y-1 hover:shadow-[0_10px_28px_rgba(14,118,109,0.15)] group" style="background: var(--gray-50); border: 2px solid var(--gray-100);">
                    <div class="w-[52px] h-[52px] rounded-[14px] bg-[#d4eeeb] flex items-center justify-center text-[1.6rem] transition-colors group-hover:bg-pos-teal">
                        <span class="group-hover:brightness-[10]">🤰</span>
                    </div>
                    <div class="text-[0.88rem] font-bold text-pos-gray-900 text-center">Ibu Hamil</div>
                </button>
                <button onclick="openForm('balita')" class="flex-1 max-w-[130px] bg-pos-gray-50 border-2 border-pos-gray-100 rounded-[16px] p-[22px_14px_18px] flex flex-col items-center gap-[10px] cursor-pointer no-underline transition-all hover:border-pos-teal hover:bg-white hover:-translate-y-1 hover:shadow-[0_10px_28px_rgba(14,118,109,0.15)] group" style="background: var(--gray-50); border: 2px solid var(--gray-100);">
                    <div class="w-[52px] h-[52px] rounded-[14px] bg-[#d4eeeb] flex items-center justify-center text-[1.6rem] transition-colors group-hover:bg-pos-teal">
                        <span class="group-hover:brightness-[10]">👶</span>
                    </div>
                    <div class="text-[0.88rem] font-bold text-pos-gray-900 text-center">Balita</div>
                </button>
            </div>
        </div>
    </div>

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
                            <tbody id="printTableBody">
                                @foreach($patients as $index => $d)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $d->nama }}</td>
                                    <td>{{ $d->nik }}</td>
                                    <td>{{ $d->noHp ?? '-' }}</td>
                                    <td>{{ $d->alamat }}</td>
                                    <td>{{ $d->dusun ?? '-' }}</td>
                                </tr>
                                @endforeach
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

@endsection

@section('scripts')
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

        // Dynamic patient data loaded from database
        let data = @json($patients);
        let filtered = [...data];
        let currentPage = 1;
        let pageSize = 5;
        let currentKat = '';
        let currentSort = '';

        window.toggleDD = function(id) {
            const dd = document.getElementById(id).querySelector('div:last-child');
            const svg = document.getElementById(id).querySelector('svg');
            const isHidden = dd.classList.contains('hidden');
            document.querySelectorAll('[id^="dd"] div:last-child').forEach(d => d.classList.add('hidden'));
            document.querySelectorAll('[id^="dd"] svg').forEach(s => s.classList.remove('rotate-180'));
            if(isHidden) { dd.classList.remove('hidden'); svg.classList.add('rotate-180'); }
        };

        window.pickKat = function(el) {
            currentKat = el.dataset.val;
            document.getElementById('ddKatLabel').textContent = el.dataset.label;
            document.querySelectorAll('#ddKategori div:last-child div').forEach(d => {
                d.classList.remove('active', 'bg-pos-green-pale', 'text-pos-green-dark', 'font-bold');
            });
            el.classList.add('active', 'bg-pos-green-pale', 'text-pos-green-dark', 'font-bold');
            
            // Close dropdown
            document.querySelectorAll('[id^="dd"] div:last-child').forEach(d => d.classList.add('hidden'));
            document.querySelectorAll('[id^="dd"] svg').forEach(s => s.classList.remove('rotate-180'));
        };

        window.pickSort = function(el) {
            currentSort = el.dataset.val;
            document.getElementById('ddSortLabel').textContent = el.dataset.label;
            document.querySelectorAll('#ddSort div:last-child div').forEach(d => {
                d.classList.remove('active', 'bg-pos-green-pale', 'text-pos-green-dark', 'font-bold');
            });
            el.classList.add('active', 'bg-pos-green-pale', 'text-pos-green-dark', 'font-bold');
            
            // Close dropdown
            document.querySelectorAll('[id^="dd"] div:last-child').forEach(d => d.classList.add('hidden'));
            document.querySelectorAll('[id^="dd"] svg').forEach(s => s.classList.remove('rotate-180'));
        };

        window.onclick = function(event) {
            if (!event.target.closest('.select-none')) {
                document.querySelectorAll('[id^="dd"] div:last-child').forEach(d => d.classList.add('hidden'));
                document.querySelectorAll('[id^="dd"] svg').forEach(s => s.classList.remove('rotate-180'));
            }
        };

        window.openForm = function(kat) {
            localStorage.removeItem('currentPatient');
            localStorage.removeItem('langkah1Data');
            localStorage.removeItem('langkah2Data');
            localStorage.removeItem('langkah3Data');
            localStorage.setItem('selectedCategory', kat);
            window.location.href = '/langkah-1';
        };

        window.applyFilter = function() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            filtered = data.filter(d => {
                const matchKat = !currentKat || d.kategori === currentKat;
                const matchSearch = !search || 
                    (d.nama && d.nama.toLowerCase().includes(search)) || 
                    (d.nik && d.nik.includes(search)) || 
                    (d.alamat && d.alamat.toLowerCase().includes(search)) || 
                    (d.kecamatan && d.kecamatan.toLowerCase().includes(search));
                return matchKat && matchSearch;
            });

            if (currentSort === 'nama')           filtered.sort((a,b) => a.nama.localeCompare(b.nama));
            else if (currentSort === 'nik')       filtered.sort((a,b) => a.nik.localeCompare(b.nik));
            else if (currentSort === 'terbaru')   filtered.sort((a,b) => b.id - a.id);
            else if (currentSort === 'terlama')   filtered.sort((a,b) => a.id - b.id);
            else                                  filtered.sort((a,b) => b.id - a.id);

            // Tampilkan tombol Reset jika ada filter aktif
            const hasFilter = currentKat || currentSort || search;
            const btnReset = document.getElementById('btnReset');
            if (hasFilter) {
                btnReset.classList.remove('hidden');
            } else {
                btnReset.classList.add('hidden');
            }
            
            currentPage = 1;
            renderTable();
            renderPrintTable();
        };

        window.resetFilter = function() {
            document.getElementById('searchInput').value = '';
            currentKat = '';
            currentSort = '';
            
            document.getElementById('ddKatLabel').textContent = 'Semua Kategori';
            document.querySelectorAll('#ddKategori div:last-child div').forEach(d => {
                d.classList.remove('active', 'bg-pos-green-pale', 'text-pos-green-dark', 'font-bold');
            });
            document.querySelector('#ddKategori div:last-child div[data-val=""]').classList.add('active', 'bg-pos-green-pale', 'text-pos-green-dark', 'font-bold');
            
            document.getElementById('ddSortLabel').textContent = 'Urutkan';
            document.querySelectorAll('#ddSort div:last-child div').forEach(d => {
                d.classList.remove('active', 'bg-pos-green-pale', 'text-pos-green-dark', 'font-bold');
            });
            document.querySelector('#ddSort div:last-child div[data-val=""]').classList.add('active', 'bg-pos-green-pale', 'text-pos-green-dark', 'font-bold');
            
            applyFilter();
        };

        window.changeLimit = function(limit) {
            pageSize = parseInt(limit);
            currentPage = 1;
            renderTable();
        };

        function renderTable() {
            const tbody = document.getElementById('tableBody');
            const totalItems = filtered.length;
            const totalPages = Math.ceil(totalItems / pageSize) || 1;

            if (currentPage > totalPages) currentPage = totalPages;
            if (currentPage < 1) currentPage = 1;

            const startIndex = (currentPage - 1) * pageSize;
            const endIndex = Math.min(startIndex + pageSize, totalItems);
            const paginated = filtered.slice(startIndex, endIndex);

            // update infoCount
            const infoCount = document.getElementById('infoCount');
            if (infoCount) {
                if (totalItems === 0) {
                    infoCount.textContent = 'Menampilkan 0 data';
                } else {
                    infoCount.textContent = `Menampilkan ${startIndex + 1}–${endIndex} dari ${totalItems} data`;
                }
            }

            if (totalItems === 0) {
                tbody.innerHTML = '<tr><td colspan="6" style="text-align: center; padding: 40px; color: var(--gray-500);"><i class="ti ti-database-off" style="font-size: 2rem; display: block; margin-bottom: 8px;"></i>Tidak ada data pasien ditemukan</td></tr>';
                renderPagination(totalPages);
                return;
            }

            tbody.innerHTML = paginated.map((d, i) => {
                const kategoriLabel = d.kategori === 'ibu' ? 'Ibu Hamil' : (d.kategori === 'balita' ? 'Balita' : 'Lansia');
                const rowNo = startIndex + i + 1;
                return `
                    <tr onclick="lihat(${d.id})" style="cursor: pointer;">
                        <td>${rowNo}</td>
                        <td style="font-weight: 700; color: var(--gray-900);">${d.nama}</td>
                        <td style="font-weight: 700; color: var(--gray-900);">${d.nik}</td>
                        <td>${d.alamat || '-'}</td>
                        <td>
                            <span class="badge-kategori ${d.kategori}" style="padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; background: ${d.kategori === 'ibu' ? '#e4f7f5' : '#e8f5ee'}; color: ${d.kategori === 'ibu' ? '#1e9e8c' : '#1a5c38'};">
                                ${kategoriLabel}
                            </span>
                        </td>
                        <td onclick="event.stopPropagation()">
                            <div class="action-btns">
                                <button class="btn-icon btn-view" onclick="lihat(${d.id})" title="Lihat"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" /><circle cx="12" cy="12" r="3" /></svg></button>
                                <button class="btn-icon btn-block" onclick="hapus(${d.id})" title="Hapus" style="color: #ef4444;"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10" /><line x1="4.93" y1="4.93" x2="19.07" y2="19.07" /></svg></button>
                                <button class="btn-icon btn-edit" onclick="edit(${d.id})" title="Edit"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" /><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" /></svg></button>
                            </div>
                        </td>
                    </tr>
                `;
            }).join('');

            renderPagination(totalPages);
        }

        function renderPagination(totalPages) {
            const paginationWrap = document.getElementById('paginationWrap');
            let html = `<button class="page-btn arrow ${currentPage === 1 ? 'disabled' : ''}" onclick="changePage(${currentPage - 1})" style="${currentPage === 1 ? 'opacity: 0.5; pointer-events: none;' : ''}">&#8249;</button>`;
            
            for (let i = 1; i <= totalPages; i++) {
                if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
                    html += `<button class="page-btn ${currentPage === i ? 'active' : ''}" onclick="changePage(${i})">${i}</button>`;
                } else if (i === 2 || i === totalPages - 1) {
                    html += `<span class="page-dots">...</span>`;
                }
            }

            html += `<button class="page-btn arrow ${currentPage === totalPages ? 'disabled' : ''}" onclick="changePage(${currentPage + 1})" style="${currentPage === totalPages ? 'opacity: 0.5; pointer-events: none;' : ''}">&#8250;</button>`;
            paginationWrap.innerHTML = html;
        }

        function changePage(p) {
            currentPage = p;
            renderTable();
        }

        function renderPrintTable() {
            const tbody = document.getElementById('printTableBody');
            tbody.innerHTML = filtered.map((d, i) => {
                return `
                    <tr>
                        <td>${i + 1}</td>
                        <td>${d.nama}</td>
                        <td>${d.nik}</td>
                        <td>${d.noHp || '-'}</td>
                        <td>${d.alamat || '-'}</td>
                        <td>${d.dusun || '-'}</td>
                    </tr>
                `;
            }).join('');
        }

        function edit(id) {
            window.location.href = `/patients/${id}/edit`;
        }


        async function hapus(id) {
            if(!confirm("Apakah Anda yakin ingin menghapus data pasien ini?")) return;
            
            try {
                const response = await fetch(`/patients/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                });
                if (response.ok) {
                    alert("Data pasien berhasil dihapus.");
                    location.reload();
                } else {
                    alert("Gagal menghapus data pasien.");
                }
            } catch (err) {
                console.error(err);
                alert("Terjadi kesalahan koneksi.");
            }
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
                <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding-top: 8px; padding-bottom: 16px; margin-bottom: 4px;">
                    <img src="/image/logo.png" style="width: 64px; height: 64px; object-fit: contain;" alt="Logo POSYANDU" />
                </div>
            `;
            
            // 2. Informasi Dasar (lengkap sesuai form pendaftaran)
            const kategoriLabel = detail.kategori === 'ibu' ? 'Ibu Hamil' : (detail.kategori === 'balita' ? 'Balita' : 'Lansia');
            const kategoriColor = detail.kategori === 'ibu' ? '#1e9e8c' : '#1a5c38';
            const kategoriLightBg = detail.kategori === 'ibu' ? '#e4f7f5' : '#e8f5ee';

            function infoRow(icon, label, value) {
                return `
                    <div style="margin-bottom: 10px; text-align: left;">
                        <label style="display: flex; align-items: center; gap: 7px; font-size: 10px; font-weight: 800; color: var(--gray-500); margin-bottom: 5px; text-transform: uppercase; letter-spacing: 0.05em;">
                            <i class="ti ${icon}" style="font-size: 12px; color: var(--teal);"></i>
                            <span>${label}</span>
                        </label>
                        <div style="width: 100%; padding: 9px 13px; border: 1px solid var(--gray-100); border-radius: 8px; font-size: 13px; font-weight: 600; color: var(--gray-900); background: var(--gray-50);">
                            ${value || '<span style="color:#aaa;font-style:italic;font-weight:400;">—</span>'}
                        </div>
                    </div>`;
            }

            let infoDasarHtml = `
                <div style="background: #fff; border-radius: var(--radius); padding: 16px; border: 1px solid var(--gray-100); box-shadow: var(--shadow); margin-bottom: 12px;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 14px;">
                        <p style="font-size: 11px; font-weight: 800; color: var(--gray-900); text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">Informasi Pasien</p>
                        <span style="padding: 3px 10px; border-radius: 20px; font-size: 10px; font-weight: 800; background: ${kategoriLightBg}; color: ${kategoriColor};">${kategoriLabel}</span>
                    </div>

                    ${infoRow('ti-user', detail.kategori === 'ibu' ? 'Nama Ibu' : 'Nama Balita', `<span style="font-weight:700;">${detail.nama}</span>`)}
                    ${infoRow('ti-id-badge', 'NIK', detail.nik)}
                    ${infoRow('ti-phone', 'No. HP', detail.noHp || detail.hp)}
                    ${infoRow('ti-calendar', 'Tanggal Lahir', detail.tglLahir ? new Date(detail.tglLahir).toLocaleDateString('id-ID', {day:'2-digit',month:'long',year:'numeric'}) : null)}
                    ${infoRow('ti-map-pin', 'Alamat', detail.alamat)}
                    ${infoRow('ti-home', 'Dusun / RT / RW', detail.dusun)}
                    ${infoRow('ti-building-community', 'Kecamatan', detail.kecamatan)}
                    ${infoRow('ti-baby-carriage', 'Anak Ke', detail.anakKe)}
                    ${detail.usiaHamil ? infoRow('ti-heart', 'Usia Kehamilan (saat daftar)', detail.usiaHamil + ' minggu') : ''}
                    ${detail.tglKunjungan ? infoRow('ti-calendar-event', 'Tanggal Kunjungan', new Date(detail.tglKunjungan).toLocaleDateString('id-ID', {day:'2-digit',month:'long',year:'numeric'})) : ''}
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
                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; padding-top: 8px; padding-bottom: 4px; text-align: left;">
                        <div style="background: var(--gray-50); border: 1px solid var(--gray-100); border-radius: 8px; padding: 10px;">
                            <span style="display: block; font-size: 9px; font-weight: 800; color: var(--gray-500); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">${detail.kategori === 'ibu' ? 'Usia Kehamilan' : 'Usia Balita'}</span>
                            <span style="font-size: 12px; font-weight: 800; color: var(--gray-900);">${detail.kategori === 'ibu' ? (h.usia_hamil || '-') + ' minggu' : (h.usia_balita || '-') + ' bulan'}</span>
                        </div>
                        <div style="background: var(--gray-50); border: 1px solid var(--gray-100); border-radius: 8px; padding: 10px;">
                            <span style="display: block; font-size: 9px; font-weight: 800; color: var(--gray-500); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">Berat Badan</span>
                            <span style="font-size: 12px; font-weight: 800; color: var(--gray-900);">${h.berat_badan || '-'} kg</span>
                        </div>
                        <div style="background: var(--gray-50); border: 1px solid var(--gray-100); border-radius: 8px; padding: 10px; grid-column: span 2;">
                            <span style="display: block; font-size: 9px; font-weight: 800; color: var(--gray-500); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">Tinggi Badan</span>
                            <span style="font-size: 12px; font-weight: 800; color: var(--gray-900);">${h.tinggi_badan || '-'} cm</span>
                        </div>
                    </div>
                `;
                
                // Langkah 2: Pengukuran Tambahan
                if (detail.kategori === 'ibu') {
                    step2Content = `
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; padding-top: 8px; padding-bottom: 4px; text-align: left;">
                            <div style="background: var(--gray-50); border: 1px solid var(--gray-100); border-radius: 8px; padding: 10px;">
                                <span style="display: block; font-size: 9px; font-weight: 800; color: var(--gray-500); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">LILA</span>
                                <span style="font-size: 12px; font-weight: 800; color: var(--gray-900);">${h.lila || '-'} cm</span>
                            </div>
                            <div style="background: var(--gray-50); border: 1px solid var(--gray-100); border-radius: 8px; padding: 10px;">
                                <span style="display: block; font-size: 9px; font-weight: 800; color: var(--gray-500); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">Kadar Hb</span>
                                <span style="font-size: 12px; font-weight: 800; color: var(--gray-900);">${h.hb || '-'} g/dL</span>
                            </div>
                            <div style="background: var(--gray-50); border: 1px solid var(--gray-100); border-radius: 8px; padding: 10px; grid-column: span 2;">
                                <span style="display: block; font-size: 9px; font-weight: 800; color: var(--gray-500); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">Tekanan Darah</span>
                                <span style="font-size: 12px; font-weight: 800; color: var(--gray-900);">${h.tekanan_darah || '-'} mmHg</span>
                            </div>
                        </div>
                    `;
                } else {
                    step2Content = `
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; padding-top: 8px; padding-bottom: 4px; text-align: left;">
                            <div style="background: var(--gray-50); border: 1px solid var(--gray-100); border-radius: 8px; padding: 10px; grid-column: span 2;">
                                <span style="display: block; font-size: 9px; font-weight: 800; color: var(--gray-500); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">Lingkar Kepala</span>
                                <span style="font-size: 12px; font-weight: 800; color: var(--gray-900);">${h.lingkar_kepala || '-'} cm</span>
                            </div>
                            <div style="background: var(--gray-50); border: 1px solid var(--gray-100); border-radius: 8px; padding: 10px; grid-column: span 2;">
                                <span style="display: block; font-size: 9px; font-weight: 800; color: var(--gray-500); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">Status Imunisasi</span>
                                <span style="font-size: 12px; font-weight: 800; color: var(--gray-900); text-transform: uppercase;">${h.imunisasi ? h.imunisasi.replace('_', ' ') : '-'}</span>
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
                
                let qHtml = '<div style="display: flex; flex-direction: column; gap: 8px; padding-top: 8px; padding-bottom: 4px; text-align: left;">';
                if (h.jawaban_skrining && Object.keys(h.jawaban_skrining).length > 0) {
                    Object.entries(h.jawaban_skrining).forEach(([key, val]) => {
                        const qText = qTexts[key] || key;
                        const isYa = val === 'ya';
                        qHtml += `
                            <div style="display: flex; align-items: start; justify-content: space-between; gap: 12px; font-size: 11px; border-bottom: 1px solid var(--gray-50); padding-bottom: 8px; margin-bottom: 8px;">
                                <span style="color: var(--gray-900); font-weight: 600; line-height: 1.5;">${qText}</span>
                                <span style="padding: 2px 6px; border-radius: 4px; font-size: 8px; font-weight: 800; text-transform: uppercase; flex-shrink: 0; background: ${isYa ? '#fee2e2' : '#e8f5ee'}; color: ${isYa ? '#ef4444' : '#1a5c38'};">${val.toUpperCase()}</span>
                            </div>
                        `;
                    });
                } else {
                    qHtml += '<p style="font-size: 11px; color: var(--gray-500); font-style: italic;">Tidak ada data kuesioner</p>';
                }
                qHtml += '</div>';
                step3Content = qHtml;
                
                // Langkah 4: Hasil & Tindak Lanjut
                step4Content = `
                    <div style="display: flex; flex-direction: column; gap: 10px; padding-top: 8px; padding-bottom: 4px; text-align: left;">
                        <div style="display: flex; justify-content: space-between; align-items: center; background: var(--gray-50); border: 1px solid var(--gray-100); border-radius: 8px; padding: 10px;">
                            <span style="font-size: 10px; font-weight: 800; color: var(--gray-500); text-transform: uppercase; letter-spacing: 0.05em;">Level Risiko</span>
                            <span style="padding: 2px 8px; border-radius: 4px; font-size: 8.5px; font-weight: 800; text-transform: uppercase; background: ${h.level_risiko === 'rendah' ? '#e8f5ee' : (h.level_risiko === 'darurat' ? '#ef4444' : '#fff3cd')}; color: ${h.level_risiko === 'rendah' ? '#1a5c38' : (h.level_risiko === 'darurat' ? '#ffffff' : '#856404')};">
                                ${h.level_risiko || '-'}
                            </span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center; background: var(--gray-50); border: 1px solid var(--gray-100); border-radius: 8px; padding: 10px;">
                            <span style="font-size: 10px; font-weight: 800; color: var(--gray-500); text-transform: uppercase; letter-spacing: 0.05em;">Skor YA</span>
                            <span style="font-size: 12px; font-weight: 800; color: var(--gray-900);">${h.skor_ya || 0} Jawaban YA</span>
                        </div>
                        <div style="background: var(--gray-50); border: 1px solid var(--gray-100); border-radius: 8px; padding: 10px;">
                            <span style="display: block; font-size: 9px; font-weight: 800; color: var(--gray-500); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px;">Tindak Lanjut</span>
                            <div style="display: flex; flex-direction: column; gap: 6px;">
                                ${h.tindak_lanjut && h.tindak_lanjut.length > 0 
                                    ? h.tindak_lanjut.map(tl => `
                                        <div style="display: flex; align-items: start; gap: 6px; font-size: 11px; color: var(--gray-900);">
                                            <i class="ti ti-circle-check" style="color: var(--teal); font-size: 14px; flex-shrink: 0; margin-top: 2px;"></i>
                                            <span>${tl}</span>
                                        </div>
                                    `).join('')
                                    : '<p style="font-size: 11px; color: var(--gray-500); font-style: italic;">Tidak ada tindak lanjut</p>'
                                }
                            </div>
                        </div>
                        ${h.catatan ? `
                            <div style="background: var(--gray-50); border: 1px solid var(--gray-100); border-radius: 8px; padding: 10px;">
                                <span style="display: block; font-size: 9px; font-weight: 800; color: var(--gray-500); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px;">Catatan Petugas</span>
                                <p style="font-size: 11px; color: var(--gray-900); line-height: 1.5; margin: 0;">${h.catatan}</p>
                            </div>
                        ` : ''}
                    </div>
                `;
            } else {
                const noData = '<p style="font-size: 12px; color: var(--gray-500); font-style: italic; padding: 12px; text-align: center; margin: 0;">Belum ada rekam medis</p>';
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
                    <div style="background: #fff; border: 1px solid var(--gray-100); border-radius: var(--radius); overflow: hidden; margin-bottom: 10px; box-shadow: var(--shadow);">
                        <button style="width: 100%; display: flex; align-items: center; justify-content: space-between; padding: 14px; background: none; border: none; cursor: pointer; text-align: left;" onclick="toggleDetailStep(${step.num})">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <i class="ti ti-file-text" style="font-size: 18px; color: var(--teal);"></i>
                                <span style="font-size: 13px; font-weight: 700; color: var(--gray-900);">${step.title}</span>
                            </div>
                            <i class="ti ti-chevron-down" style="font-size: 15px; color: var(--gray-500); transition: transform 0.2s;" id="step-arrow-${step.num}"></i>
                        </button>
                        <div style="padding: 14px; border-top: 1px solid var(--gray-50); display: none;" id="step-content-${step.num}">
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
                        <div style="display: flex; gap: 12px; align-items: flex-end; margin-bottom: 14px; text-align: left;">
                            <div style="flex: 1;">
                                <label style="display: flex; align-items: center; gap: 6px; font-size: 9px; font-weight: 800; color: var(--gray-500); margin-bottom: 4px; text-transform: uppercase; letter-spacing: 0.05em;">
                                    <i class="ti ti-calendar" style="font-size: 12px; color: var(--teal);"></i>
                                    <span>Tanggal Riwayat Pemeriksaan</span>
                                </label>
                                <div style="width: 100%; padding: 10px; border: 1px solid var(--gray-100); border-radius: 8px; background: var(--gray-50); font-size: 12px; font-weight: 800; color: var(--gray-900); display: flex; align-items: center; gap: 8px;">
                                    <span>${dateFormatted}</span>
                                </div>
                            </div>
                            <div style="flex: 1;">
                                <label style="display: flex; align-items: center; gap: 6px; font-size: 9px; font-weight: 800; color: var(--gray-500); margin-bottom: 4px; text-transform: uppercase; letter-spacing: 0.05em;">
                                    <i class="ti ti-pointer" style="font-size: 12px; color: var(--teal);"></i>
                                    <span>Aksi</span>
                                </label>
                                <a href="/riwayat?id=${detail.id}&pemeriksaan_id=${pemeriksaan.id}" style="width: 100%; padding: 10px; border: 1px solid var(--gray-100); background: #fff; color: var(--gray-900); border-radius: 8px; font-size: 11px; font-weight: 800; text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 4px; box-shadow: var(--shadow); transition: all 0.2s; box-sizing: border-box;" onmouseover="this.style.borderColor='var(--teal)'; this.style.backgroundColor='var(--gray-50)'; this.style.color='var(--teal)'" onmouseout="this.style.borderColor='var(--gray-100)'; this.style.backgroundColor='#fff'; this.style.color='var(--gray-900)'">
                                    <i class="ti ti-external-link" style="font-size: 12px;"></i>
                                    <span>Lihat Detail</span>
                                </a>
                            </div>
                        </div>
                    `;
                });
            } else {
                riwayatRowsHtml = '<p style="font-size: 12px; color: var(--gray-500); font-style: italic; padding: 8px 0; text-align: center; margin: 0;">Belum ada riwayat pemeriksaan.</p>';
            }
            
            let riwayatCardHtml = `
                <div style="background: #fff; border-radius: var(--radius); padding: 16px; border: 1px solid var(--gray-100); box-shadow: var(--shadow); margin-top: 6px;">
                    <p style="font-size: 11px; font-weight: 800; color: var(--gray-900); margin-bottom: 14px; text-transform: uppercase; letter-spacing: 0.05em; text-align: left;">Riwayat Pemeriksaan</p>
                    <div style="display: flex; flex-direction: column;">
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
            const isHidden = content.style.display === 'none' || content.style.display === '';
            
            for (let i = 1; i <= 4; i++) {
                const c = document.getElementById(`step-content-${i}`);
                const a = document.getElementById(`step-arrow-${i}`);
                if (c && a) {
                    c.style.display = 'none';
                    a.classList.remove('rotate-180');
                }
            }
            
            if (isHidden) {
                content.style.display = 'block';
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

            body.innerHTML = '<div style="padding: 32px; text-align: center; color: var(--gray-500);"><i class="ti ti-loader animate-spin" style="font-size: 24px;"></i><p style="margin-top: 8px;">Mengambil riwayat medis...</p></div>';
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
                body.innerHTML = '<div style="padding: 32px; text-align: center; color: #ef4444;"><i class="ti ti-alert-triangle" style="font-size: 24px;"></i><p style="margin-top: 8px; font-weight: 700;">Gagal memuat data</p></div>';
            }
        }

        function toggleAcc(id) {
            const el = document.getElementById(id);
            const body = el.querySelector('div:last-child');
            const arrow = el.querySelector('i.ti-chevron-down');
            const isHidden = body.style.display === 'none';
            
            if (isHidden) {
                body.style.display = 'block';
                arrow.classList.add('rotate-180');
            } else {
                body.style.display = 'none';
                arrow.classList.remove('rotate-180');
            }
        }

        function closeDetailPanel() {
            const panel = document.getElementById('detailPanel');
            panel.classList.add('translate-x-full');
            setTimeout(() => document.getElementById('detailOverlay').classList.add('hidden'), 300);
        }

        // Close on overlay click
        function handleOverlayClick(e) {
            if (e.target.id === 'detailOverlay') closeDetailPanel();
        }

        // Initial table load
        document.addEventListener('DOMContentLoaded', () => {
            renderTable();
        });
    </script>
    <!-- ══ DETAIL OVERLAY & SIDE-PANEL ══ -->
    <div id="detailOverlay" class="hidden" style="position: fixed; inset: 0; background: rgba(0,0,0,0.4); z-index: 200; backdrop-filter: blur(4px); transition: opacity 0.3s;" onclick="handleOverlayClick(event)">
        <div id="detailPanel" class="translate-x-full" style="position: fixed; right: 0; top: 0; bottom: 0; width: 420px; background: #f7f9f8; box-shadow: -4px 0 24px rgba(0,0,0,0.15); z-index: 210; transition: transform 0.3s ease; display: flex; flex-direction: column;">
            <!-- Body -->
            <div style="flex: 1; overflow-y: auto; padding: 20px;" id="dpBody">
                <!-- Dynamic Content -->
            </div>
            
            <!-- Sticky Footer -->
            <div style="position: sticky; bottom: 0; background: #fff; border-top: 1px solid var(--gray-100); padding: 14px 20px;">
                <button style="width: 100%; padding: 14px; border: none; background: #1e2a6e; color: #fff; border-radius: 50px; font-size: 14px; font-weight: 700; cursor: pointer; transition: background 0.2s;" onmouseover="this.style.background='#162060'" onmouseout="this.style.background='#1e2a6e'" onclick="closeDetailPanel()">Kembali</button>
            </div>
        </div>
    </div>
@endsection
