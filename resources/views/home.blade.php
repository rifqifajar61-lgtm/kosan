@extends('layouts.app')

@section('content')

<style>
    body { background: transparent !important; color: #1e3a5f !important; }

    @keyframes rainbowSlide {
        0%   { background-position: 0% 0%; }
        100% { background-position: 200% 0%; }
    }
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(18px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ─── HEADER ─── */
    .dash-header {
        position: relative; overflow: hidden;
        background: #2563EB;
        border-radius: 20px; padding: 40px 48px;
        margin-bottom: 24px;
        display: flex; 
        align-items: center; 
        justify-content: center; 
        gap: 24px;
        box-shadow: 0 12px 40px rgba(37,99,235,0.32);
        animation: fadeUp 0.45s 0.00s ease both;
        text-align: center;  
    }
    .dash-header::before {
        content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 3px;
        background: linear-gradient(90deg, #60A5FA, #38BDF8, #34D399, #60A5FA);
        background-size: 200% 100%; animation: rainbowSlide 4s linear infinite;
    }
    .dash-header::after {
        content: ''; position: absolute; right: -60px; top: -60px;
        width: 280px; height: 280px; border-radius: 50%;
        background: rgba(255,255,255,0.06); pointer-events: none;
    }
    .header-inner-circle {
        position: absolute; right: 80px; top: -20px;
        width: 160px; height: 160px; border-radius: 50%;
        background: rgba(255,255,255,0.05); pointer-events: none;
    }
    .header-left { position: relative; z-index: 1; }
    .header-eyebrow {
        font-size: 10px; font-weight: 700; letter-spacing: 3.5px;
        text-transform: uppercase; color: rgba(255,255,255,0.55); margin-bottom: 10px;
    }
    .header-title {
        font-size: 32px; font-weight: 800; color: #fff;
        line-height: 1.1; letter-spacing: -0.8px;
    }
    .header-date {
        margin-top: 10px; font-size: 12px; color: rgba(255,255,255,0.50);
        font-family: 'JetBrains Mono', monospace;
    }
    .header-right {
        position: relative; z-index: 1; display: flex; gap: 1px;
        background: rgba(255,255,255,0.12); border-radius: 16px; overflow: hidden;
        border: 1px solid rgba(255,255,255,0.16); flex-shrink: 0;
    }
    .hstat {
        padding: 18px 28px; text-align: center;
        border-right: 1px solid rgba(255,255,255,0.10);
    }
    .hstat:last-child { border-right: none; }
    .hstat-val {
        font-size: 28px; font-weight: 800; color: #fff;
        font-family: 'JetBrains Mono', monospace; line-height: 1;
    }
    .hstat-label {
        font-size: 10px; font-weight: 600; letter-spacing: 1.5px;
        text-transform: uppercase; color: rgba(255,255,255,0.50); margin-top: 5px;
    }

    /* ─── METRIC GRID (top row) ─── */
    .dash-grid {
        display: grid; grid-template-columns: repeat(3, 1fr);
        gap: 20px; margin-bottom: 24px;
    }
    @media (max-width: 900px) { .dash-grid { grid-template-columns: 1fr; } }

    .metric-card {
        background: rgba(255,255,255,0.72);
        backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
        border: 1.5px solid #BFDBFE; border-radius: 18px; padding: 28px 26px;
        position: relative; overflow: hidden;
        transition: transform 0.22s cubic-bezier(0.16,1,0.3,1), box-shadow 0.22s ease;
        box-shadow: 0 2px 16px rgba(37,99,235,0.06);
        display: flex; flex-direction: column; justify-content: space-between;
    }
    .metric-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 14px 36px rgba(37,99,235,0.14); border-color: #93C5FD;
    }
    .metric-card::after {
        content: ''; position: absolute;
        left: 0; top: 0; bottom: 0; width: 3px; border-radius: 18px 0 0 18px;
    }
    .metric-card.c1::after { background: linear-gradient(180deg, #2563EB, #60A5FA); }
    .metric-card.c2::after { background: linear-gradient(180deg, #0EA5E9, #38BDF8); }
    .metric-card.c3::after { background: linear-gradient(180deg, #7C3AED, #A78BFA); }

    .metric-label {
        font-size: 10.5px; font-weight: 800; letter-spacing: 2px;
        text-transform: uppercase; color: #93C5FD; margin-bottom: 12px;
    }
    .metric-value {
        font-size: 52px; font-weight: 800; letter-spacing: -3px; line-height: 1;
        font-family: 'JetBrains Mono', monospace;
    }
    .metric-card.c1 .metric-value { color: #1D4ED8; }
    .metric-card.c2 .metric-value { color: #0369A1; }
    .metric-card.c3 .metric-value { color: #6D28D9; }

    .metric-footer {
        display: flex; align-items: center; justify-content: space-between;
        margin-top: 20px; padding-top: 16px; border-top: 1px solid #EFF6FF;
    }
    .metric-sub { font-size: 12px; color: #93C5FD; font-weight: 500; }
    .metric-pill {
        display: inline-flex; align-items: center;
        padding: 3px 10px; border-radius: 999px; font-size: 10.5px; font-weight: 700;
        background: rgba(37,99,235,0.08); color: #2563EB;
        border: 1px solid rgba(37,99,235,0.18); font-family: 'JetBrains Mono', monospace;
    }
    .metric-pill.green {
        background: rgba(16,185,129,0.10); color: #059669; border-color: rgba(16,185,129,0.22);
    }

    /* ─── KEUANGAN PANEL ─── */
    .finance-panel {
        background: rgba(255,255,255,0.60);
        backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
        border: 1.5px solid #BFDBFE; border-radius: 20px;
        overflow: hidden; box-shadow: 0 4px 28px rgba(37,99,235,0.08);
        animation: fadeUp 0.45s 0.28s ease both;
    }
    .finance-panel-head {
        display: flex; align-items: center; justify-content: space-between;
        padding: 20px 28px 18px;
        border-bottom: 1.5px solid #DBEAFE;
        background: rgba(219,234,254,0.40);
        position: relative;
    }
    .finance-panel-head::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
        background: linear-gradient(90deg, #2563EB, #0EA5E9, #7C3AED, #10B981, #2563EB);
        background-size: 200% 100%; animation: rainbowSlide 4s linear infinite;
    }
    .fp-title {
        font-size: 14px; font-weight: 800; color: #1E3A5F; letter-spacing: -0.3px;
    }
    .fp-sub {
        font-size: 11px; color: #93C5FD; font-weight: 500; margin-top: 2px;
    }
    .fp-month {
        padding: 5px 14px; border-radius: 999px;
        background: rgba(37,99,235,0.09); border: 1px solid rgba(37,99,235,0.22);
        color: #1D4ED8; font-size: 11px; font-weight: 700;
        letter-spacing: 1px; text-transform: uppercase;
        font-family: 'JetBrains Mono', monospace;
    }

    /* ─── 3 FINANCE CARDS inside panel ─── */
    .finance-inner {
        display: grid; grid-template-columns: repeat(3, 1fr);
        gap: 20px; padding: 24px 24px 20px;
    }
    @media (max-width: 900px) { .finance-inner { grid-template-columns: 1fr; } }

    .finance-card {
        background: rgba(255,255,255,0.80);
        border: 1.5px solid #BFDBFE;
        border-radius: 16px; padding: 24px 22px;
        position: relative; overflow: hidden;
        transition: transform 0.20s cubic-bezier(0.16,1,0.3,1), box-shadow 0.20s ease;
        box-shadow: 0 2px 12px rgba(37,99,235,0.06);
    }
    .finance-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 28px rgba(37,99,235,0.13);
        border-color: #93C5FD;
    }

    /* top accent bar per card */
    .finance-card::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
        border-radius: 16px 16px 0 0;
    }
    .income-f::before  { background: linear-gradient(90deg, #10B981, #34D399); }
    .expense-f::before { background: linear-gradient(90deg, #EF4444, #F97316); }
    .balance-f::before { background: linear-gradient(90deg, #2563EB, #0EA5E9); }

    .fc-header {
        display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;
    }
    .fc-label { font-size: 10.5px; font-weight: 800; letter-spacing: 2px; text-transform: uppercase; }
    .income-f  .fc-label { color: #059669; }
    .expense-f .fc-label { color: #DC2626; }
    .balance-f .fc-label { color: #1D4ED8; }

    .fc-dot { width: 7px; height: 7px; border-radius: 50%; flex-shrink: 0; }
    .income-f  .fc-dot { background: #10B981; box-shadow: 0 0 6px rgba(16,185,129,0.55); }
    .expense-f .fc-dot { background: #EF4444; box-shadow: 0 0 6px rgba(239,68,68,0.55); }
    .balance-f .fc-dot { background: #2563EB; box-shadow: 0 0 6px rgba(37,99,235,0.55); }

    .fc-amount {
        font-size: 21px; font-weight: 800; letter-spacing: -0.8px; line-height: 1;
        font-family: 'JetBrains Mono', monospace; margin-bottom: 10px;
    }
    .income-f  .fc-amount { color: #047857; }
    .expense-f .fc-amount { color: #B91C1C; }
    .balance-f .fc-amount { color: #1E40AF; }
    .fc-amount.negative   { color: #B91C1C !important; }

    .fc-bar-wrap { margin-top: 14px; }
    .fc-bar-track {
        height: 4px; background: rgba(0,0,0,0.06);
        border-radius: 999px; overflow: hidden;
    }
    .fc-bar-fill {
        height: 100%; border-radius: 999px;
        transition: width 1.4s cubic-bezier(0.16,1,0.3,1); width: 0%;
    }
    .income-f  .fc-bar-fill { background: linear-gradient(90deg,#10B981,#34D399); }
    .expense-f .fc-bar-fill { background: linear-gradient(90deg,#EF4444,#F97316); }
    .balance-f .fc-bar-fill { background: linear-gradient(90deg,#2563EB,#0EA5E9); }

    .fc-sub { margin-top: 8px; font-size: 11px; font-weight: 600; color: #93C5FD; font-family: 'JetBrains Mono', monospace; }

    /* ─── PANEL BOTTOM: hunian bar ─── */
    .finance-panel-foot {
        display: flex; align-items: center; gap: 16px;
        padding: 16px 28px;
        border-top: 1.5px solid #DBEAFE;
        background: rgba(219,234,254,0.25);
    }
    .hunian-label { font-size: 11px; font-weight: 700; color: #93C5FD; white-space: nowrap; }
    .pb-track {
        flex: 1; height: 7px; background: rgba(37,99,235,0.08);
        border-radius: 999px; overflow: hidden; border: 1px solid rgba(37,99,235,0.10);
    }
    .pb-fill {
        height: 100%; border-radius: 999px;
        background: linear-gradient(90deg, #2563EB, #0EA5E9, #38BDF8, #2563EB);
        background-size: 200% 100%; animation: rainbowSlide 3s linear infinite;
        transition: width 1.2s cubic-bezier(0.16,1,0.3,1); width: 0%;
        box-shadow: 0 1px 6px rgba(37,99,235,0.28);
    }
    .hunian-pct {
        font-size: 13px; font-weight: 800; color: #1D4ED8;
        font-family: 'JetBrains Mono', monospace; white-space: nowrap;
    }

    /* ─── STAGGER ─── */
    .dash-grid .metric-card:nth-child(1) { animation: fadeUp 0.45s 0.08s ease both; }
    .dash-grid .metric-card:nth-child(2) { animation: fadeUp 0.45s 0.14s ease both; }
    .dash-grid .metric-card:nth-child(3) { animation: fadeUp 0.45s 0.20s ease both; }

    /* HILANGKAN SEMUA BORDER WARNA */
.metric-card,
.finance-panel,
.finance-card {
    border: none !important;
}

/* HILANGKAN GARIS ATAS (gradient) */
.dash-header::before,
.finance-panel-head::before,
.finance-card::before,
.metric-card::after {
    display: none !important;
}

/* HILANGKAN GARIS DALAM PANEL */
.finance-panel-head,
.finance-panel-foot {
    border: none !important;
}

/* OPTIONAL: biar tetap clean & premium */
.metric-card,
.finance-card,
.finance-panel {
    box-shadow: 0 6px 20px rgba(0,0,0,0.05) !important;
}

.fc-dot {
    display: none !important;
}

.fc-bar-wrap {
    display: none !important;
}

</style>

{{-- ─── HEADER ─── --}}
<div class="dash-header">
    <div class="header-inner-circle"></div>
    <div class="header-left">
        <div class="header-eyebrow">Manajemen Kost</div>
        <div class="header-title">Kost Ummi</div>
        <div class="header-date">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</div>
    </div>
</div>

{{-- ─── METRIC CARDS ─── --}}
<div class="dash-grid">
    <div class="metric-card c1">
        <div>
            <div class="metric-label">Total Kamar</div>
            <div class="metric-value counter" data-target="{{ $totalKamar }}">0</div>
        </div>
        <div class="metric-footer">
        </div>
    </div>
    <div class="metric-card c2">
        <div>
            <div class="metric-label">Kamar Terisi</div>
            <div class="metric-value counter" data-target="{{ $kamarTerisi }}">0</div>
        </div>
        <div class="metric-footer">
        </div>
    </div>
    <div class="metric-card c3">
        <div>
            <div class="metric-label">Total Penghuni</div>
            <div class="metric-value counter" data-target="{{ $totalPenghuni }}">0</div>
        </div>
        <div class="metric-footer">
        </div>
    </div>
</div>

{{-- ─── KEUANGAN PANEL ─── --}}
<div class="finance-panel">

    {{-- Panel header --}}
    <div class="finance-panel-head">
        <div>
            <div class="fp-title">Keuangan Bulan Ini</div>
            <div class="fp-sub">Ringkasan pemasukan, pengeluaran &amp; saldo</div>
        </div>
        <div class="fp-month">{{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</div>
    </div>

    {{-- 3 cards --}}
    <div class="finance-inner">

        <div class="finance-card income-f">
            <div class="fc-header">
                <span class="fc-label">Pemasukan</span>
                <span class="fc-dot"></span>
            </div>
            <div class="fc-amount">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
            <div class="fc-bar-wrap">
                <div class="fc-bar-track">
                    <div class="fc-bar-fill" id="barIncome"></div>
                </div>
            </div>
            <div class="fc-sub">Total masuk bulan ini</div>
        </div>

        <div class="finance-card expense-f">
            <div class="fc-header">
                <span class="fc-label">Pengeluaran</span>
                <span class="fc-dot"></span>
            </div>
            <div class="fc-amount">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
            <div class="fc-bar-wrap">
                <div class="fc-bar-track">
                    <div class="fc-bar-fill" id="barExpense"></div>
                </div>
            </div>
            <div class="fc-sub">Total keluar bulan ini</div>
        </div>

        <div class="finance-card balance-f">
            <div class="fc-header">
                <span class="fc-label">Saldo Bersih</span>
                <span class="fc-dot"></span>
            </div>
            <div class="fc-amount {{ $saldo < 0 ? 'negative' : '' }}">
                Rp {{ number_format(abs($saldo), 0, ',', '.') }}
                @if($saldo < 0)<span style="font-size:13px;letter-spacing:0"> (minus)</span>@endif
            </div>
            <div class="fc-bar-wrap">
                <div class="fc-bar-track">
                    <div class="fc-bar-fill" id="barBalance"></div>
                </div>
            </div>
            <div class="fc-sub">Pemasukan &minus; Pengeluaran</div>
        </div>

</div>

</div>

<script>
    // Counter animation
    document.querySelectorAll('.counter[data-target]').forEach(el => {
        const target = parseInt(el.dataset.target) || 0;
        const start  = performance.now();
        const dur    = 900;
        const tick   = now => {
            const p = Math.min((now - start) / dur, 1);
            el.textContent = Math.floor(target * (1 - Math.pow(1 - p, 4)));
            p < 1 ? requestAnimationFrame(tick) : (el.textContent = target);
        };
        requestAnimationFrame(tick);
    });

    // Progress bars
    const pemasukan   = {{ $totalPemasukan }};
    const pengeluaran = {{ $totalPengeluaran }};
    const saldo       = {{ abs($saldo) }};
    const maxVal      = Math.max(pemasukan, pengeluaran, saldo, 1);

    setTimeout(() => {
        document.getElementById('pbFill').style.width      = '{{ $persenHunian }}%';
        document.getElementById('barIncome').style.width   = (pemasukan   / maxVal * 100) + '%';
        document.getElementById('barExpense').style.width  = (pengeluaran / maxVal * 100) + '%';
        document.getElementById('barBalance').style.width  = (saldo       / maxVal * 100) + '%';
    }, 420);
</script>

@endsection