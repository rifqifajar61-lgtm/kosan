<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kost Ummi</title>

<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
:root {
  --primary: #2563eb;
  --primary-light: #eff6ff;
  --primary-hover: #1d4ed8;
  --gray-50: #f9fafb;
  --gray-100: #f3f4f6;
  --gray-400: #9ca3af;
  --gray-600: #4b5563;
  --gray-800: #1f2937;
  --white: #ffffff;
}

/* GLOBAL */
body {
  background: var(--gray-50);
  color: var(--gray-800);
}

/* CUSTOM COLOR */
.bg-primary { background: var(--primary); }
.text-primary { color: var(--primary); }
.bg-card { background: var(--white); }
.text-muted { color: var(--gray-600); }

/* FOOTER */
.footer-custom {
  background: var(--gray-800);
  color: rgba(255,255,255,.7);
}
.footer-custom a {
  color: rgba(255,255,255,.5);
}
.footer-custom a:hover {
  color: #fff;
}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="bg-card shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <i class="fas fa-home text-primary text-2xl"></i>
            <div>
                <span class="text-2xl font-bold text-primary">Kost Ummi</span>
                <p class="text-xs text-muted">Nyaman seperti rumah sendiri</p>
            </div>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="bg-primary text-white py-16 md:py-24">
    <div class="container mx-auto px-4 grid md:grid-cols-2 gap-8 items-center">
        
        <div>
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Cari Kost Nyaman dengan Mudah
            </h1>
            <p class="text-lg mb-8 opacity-90">
                Temukan hunian terbaik untuk mahasiswa & pekerja dengan cepat dan nyaman.
            </p>

            <!-- BUTTON GROUP -->
            <div class="flex flex-wrap gap-4">
                
                <!-- WA -->
                <a href="https://wa.me/6283851230430?text=Halo%20saya%20ingin%20memesan%20kost%20Ummi"
                   target="_blank"
                   class="bg-white text-primary px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 flex items-center gap-2">
                    <i class="fab fa-whatsapp"></i>
                    Pesan Sekarang
                </a>

                <!-- LOKASI -->
                <a href="https://maps.app.goo.gl/LgvPBKjMda5w2fqV6"
                   target="_blank"
                   class="border border-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-primary transition flex items-center gap-2">
                    <i class="fas fa-map-marker-alt"></i>
                    Lihat Lokasi
                </a>

            </div>
        </div>

    </div>
</section>

<!-- FITUR -->
<section class="py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-10">Kenapa Pilih Kost Ummi?</h2>

        <div class="grid md:grid-cols-3 gap-8">
            
            <div class="bg-card p-6 rounded-xl shadow">
                <i class="fas fa-bed text-primary text-3xl mb-3"></i>
                <h3 class="font-bold text-lg mb-2">Kamar Nyaman</h3>
                <p class="text-muted">Bersih dan siap huni</p>
            </div>

            <div class="bg-card p-6 rounded-xl shadow">
                <i class="fas fa-shield-alt text-primary text-3xl mb-3"></i>
                <h3 class="font-bold text-lg mb-2">Keamanan 24 Jam</h3>
                <p class="text-muted">Lingkungan aman</p>
            </div>

            <div class="bg-card p-6 rounded-xl shadow">
                <i class="fas fa-map-marker-alt text-primary text-3xl mb-3"></i>
                <h3 class="font-bold text-lg mb-2">Lokasi Strategis</h3>
                <p class="text-muted">Dekat kampus, kantor, dan pusat kota</p>
            </div>

        </div>
    </div>
</section>

<!-- ABOUT -->
<section class="py-16">
    <div class="container mx-auto px-4 grid md:grid-cols-2 gap-10 items-center">
        <div>
            <h2 class="text-3xl font-bold mb-4">Tentang Kost Ummi</h2>
            <p class="text-muted mb-4">
               Kost Ummi menghadirkan hunian yang nyaman, bersih, dan aman dengan fasilitas lengkap serta harga yang tetap ramah di kantong,
               Berada di lokasi yang mudah dijangkau.
            </p>
            <p class="text-muted">
                Dirancang untuk memenuhi kebutuhan mahasiswa maupun pekerja, Kost Ummi menawarkan lingkungan yang tenang dan mendukung aktivitas sehari-hari. Dengan suasana yang tertata rapi dan pelayanan yang baik, Anda dapat merasakan kenyamanan tinggal layaknya di rumah sendiri.
            </p>
        </div>

        <div class="grid grid-cols-2 gap-4">

    <!-- Card 1 -->
    <div class="bg-white border border-blue-200 rounded-xl p-5 text-center">
        <h3 class="text-2xl font-bold text-primary">50+</h3>
        <p class="text-sm text-gray-700 mt-1">Penghuni</p>
    </div>

    <!-- Card 2 -->
    <div class="bg-white border border-blue-200 rounded-xl p-5 text-center">
        <h3 class="text-2xl font-bold text-primary">24/7</h3>
        <p class="text-sm text-gray-700 mt-1">Keamanan</p>
    </div>

    <!-- Card 3 -->
    <div class="bg-white border border-blue-200 rounded-xl p-5 text-center">
        <h3 class="text-2xl font-bold text-primary">WiFi</h3>
        <p class="text-sm text-gray-700 mt-1">Gratis</p>
    </div>

    <!-- Card 4 -->
    <div class="bg-white border border-blue-200 rounded-xl p-5 text-center">
        <h3 class="text-2xl font-bold text-primary">100%</h3>
        <p class="text-sm text-gray-700 mt-1">Nyaman</p>
    </div>

</div>
    </div>
</section>

<!-- FOOTER -->
<footer class="footer-custom py-12">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-4 gap-8 mb-8">
            
            <div>
                <div class="flex items-center space-x-2 mb-4">
                    <i class="fas fa-home text-primary text-2xl"></i>
                    <span class="text-2xl font-bold text-white">Kost Ummi</span>
                </div>
                <p>
                    Hunian kost nyaman, aman, dan strategis untuk mahasiswa dan pekerja.
                </p>
            </div>
            
            <div>
                <h4 class="font-bold text-lg mb-4 text-white">Layanan</h4>
                <ul class="space-y-2">
                    <li><a href="#">Sewa Kamar</a></li>
                    <li><a href="#">Cek Ketersediaan</a></li>
                    <li><a href="#">Booking Online</a></li>
                    <li><a href="#">Fasilitas</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="font-bold text-lg mb-4 text-white">Perusahaan</h4>
                <ul class="space-y-2">
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Lokasi</a></li>
                    <li><a href="#">Testimoni</a></li>
                    <li><a href="#">Kontak</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="font-bold text-lg mb-4 text-white">Hubungi Kami</h4>
                <ul class="space-y-2">
                    <li>Email: kostummi@gmail.com</li>
                    <li>Telp: 0812-3456-7890</li>
                    <li>Malang, Jawa Timur</li>
                </ul>
            </div>

        </div>
        
        <div class="border-t border-gray-700 pt-6 text-center text-sm">
            © 2026 Kost Ummi. All rights reserved.
        </div>
    </div>
</footer>

</body>
</html>