<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Admin Kos</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{
    margin:0;
    background:#f5f6fa;
}

.sidebar{
    width:240px;
    height:100vh;
    background:white;
    border-right:1px solid #e5e7eb;
    padding:15px;
    display:flex;
    flex-direction:column;
}

.brand{
    text-align:center;
    font-weight:700;
    letter-spacing:2px;
    margin:10px 0;
}

.menu{
    flex:1;
}

.sidebar a{
    display:flex;
    align-items:center;
    padding:10px 15px;
    border-radius:10px;
    color:#374151;
    text-decoration:none;
    margin-bottom:8px;
    transition:.2s;
}

.sidebar a:hover{
    background:#2563eb;
    color:white;
}

.logout{
    margin-top:auto;
}

.content{
    flex:1;
}

.header{
    height:60px;
    background:white;
    border-bottom:1px solid #e5e7eb;
    display:flex;
    align-items:center;
    justify-content:center;
    position:relative;
}

.header i{
    position:absolute;
    right:25px;
    font-size:28px;
    color:#2563eb;
}
</style>
</head>

<body>

<div class="d-flex">

<!-- SIDEBAR -->
<div class="sidebar">

    <div class="brand">ADMIN KOS</div>

    <hr>

    <div class="menu">

        <a href="/home">
            <i class="bi bi-house-door me-3"></i> Home
        </a>

        <a href="/penghuni">
            <i class="bi bi-people me-3"></i> Penghuni
        </a>

        <a href="/kamar">
            <i class="bi bi-door-open me-3"></i> Kamar
        </a>

        <a href="/sewa">
            <i class="bi bi-receipt me-3"></i> Sewa
        </a>

        <a href="/pemasukan">
            <i class="bi bi-cash-coin me-3"></i> Pemasukan
        </a>

        <a href="/pengeluaran">
            <i class="bi bi-wallet2 me-3"></i> Pengeluaran
        </a>

        <a href="/laporan">
            <i class="bi bi-file-earmark-text me-3"></i> Laporan Keuangan
        </a>

    </div>

    <div class="logout">
        <hr>

        <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#logoutModal">
            <i class="bi bi-box-arrow-right me-3"></i> Logout
        </a>
    </div>

</div>

<!-- CONTENT -->
<div class="content">

    <!-- HEADER -->
    <div class="header shadow-sm">
        <b>KOS UMMI</b>
        <i class="bi bi-house-fill"></i>
    </div>

    <div class="p-4">
        @yield('content')
    </div>

</div>

</div>

<!-- MODAL -->
<div class="modal fade" id="logoutModal">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content rounded-4">

<div class="modal-body text-center p-4">

<h5>Logout?</h5>
<p class="text-muted">Yakin ingin keluar?</p>

<div class="d-flex justify-content-center gap-2">

<button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

<form action="{{ route('logout') }}" method="POST">
@csrf
<button class="btn btn-danger">Logout</button>
</form>

</div>

</div>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
