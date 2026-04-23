<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name','KostKu') }} — Admin</title>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/kostku.css') }}">

    @stack('styles')
</head>
<body>

<!-- Logout Modal -->
<div class="modal-overlay" id="logoutModal">
    <div class="modal-box">
        <div class="modal-icon">🚪</div>
        <div class="modal-title">Yakin ingin logout?</div>
        <div class="modal-sub">Sesi kamu akan berakhir dan perlu login ulang untuk mengakses dashboard.</div>
        <div class="modal-btns">
            <button class="btn btn-outline" onclick="closeLogout()">Batal</button>
            <button class="btn btn-danger" onclick="doLogout()">Ya, Logout</button>
        </div>
    </div>
</div>

@auth
<form id="logoutForm" method="POST" action="{{ route('logout') }}" style="display:none">@csrf</form>
@endauth

<!-- TOP NAVBAR -->
<nav class="topnav" id="topnav">
    <div class="topnav-inner">

        <!-- Brand -->
        <a href="{{ route('home') }}" class="topnav-brand">
            <div class="topnav-brand-icon">🏠</div>
            <span class="topnav-brand-name">KostKu</span>
        </a>

        <!-- Desktop Menu -->
        <div class="topnav-menu" id="topnavMenu">
            <div class="topnav-section-label">Menu Utama</div>
            <a class="topnav-item {{ request()->is('home') ? 'active' : '' }}" href="{{ route('home') }}">
                <span class="topnav-item-icon">🏠</span> Dashboard
            </a>
            <a class="topnav-item {{ request()->is('kamar*') ? 'active' : '' }}" href="{{ route('kamar') }}">
                <span class="topnav-item-icon">🚪</span> Kamar
            </a>
            <a class="topnav-item {{ request()->is('penghuni*') ? 'active' : '' }}" href="{{ route('penghuni') }}">
                <span class="topnav-item-icon">👤</span> Penghuni
            </a>
            <a class="topnav-item {{ request()->is('sewa*') ? 'active' : '' }}" href="{{ url('/sewa') }}">
                <span class="topnav-item-icon">📝</span> Sewa
            </a>

            <div class="topnav-divider-v"></div>
            <div class="topnav-section-label">Keuangan</div>

            <a class="topnav-item {{ request()->is('pemasukan*') ? 'active' : '' }}" href="{{ url('/pemasukan') }}">
                <span class="topnav-item-icon">💰</span> Pemasukan
            </a>
            <a class="topnav-item {{ request()->is('pengeluaran*') ? 'active' : '' }}" href="{{ url('/pengeluaran') }}">
                <span class="topnav-item-icon">💸</span> Pengeluaran
            </a>
            <a class="topnav-item {{ request()->is('laporan*') ? 'active' : '' }}" href="{{ url('/laporan') }}">
                <span class="topnav-item-icon">📄</span> Laporan
            </a>

            <div class="topnav-divider-v"></div>

            <!-- Logout -->
            <button class="topnav-logout" onclick="openLogout()">
                <span style="font-size:14px">🚪</span> Logout
            </button>
        </div>

        <!-- Mobile Burger -->
        <button class="burger" onclick="toggleMobileMenu()" aria-label="Menu" id="burgerBtn">
            <span></span><span></span><span></span>
        </button>

    </div>

    <!-- Mobile Dropdown Menu -->
    <div class="topnav-mobile-menu" id="mobileMenu">
        <a class="topnav-mobile-item {{ request()->is('home') ? 'active' : '' }}" href="{{ route('home') }}">
            <span>🏠</span> Dashboard
        </a>
        <a class="topnav-mobile-item {{ request()->is('kamar*') ? 'active' : '' }}" href="{{ route('kamar') }}">
            <span>🚪</span> Kamar
        </a>
        <a class="topnav-mobile-item {{ request()->is('penghuni*') ? 'active' : '' }}" href="{{ route('penghuni') }}">
            <span>👤</span> Penghuni
        </a>
        <a class="topnav-mobile-item {{ request()->is('sewa*') ? 'active' : '' }}" href="{{ url('/sewa') }}">
            <span>📝</span> Sewa
        </a>
        <div class="topnav-mobile-divider"></div>
        <a class="topnav-mobile-item {{ request()->is('pemasukan*') ? 'active' : '' }}" href="{{ url('/pemasukan') }}">
            <span>💰</span> Pemasukan
        </a>
        <a class="topnav-mobile-item {{ request()->is('pengeluaran*') ? 'active' : '' }}" href="{{ url('/pengeluaran') }}">
            <span>💸</span> Pengeluaran
        </a>
        <a class="topnav-mobile-item {{ request()->is('laporan*') ? 'active' : '' }}" href="{{ url('/laporan') }}">
            <span>📄</span> Laporan
        </a>
        <div class="topnav-mobile-divider"></div>
        <button class="topnav-mobile-item topnav-mobile-logout" onclick="openLogout()">
            <span>🚪</span> Logout
        </button>
    </div>
</nav>

<!-- MAIN CONTENT -->
<div class="main-wrap">
    <div class="main-content">
        @yield('content')
    </div>
</div>

<div id="modal-root"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function toggleMobileMenu() {
    const menu = document.getElementById('mobileMenu');
    const btn  = document.getElementById('burgerBtn');
    menu.classList.toggle('open');
    btn.classList.toggle('open');
}
function openLogout()  { document.getElementById('logoutModal').classList.add('show'); }
function closeLogout() { document.getElementById('logoutModal').classList.remove('show'); }
function doLogout() {
    const f = document.getElementById('logoutForm');
    if (f) f.submit(); else window.location.href = '/';
}
document.getElementById('logoutModal').addEventListener('click', function(e) {
    if (e.target === this) closeLogout();
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') { closeLogout(); document.getElementById('mobileMenu').classList.remove('open'); }
});
</script>
@stack('scripts')
</body>
</html>