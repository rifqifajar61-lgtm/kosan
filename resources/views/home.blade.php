@extends('layouts.app')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

<style>
    :root {
        --ink: #0f0e17;
        --paper: #fffffe;
        --muted: #a7a9be;
        --accent: #ff8906;
        --accent2: #e53170;
        --green: #3da35d;
        --blue: #0ea5e9;
        --surface: #f5f5f7;
        --card-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 8px 24px rgba(0,0,0,0.06);
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
        font-family: 'Sora', sans-serif;
        background: var(--surface);
        color: var(--ink);
    }

    /* ─── PAGE HEADER ─────────────────────────────── */
    .dash-header {
        position: relative;
        overflow: hidden;
        background: var(--ink);
        border-radius: 20px;
        padding: 40px 44px;
        margin-bottom: 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .dash-header::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse 60% 80% at 90% 10%, rgba(255,137,6,0.25) 0%, transparent 60%),
            radial-gradient(ellipse 40% 60% at 10% 90%, rgba(229,49,112,0.2) 0%, transparent 60%);
        pointer-events: none;
    }

    .dash-header .noise {
        position: absolute;
        inset: 0;
        opacity: 0.035;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
        background-size: 200px;
    }

    .header-left { position: relative; z-index: 1; }

    .header-eyebrow {
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: var(--accent);
        margin-bottom: 8px;
    }

    .header-title {
        font-size: 36px;
        font-weight: 800;
        color: var(--paper);
        line-height: 1.1;
        letter-spacing: -1px;
    }

    .header-title span {
        background: linear-gradient(90deg, var(--accent), var(--accent2));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .header-date {
        margin-top: 10px;
        font-size: 13px;
        color: var(--muted);
        font-family: 'JetBrains Mono', monospace;
    }

    .header-badge {
        position: relative;
        z-index: 1;
        background: rgba(255,255,255,0.07);
        border: 1px solid rgba(255,255,255,0.1);
        backdrop-filter: blur(12px);
        border-radius: 16px;
        padding: 18px 28px;
        text-align: center;
        min-width: 140px;
    }

    .badge-label {
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: var(--muted);
    }

    .badge-value {
        font-size: 28px;
        font-weight: 800;
        color: var(--paper);
        font-family: 'JetBrains Mono', monospace;
        margin-top: 4px;
    }

    .badge-value.green { color: #4ade80; }

    /* ─── STAT CARDS ──────────────────────────────── */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 28px;
    }

    @media (max-width: 900px) { .stats-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 540px) { .stats-grid { grid-template-columns: 1fr; } }

    .stat-card {
        background: var(--paper);
        border-radius: 16px;
        padding: 28px 24px;
        box-shadow: var(--card-shadow);
        position: relative;
        overflow: hidden;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 6px rgba(0,0,0,0.05), 0 16px 40px rgba(0,0,0,0.1);
    }

    .stat-card::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 3px;
        border-radius: 0 0 16px 16px;
    }

    .stat-card:nth-child(1)::after { background: var(--accent); }
    .stat-card:nth-child(2)::after { background: var(--green); }
    .stat-card:nth-child(3)::after { background: var(--blue); }
    .stat-card:nth-child(4)::after { background: var(--accent2); }

    .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-bottom: 18px;
    }

    .stat-card:nth-child(1) .stat-icon { background: rgba(255,137,6,0.1); }
    .stat-card:nth-child(2) .stat-icon { background: rgba(61,163,93,0.1); }
    .stat-card:nth-child(3) .stat-icon { background: rgba(14,165,233,0.1); }
    .stat-card:nth-child(4) .stat-icon { background: rgba(229,49,112,0.1); }

    .stat-label {
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 8px;
    }

    .stat-value {
        font-size: 38px;
        font-weight: 800;
        letter-spacing: -2px;
        line-height: 1;
        color: var(--ink);
        font-family: 'JetBrains Mono', monospace;
    }

    .stat-value.currency {
        font-size: 26px;
        letter-spacing: -1px;
    }

    .stat-sub {
        margin-top: 8px;
        font-size: 12px;
        color: var(--muted);
    }

    .stat-pill {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 3px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 600;
        background: rgba(61,163,93,0.1);
        color: var(--green);
        margin-top: 8px;
    }

    /* ─── FINANCIAL SUMMARY ───────────────────────── */
    .finance-panel {
        background: var(--paper);
        border-radius: 20px;
        padding: 32px 36px;
        box-shadow: var(--card-shadow);
        margin-bottom: 28px;
    }

    .panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 28px;
    }

    .panel-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--ink);
        letter-spacing: -0.5px;
    }

    .panel-subtitle {
        font-size: 12px;
        color: var(--muted);
        margin-top: 2px;
    }

    .month-tag {
        background: var(--ink);
        color: var(--paper);
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        padding: 6px 16px;
        border-radius: 999px;
        font-family: 'JetBrains Mono', monospace;
    }

    .finance-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    @media (max-width: 640px) { .finance-row { grid-template-columns: 1fr; } }

    .finance-item {
        border-radius: 16px;
        padding: 24px 22px;
        position: relative;
        overflow: hidden;
    }

    .finance-item.income {
        background: linear-gradient(135deg, rgba(61,163,93,0.08) 0%, rgba(61,163,93,0.03) 100%);
        border: 1px solid rgba(61,163,93,0.15);
    }

    .finance-item.expense {
        background: linear-gradient(135deg, rgba(229,49,112,0.08) 0%, rgba(229,49,112,0.03) 100%);
        border: 1px solid rgba(229,49,112,0.15);
    }

    .finance-item.balance {
        background: linear-gradient(135deg, rgba(14,165,233,0.08) 0%, rgba(14,165,233,0.03) 100%);
        border: 1px solid rgba(14,165,233,0.15);
    }

    .finance-indicator {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        margin-bottom: 14px;
    }

    .income .finance-indicator   { background: rgba(61,163,93,0.15); }
    .expense .finance-indicator  { background: rgba(229,49,112,0.15); }
    .balance .finance-indicator  { background: rgba(14,165,233,0.15); }

    .finance-type {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .income .finance-type  { color: var(--green); }
    .expense .finance-type { color: var(--accent2); }
    .balance .finance-type { color: var(--blue); }

    .finance-amount {
        font-size: 22px;
        font-weight: 800;
        letter-spacing: -1px;
        font-family: 'JetBrains Mono', monospace;
    }

    .income .finance-amount  { color: var(--green); }
    .expense .finance-amount { color: var(--accent2); }
    .balance .finance-amount { color: var(--blue); }

    /* ─── BAR VISUALIZATION ───────────────────────── */
    .progress-bar-wrap {
        margin-top: 28px;
        padding-top: 24px;
        border-top: 1px solid rgba(0,0,0,0.06);
    }

    .pb-label {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .pb-text { font-size: 12px; font-weight: 600; color: var(--muted); }

    .pb-track {
        height: 8px;
        background: var(--surface);
        border-radius: 999px;
        overflow: hidden;
    }

    .pb-fill {
        height: 100%;
        border-radius: 999px;
        background: linear-gradient(90deg, var(--green), #6ee7b7);
        transition: width 1.2s cubic-bezier(0.16, 1, 0.3, 1);
        width: 0%;
    }

    .occupancy-label { 
        font-size: 12px; 
        font-weight: 700; 
        color: var(--green);
        font-family: 'JetBrains Mono', monospace; 
    }

    /* ─── ANIMATIONS ──────────────────────────────── */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .dash-header  { animation: fadeUp 0.5s ease both; }
    .stat-card:nth-child(1) { animation: fadeUp 0.5s 0.1s ease both; }
    .stat-card:nth-child(2) { animation: fadeUp 0.5s 0.15s ease both; }
    .stat-card:nth-child(3) { animation: fadeUp 0.5s 0.2s ease both; }
    .stat-card:nth-child(4) { animation: fadeUp 0.5s 0.25s ease both; }
    .finance-panel { animation: fadeUp 0.5s 0.3s ease both; }

    .counter { display: inline-block; }
</style>

<!-- ─── HEADER ───────────────────────────────────────── -->
<div class="dash-header">
    <div class="noise"></div>
    <div class="header-left">
        <div class="header-eyebrow">Manajemen Kost</div>
        <h1 class="header-title">Dashboard <span>Overview</span></h1>
        <div class="header-date" id="currentDate">—</div>
    </div>
    <div style="display:flex; gap:12px; flex-wrap:wrap;">
        <div class="header-badge">
            <div class="badge-label">Kamar Terisi</div>
            <div class="badge-value green" id="hdrTerisi">0</div>
        </div>
        <div class="header-badge">
            <div class="badge-label">Total Kamar</div>
            <div class="badge-value" id="hdrTotal">0</div>
        </div>
    </div>
</div>

<!-- ─── STATS ────────────────────────────────────────── -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon">🏠</div>
        <div class="stat-label">Total Kamar</div>
        <div class="stat-value counter" id="totalKamar">0</div>
        <div class="stat-sub">Unit tersedia</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">🔑</div>
        <div class="stat-label">Kamar Terisi</div>
        <div class="stat-value counter" id="kamarTerisi">0</div>
        <div class="stat-pill" id="occupancyPill">↑ 0%</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">👤</div>
        <div class="stat-label">Total Penghuni</div>
        <div class="stat-value counter" id="totalPenghuni">0</div>
        <div class="stat-sub">Penghuni aktif</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">💰</div>
        <div class="stat-label">Pemasukan Bulan Ini</div>
        <div class="stat-value currency" id="pemasukanBulanIni">Rp 0</div>
        <div class="stat-sub">Total terkumpul</div>
    </div>
</div>

<!-- ─── FINANCIAL SUMMARY ────────────────────────────── -->
<div class="finance-panel">
    <div class="panel-header">
        <div>
            <div class="panel-title">Ringkasan Keuangan</div>
            <div class="panel-subtitle">Laporan pendapatan & pengeluaran</div>
        </div>
        <div class="month-tag" id="monthTag">—</div>
    </div>

    <div class="finance-row">
        <div class="finance-item income">
            <div class="finance-indicator">📈</div>
            <div class="finance-type">Pemasukan</div>
            <div class="finance-amount" id="summaryPemasukan">Rp 0</div>
        </div>
        <div class="finance-item expense">
            <div class="finance-indicator">📉</div>
            <div class="finance-type">Pengeluaran</div>
            <div class="finance-amount" id="summaryPengeluaran">Rp 0</div>
        </div>
        <div class="finance-item balance">
            <div class="finance-indicator">⚖️</div>
            <div class="finance-type">Saldo Bersih</div>
            <div class="finance-amount" id="summarySaldo">Rp 0</div>
        </div>
    </div>

    <!-- Occupancy bar -->
    <div class="progress-bar-wrap">
        <div class="pb-label">
            <span class="pb-text">Tingkat Hunian</span>
            <span class="occupancy-label" id="occupancyPct">0%</span>
        </div>
        <div class="pb-track">
            <div class="pb-fill" id="pbFill"></div>
        </div>
    </div>
</div>

<script>
    /* ─── Helpers ───────────────────────── */
    function formatRupiah(n) {
        return 'Rp\u00a0' + Number(n).toLocaleString('id-ID');
    }

    function animateCount(el, target, duration = 900, prefix = '') {
        const start = performance.now();
        const from  = 0;
        const isFloat = (target !== Math.floor(target));
        const update = (now) => {
            const p = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - p, 4);
            const current = from + (target - from) * eased;
            el.textContent = prefix + (isFloat ? current.toFixed(1) : Math.floor(current));
            if (p < 1) requestAnimationFrame(update);
        };
        requestAnimationFrame(update);
    }

    /* ─── Date ──────────────────────────── */
    const now    = new Date();
    const months = ['Januari','Februari','Maret','April','Mei','Juni',
                    'Juli','Agustus','September','Oktober','November','Desember'];
    const days   = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];

    document.getElementById('currentDate').textContent =
        `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;

    document.getElementById('monthTag').textContent =
        `${months[now.getMonth()].toUpperCase()} ${now.getFullYear()}`;

    /* ─── Data ──────────────────────────── */
    let dataKamar       = JSON.parse(localStorage.getItem('dataKamar'))       || [];
    let dataPemasukan   = JSON.parse(localStorage.getItem('dataPemasukan'))   || [];
    let dataPengeluaran = JSON.parse(localStorage.getItem('dataPengeluaran')) || [];

    /* ─── Render ────────────────────────── */
    function updateDashboard() {
        const total   = dataKamar.length;
        const terisi  = dataKamar.filter(k => k.status === 'Terisi').length;
        const penghuni = dataKamar.reduce((s, k) => s + Number(k.penghuni || 0), 0);
        const masuk   = dataPemasukan.reduce((s, b)   => s + Number(b.jumlah  || 0), 0);
        const keluar  = dataPengeluaran.reduce((s, b) => s + Number(b.jumlah  || 0), 0);
        const saldo   = masuk - keluar;
        const pct     = total > 0 ? Math.round((terisi / total) * 100) : 0;

        /* Header badges */
        document.getElementById('hdrTotal').textContent  = total;
        document.getElementById('hdrTerisi').textContent = terisi;

        /* Stat cards */
        animateCount(document.getElementById('totalKamar'),   total);
        animateCount(document.getElementById('kamarTerisi'),  terisi);
        animateCount(document.getElementById('totalPenghuni'), penghuni);

        document.getElementById('pemasukanBulanIni').textContent = formatRupiah(masuk);
        document.getElementById('occupancyPill').textContent     = `↑ ${pct}% Hunian`;

        /* Finance */
        document.getElementById('summaryPemasukan').textContent  = formatRupiah(masuk);
        document.getElementById('summaryPengeluaran').textContent = formatRupiah(keluar);
        document.getElementById('summarySaldo').textContent      = formatRupiah(saldo);

        /* Progress bar */
        document.getElementById('occupancyPct').textContent = `${pct}%`;
        setTimeout(() => {
            document.getElementById('pbFill').style.width = `${pct}%`;
        }, 400);

        /* Saldo warna dinamis */
        const saldoEl = document.getElementById('summarySaldo');
        if (saldo < 0) {
            saldoEl.style.color = 'var(--accent2)';
            saldoEl.closest('.finance-item').style.borderColor = 'rgba(229,49,112,0.25)';
        }
    }

    updateDashboard();
</script>

@endsection