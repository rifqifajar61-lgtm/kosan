<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kost Ummi</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
/* RESET */
html, body{
    width:100%;
    margin:0;
    padding:0;
    overflow-x:hidden;
    font-family:'Inter',sans-serif;
}

/* BACKGROUND GLOBAL */
body{
    background:linear-gradient(180deg,#fdf6f0,#fffaf5);
    color:#3f3f46;
    padding-top:85px;
}

/* ================= HEADER ================= */
.header-full{
    position:fixed;
    top:0; left:0;
    width:100vw;
    height:85px;
    background:linear-gradient(135deg,#f1a89a,#e07a5f);
    z-index:9999;
    box-shadow:0 10px 35px rgba(224,122,95,.45);
}

.header-inner{
    height:100%;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    color:#fff;
}

.header-inner h1{
    margin:0;
    font-weight:800;
    letter-spacing:1px;
    font-size:1.6rem;
}

.header-inner p{
    margin:2px 0 0;
    font-size:.9rem;
    opacity:.95;
}

/* ================= MAIN ================= */
main{
    width:100%;
    background:linear-gradient(180deg,#fdf6f0,#fffaf5);
    padding:60px 0 120px;
}

/* ================= CARD ================= */
.card-box{
    background:#ffffff;
    border-radius:22px;
    padding:32px;
    margin-bottom:45px;
    box-shadow:0 25px 55px rgba(120,72,48,.12);
}

.section-title{
    font-weight:800;
    font-size:1.15rem;
    color:#9a3412;
    margin-bottom:18px;
    display:flex;
    align-items:center;
    gap:10px;
}

.section-title i{
    color:#e07a5f;
    font-size:1.3rem;
}

/* ================= GALERI ================= */
.gallery-box{
    height:180px;
    border-radius:18px;
    background:linear-gradient(135deg,#fff1e6,#fde2cf);
    border:2px dashed #f1a89a;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:700;
    color:#9a3412;
}

/* ================= ATURAN ================= */
.rules li{
    margin-bottom:10px;
    line-height:1.7;
}

/* ================= FOOTER ================= */
.footer-full{
    width:100vw;
    background:linear-gradient(135deg,#4b2e2b,#2f1b17);
    color:#fef3c7;
    padding:85px 0 35px;
}

.footer-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:35px;
}

.footer-title{
    font-weight:800;
    margin-bottom:12px;
    color:#fff;
}

.footer-grid p{
    font-size:.95rem;
    color:#fde68a;
}

.footer-grid i{
    color:#f1a89a;
    margin-right:8px;
}

.footer-bottom{
    text-align:center;
    margin-top:45px;
    padding-top:20px;
    border-top:1px solid rgba(255,255,255,.2);
    font-size:.85rem;
    color:#fde68a;
}
</style>
</head>

<body>

<!-- HEADER -->
<header class="header-full">
    <div class="header-inner">
        <h1>KOST UMMI</h1>
        <p>Hunian Nyaman • Aman • Terpercaya</p>
    </div>
</header>

<!-- MAIN -->
<main>
<div class="container">

    <!-- GALERI -->
    <div class="card-box">
        <div class="section-title">
            <i class="bi bi-images"></i> Galeri Kost
        </div>
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="gallery-box">Area Depan Kost</div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="gallery-box">Kamar Kost</div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="gallery-box">Fasilitas Umum</div>
            </div>
        </div>
        <small>*Foto akan ditampilkan sesuai kondisi sebenarnya</small>
    </div>

    <!-- TENTANG -->
    <div class="card-box">
        <div class="section-title">
            <i class="bi bi-house-heart"></i> Tentang Kost Ummi
        </div>
        <p>
            Kost Ummi hadir sebagai solusi tempat tinggal yang nyaman dengan
            lingkungan yang aman, bersih, dan tertib.
        </p>
        <p class="mb-0">
            Kami mengutamakan kenyamanan penghuni agar terasa seperti
            tinggal di rumah sendiri.
        </p>
    </div>

    <!-- ATURAN (TIDAK DIUBAH) -->
    <div class="card-box">
        <div class="section-title">
            <i class="bi bi-shield-check"></i> Aturan Kost
        </div>
        <ul class="rules mb-0">
            <li>Selalu menjaga kebersihan, kerapihan, dan keindahan lingkungan kost.</li>
            <li>Menjaga keamanan lingkungan serta barang pribadi.</li>
            <li>Parkir sesuai peruntukannya, tamu parkir di luar area kost.</li>
            <li>Dilarang mengubah bentuk bangunan atau mencoret tembok.</li>
            <li>Penghuni wajib menjaga kebersihan kamar mandi.</li>
            <li>Dilarang menggunakan barang milik pemilik tanpa izin.</li>
            <li>Tamu diperbolehkan sampai pukul 22.00 WIB.</li>
            <li>Dilarang tamu perempuan masuk kamar kecuali pasangan sah.</li>
            <li>Beban listrik dan air ditanggung bersama.</li>
            <li>Pembayaran kost wajib tepat waktu.</li>
        </ul>
    </div>

</div>
</main>

<!-- FOOTER -->
<footer class="footer-full">
<div class="container">

    <div class="footer-grid">
        <div>
            <h5 class="footer-title">Kost Ummi</h5>
            <p>Hunian nyaman untuk pelajar & pekerja dengan lingkungan aman dan tertib.</p>
        </div>

        <div>
            <h5 class="footer-title">Kontak</h5>
            <p><i class="bi bi-telephone"></i> 08xxxxxxxx</p>
            <p><i class="bi bi-geo-alt"></i> Jl. Madyopuro Gang 1 RT 2 RW 1</p>
        </div>

        <div>
            <h5 class="footer-title">Keunggulan</h5>
            <p><i class="bi bi-check-circle"></i> Lingkungan Aman</p>
            <p><i class="bi bi-check-circle"></i> Bersih & Tertib</p>
            <p><i class="bi bi-check-circle"></i> Harga Bersahabat</p>
        </div>
    </div>

    <div class="footer-bottom">
        © 2026 Kost Ummi • All Rights Reserved
    </div>

</div>
</footer>

</body>
</html>
