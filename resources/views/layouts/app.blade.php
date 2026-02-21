<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name','KostKu Admin') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ─── DESIGN TOKENS ─────────────────────────── */
        :root {
            --ink:        #0f0e17;
            --ink-mid:    #1a1825;
            --ink-soft:   #252333;
            --paper:      #fffffe;
            --surface:    #f5f5f7;
            --muted:      #6b6882;
            --muted-lt:   #a7a9be;
            --accent:     #ff8906;
            --accent2:    #e53170;
            --green:      #3da35d;
            --blue:       #0ea5e9;
            --sidebar-w:  260px;
            --topbar-h:   0px;
        }

        * { margin:0; padding:0; box-sizing:border-box; }

        body {
            font-family: 'Sora', sans-serif;
            background: var(--surface);
            color: var(--ink);
            min-height: 100vh;
        }

        .layout-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* ─── SIDEBAR ────────────────────────────────── */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--ink);
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            z-index: 100;
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        /* Decorative glow blobs */
        .sidebar::before {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 200px; height: 200px;
            background: radial-gradient(circle, rgba(255,137,6,0.18) 0%, transparent 70%);
            pointer-events: none;
        }

        .sidebar::after {
            content: '';
            position: absolute;
            bottom: 80px; left: -40px;
            width: 160px; height: 160px;
            background: radial-gradient(circle, rgba(229,49,112,0.14) 0%, transparent 70%);
            pointer-events: none;
        }

        /* ── Logo ── */
        .logo-box {
            padding: 28px 24px 24px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            position: relative;
        }

        .logo-row {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-circle {
            width: 44px; height: 44px;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent2) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
            box-shadow: 0 4px 16px rgba(255,137,6,0.35);
        }

        .logo-text {
            display: flex;
            flex-direction: column;
        }

        .logo-name {
            font-size: 18px;
            font-weight: 800;
            color: var(--paper);
            letter-spacing: -0.5px;
            line-height: 1;
        }

        .logo-sub {
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--muted);
            margin-top: 3px;
            font-family: 'JetBrains Mono', monospace;
        }

        /* ── Nav Section Label ── */
        .nav-section {
            padding: 20px 24px 8px;
        }

        .nav-section-label {
            font-size: 9.5px;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--muted);
        }

        /* ── Menu Items ── */
        .nav-links {
            flex: 1;
            overflow-y: auto;
            padding: 8px 14px;
            scrollbar-width: none;
        }

        .nav-links::-webkit-scrollbar { display: none; }

        .menu-item {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 11px 14px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.18s ease;
            position: relative;
            margin-bottom: 2px;
            text-decoration: none;
            color: var(--muted-lt);
            font-size: 14px;
            font-weight: 500;
        }

        .menu-item:hover {
            background: rgba(255,255,255,0.06);
            color: var(--paper);
        }

        .menu-item.active {
            background: rgba(255,137,6,0.12);
            color: var(--accent);
        }

        .menu-item.active::before {
            content: '';
            position: absolute;
            left: 0; top: 20%; bottom: 20%;
            width: 3px;
            background: var(--accent);
            border-radius: 0 3px 3px 0;
        }

        .menu-icon {
            width: 32px; height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            flex-shrink: 0;
            background: rgba(255,255,255,0.05);
            transition: background 0.18s;
        }

        .menu-item:hover .menu-icon {
            background: rgba(255,255,255,0.1);
        }

        .menu-item.active .menu-icon {
            background: rgba(255,137,6,0.18);
        }

        /* Per-page accent colors when active */
        .menu-item.active[data-page="kamar"]       { color: #4ade80; background: rgba(74,222,128,0.10); }
        .menu-item.active[data-page="kamar"]::before    { background: #4ade80; }
        .menu-item.active[data-page="kamar"] .menu-icon { background: rgba(74,222,128,0.15); }

        .menu-item.active[data-page="penghuni"]    { color: #60a5fa; background: rgba(96,165,250,0.10); }
        .menu-item.active[data-page="penghuni"]::before  { background: #60a5fa; }
        .menu-item.active[data-page="penghuni"] .menu-icon { background: rgba(96,165,250,0.15); }

        .menu-item.active[data-page="sewa"]        { color: #c084fc; background: rgba(192,132,252,0.10); }
        .menu-item.active[data-page="sewa"]::before      { background: #c084fc; }
        .menu-item.active[data-page="sewa"] .menu-icon { background: rgba(192,132,252,0.15); }

        .menu-item.active[data-page="pemasukan"]   { color: #34d399; background: rgba(52,211,153,0.10); }
        .menu-item.active[data-page="pemasukan"]::before { background: #34d399; }
        .menu-item.active[data-page="pemasukan"] .menu-icon { background: rgba(52,211,153,0.15); }

        .menu-item.active[data-page="pengeluaran"] { color: var(--accent2); background: rgba(229,49,112,0.10); }
        .menu-item.active[data-page="pengeluaran"]::before { background: var(--accent2); }
        .menu-item.active[data-page="pengeluaran"] .menu-icon { background: rgba(229,49,112,0.15); }

        .menu-item.active[data-page="laporan"]     { color: #fbbf24; background: rgba(251,191,36,0.10); }
        .menu-item.active[data-page="laporan"]::before   { background: #fbbf24; }
        .menu-item.active[data-page="laporan"] .menu-icon { background: rgba(251,191,36,0.15); }

        /* ── Sidebar Footer ── */
        .sidebar-footer {
            padding: 16px 14px 20px;
            border-top: 1px solid rgba(255,255,255,0.06);
            position: relative;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 12px;
            background: rgba(229,49,112,0.12);
            border: 1px solid rgba(229,49,112,0.2);
            color: var(--accent2);
            border-radius: 10px;
            font-family: 'Sora', sans-serif;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.18s ease;
            text-decoration: none;
        }

        .logout-btn:hover {
            background: rgba(229,49,112,0.22);
            border-color: rgba(229,49,112,0.4);
            color: var(--accent2);
            transform: translateY(-1px);
        }

        /* ── Mobile Toggle ── */
        .mobile-topbar {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0;
            height: 56px;
            background: var(--ink);
            align-items: center;
            padding: 0 16px;
            gap: 14px;
            z-index: 99;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }

        .burger {
            background: none;
            border: none;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            gap: 5px;
            padding: 6px;
        }

        .burger span {
            display: block;
            width: 22px;
            height: 2px;
            background: var(--paper);
            border-radius: 2px;
            transition: 0.3s;
        }

        .mobile-logo {
            font-size: 16px;
            font-weight: 800;
            color: var(--paper);
        }

        /* ─── MAIN CONTENT ───────────────────────────── */
        .main-content {
            margin-left: var(--sidebar-w);
            flex: 1;
            padding: 32px 36px;
            min-height: 100vh;
        }

        /* ─── RESPONSIVE ─────────────────────────────── */
        @media (max-width: 900px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
                box-shadow: 8px 0 40px rgba(0,0,0,0.4);
            }

            .main-content {
                margin-left: 0;
                padding: 80px 20px 30px;
            }

            .mobile-topbar {
                display: flex;
            }
        }

        /* Overlay for mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(2px);
            z-index: 99;
        }

        .sidebar-overlay.active {
            display: block;
        }

        /* ─── MODAL GLOBAL FIX ───────────────────────── */
        /* Bootstrap .modal is position:fixed but gets offset by
           .main-content's margin-left. Force true full-viewport. */
        .modal {
            position: fixed !important;
            inset: 0 !important;
            left: 0 !important;
            margin: 0 !important;
            width: 100vw !important;
        }

        .modal-dialog {
            margin: auto !important;
        }

        .modal.show .modal-dialog {
            transform: none !important;
        }

        /* ─── GLOBAL PAGE STYLES ─────────────────────── */
        /* These propagate to all child pages for consistency */

        .page-header {
            position: relative;
            overflow: hidden;
            background: var(--ink);
            border-radius: 20px;
            padding: 32px 40px;
            margin-bottom: 28px;
            color: var(--paper);
        }

        .page-header::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 60% 80% at 90% 10%, rgba(255,137,6,0.22) 0%, transparent 60%),
                radial-gradient(ellipse 40% 60% at 5% 90%,  rgba(229,49,112,0.18) 0%, transparent 60%);
            pointer-events: none;
        }

        .page-header h1,
        .page-header h2 {
            position: relative;
            font-size: 28px;
            font-weight: 800;
            letter-spacing: -0.8px;
            line-height: 1.1;
        }

        .page-header p {
            position: relative;
            color: var(--muted-lt);
            font-size: 13px;
            margin-top: 6px;
        }

        /* Cards used across pages */
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 8px 24px rgba(0,0,0,0.06);
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid rgba(0,0,0,0.06);
            font-weight: 700;
            font-size: 15px;
            padding: 18px 24px;
        }

        /* Buttons */
        .btn-primary {
            background: var(--accent);
            border-color: var(--accent);
            font-weight: 600;
            border-radius: 10px;
        }

        .btn-primary:hover {
            background: #e67c00;
            border-color: #e67c00;
        }

        .btn-danger {
            border-radius: 10px;
        }

        /* Tables */
        .table > thead {
            background: var(--surface);
        }

        .table > thead th {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--muted);
            border-bottom: 1px solid rgba(0,0,0,0.08);
            padding: 14px 16px;
        }

        .table > tbody td {
            padding: 14px 16px;
            font-size: 14px;
            vertical-align: middle;
        }

        .badge {
            font-family: 'JetBrains Mono', monospace;
            font-size: 10px;
            font-weight: 500;
            border-radius: 6px;
            padding: 4px 10px;
        }
    </style>

    @stack('styles')
</head>
<body>

<!-- Mobile Top Bar -->
<div class="mobile-topbar">
    <button class="burger" onclick="toggleSidebar()" aria-label="Toggle menu">
        <span></span><span></span><span></span>
    </button>
    <div class="mobile-logo">🏠 KostKu</div>
</div>

<!-- Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<div class="layout-wrapper">

    <!-- ─── SIDEBAR ──────────────────────────────────── -->
    <div class="sidebar" id="sidebar">

        <!-- Logo -->
        <div class="logo-box">
            <div class="logo-row">
                <div class="logo-circle">🏠</div>
                <div class="logo-text">
                    <div class="logo-name">KostKu</div>
                    <div class="logo-sub">Admin Panel</div>
                </div>
            </div>
        </div>

        <!-- Nav -->
        <div class="nav-links">

            <div class="nav-section">
                <div class="nav-section-label">Menu Utama</div>
            </div>

            <a class="menu-item {{ request()->is('home') ? 'active' : '' }}" data-page="home"
               href="{{ route('home') }}">
                <div class="menu-icon">🏠</div>
                Dashboard
            </a>

            <a class="menu-item {{ request()->is('kamar*') ? 'active' : '' }}" data-page="kamar"
               href="{{ route('kamar') }}">
                <div class="menu-icon">🚪</div>
                Kamar
            </a>

            <a class="menu-item {{ request()->is('penghuni*') ? 'active' : '' }}" data-page="penghuni"
               href="{{ route('penghuni') }}">
                <div class="menu-icon">👤</div>
                Penghuni
            </a>

            <a class="menu-item {{ request()->is('sewa*') ? 'active' : '' }}" data-page="sewa"
               href="{{ url('/sewa') }}">
                <div class="menu-icon">📝</div>
                Sewa
            </a>

            <div class="nav-section">
                <div class="nav-section-label">Keuangan</div>
            </div>

            <a class="menu-item {{ request()->is('pemasukan*') ? 'active' : '' }}" data-page="pemasukan"
               href="{{ url('/pemasukan') }}">
                <div class="menu-icon">💰</div>
                Pemasukan
            </a>

            <a class="menu-item {{ request()->is('pengeluaran*') ? 'active' : '' }}" data-page="pengeluaran"
               href="{{ url('/pengeluaran') }}">
                <div class="menu-icon">💸</div>
                Pengeluaran
            </a>

            <a class="menu-item {{ request()->is('laporan*') ? 'active' : '' }}" data-page="laporan"
               href="{{ url('/laporan') }}">
                <div class="menu-icon">📄</div>
                Laporan
            </a>

        </div>

        <!-- Footer / Logout -->
        <div class="sidebar-footer">
            @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-btn" type="submit">
                    <span>⬡</span> Logout
                </button>
            </form>
            @else
            <a href="{{ url('/') }}" class="logout-btn">
                <span>⬡</span> Logout
            </a>
            @endauth
        </div>

    </div>

    <!-- ─── MAIN CONTENT ──────────────────────────────── -->
    <div class="main-content">
        @yield('content')
    </div>

</div>

{{-- ── MODALS TELEPORT TARGET ─────────────────────────
     Semua modal di-move ke sini (langsung child of <body>)
     supaya position:fixed benar-benar relative to viewport,
     tidak terpengaruh margin-left dari .main-content
--}}
<div id="modal-root"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('sidebarOverlay').classList.toggle('active');
    }

    // ── Modal Teleport ──────────────────────────────────
    // Pindahkan semua .modal yang ada di dalam .main-content
    // ke #modal-root yang langsung di bawah <body>,
    // sehingga position:fixed = full viewport tanpa offset sidebar.
    document.addEventListener('DOMContentLoaded', function () {
        const root   = document.getElementById('modal-root');
        const modals = document.querySelectorAll('.main-content .modal');
        modals.forEach(function (modal) {
            root.appendChild(modal);
        });
    });
</script>

@stack('scripts')
</body>
</html>