@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
.page-header {
    position: relative; overflow: hidden;
    background: rgba(255,255,255,0.60);
    backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
    border: 1.5px solid #BFDBFE;
    border-radius: 22px; padding: 32px 40px;
    margin-bottom: 24px; display: flex;
    align-items: center; justify-content: space-between; gap: 20px;
    box-shadow: 0 8px 40px rgba(37,99,235,0.10), 0 1px 0 rgba(255,255,255,0.8) inset;
    animation: fadeUp 0.45s ease both;
}
.page-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: #93C5FD; /* biru muda */
}
.page-header::after {
    content: ''; position: absolute; inset: 0;
    background:
        radial-gradient(ellipse 55% 90% at 95% 5%,  rgba(14,165,233,0.12) 0%, transparent 60%),
        radial-gradient(ellipse 40% 60% at 5%  95%, rgba(37,99,235,0.08) 0%, transparent 60%);
    pointer-events: none;
}

.header-eyebrow {
    font-size: 10px; font-weight: 800; letter-spacing: 3px;
    text-transform: uppercase; color: #2563EB; margin-bottom: 6px;
}
.header-title {
    position: relative; z-index: 1;
    font-size: 28px; font-weight: 800;
    color: #1E3A5F; letter-spacing: -0.8px; line-height: 1.1;
    display: flex; align-items: center; gap: 10px;
}
.header-count {
    font-size: 12px; font-weight: 700; font-family: 'JetBrains Mono', monospace;
    background: rgba(37,99,235,0.09); border: 1.5px solid rgba(37,99,235,0.25);
    color: #2563EB; padding: 3px 12px; border-radius: 999px;
}
.btn-add {
    position: relative; z-index: 1;
    display: inline-flex; align-items: center; gap: 8px; padding: 12px 22px;
    background: #2563EB; color: #fff;
    font-family: 'Sora', sans-serif; font-size: 13px; font-weight: 700;
    border: none; border-radius: 13px; cursor: pointer;
    white-space: nowrap; transition: all 0.22s ease;
    flex-shrink: 0; text-decoration: none;
    box-shadow: 0 4px 16px rgba(37,99,235,0.38);
}
.btn-add:hover {
    background: #1D4ED8; transform: translateY(-2px);
    box-shadow: 0 10px 28px rgba(37,99,235,0.48); color: #fff;
}

/* ─── ALERT ─── */
.alert-success {
    display: flex; align-items: center; gap: 10px;
    background: rgba(16,185,129,0.08); border: 1.5px solid rgba(16,185,129,0.28);
    border-radius: 14px; padding: 14px 20px; margin-bottom: 20px;
    font-size: 13px; color: #047857; font-weight: 700;
    animation: fadeUp 0.3s ease both; backdrop-filter: blur(10px);
}

/* ─── STAT CARDS ─── */
.stats-row {
    display: grid; grid-template-columns: repeat(3, 1fr);
    gap: 16px; margin-bottom: 24px;
}
@media (max-width: 768px) { .stats-row { grid-template-columns: 1fr; } }

.stat-card {
    background: rgba(255,255,255,0.65);
    backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
    border: 1.5px solid #BFDBFE;
    border-radius: 20px; padding: 22px 24px;
    box-shadow: 0 4px 20px rgba(37,99,235,0.07);
    display: flex; align-items: center; gap: 16px;
    position: relative; overflow: hidden;
    transition: transform 0.22s cubic-bezier(0.16,1,0.3,1), box-shadow 0.22s ease;
}
.stat-card:hover {
    transform: translateY(-4px) scale(1.01);
    box-shadow: 0 16px 40px rgba(37,99,235,0.14); border-color: #93C5FD;
}
.stat-card::before {
    content: ''; position: absolute; inset: 0; border-radius: 20px; pointer-events: none; opacity: 0.6;
}
.stat-card:nth-child(1)::before { background: radial-gradient(ellipse 70% 50% at 0% 0%, rgba(37,99,235,0.09), transparent 65%); }
.stat-card:nth-child(2)::before { background: radial-gradient(ellipse 70% 50% at 0% 0%, rgba(14,165,233,0.09), transparent 65%); }
.stat-card:nth-child(3)::before { background: radial-gradient(ellipse 70% 50% at 0% 0%, rgba(16,185,129,0.09), transparent 65%); }

.stat-card::after {
    content: ''; position: absolute; bottom: 0; left: 0; right: 0;
    height: 3.5px; border-radius: 0 0 20px 20px;
}
.stat-card:nth-child(1)::after { background: linear-gradient(90deg, #2563EB, #60A5FA); }
.stat-card:nth-child(2)::after { background: linear-gradient(90deg, #0EA5E9, #38BDF8); }
.stat-card:nth-child(3)::after { background: linear-gradient(90deg, #10B981, #34D399); }

.stat-icon {
    width: 50px; height: 50px; border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 22px; flex-shrink: 0;
    border: 1.5px solid rgba(255,255,255,0.9);
    box-shadow: 0 4px 14px rgba(37,99,235,0.08);
    position: relative; z-index: 1;
}
.stat-card:nth-child(1) .stat-icon { background: linear-gradient(135deg, rgba(37,99,235,0.14), rgba(96,165,250,0.10)); }
.stat-card:nth-child(2) .stat-icon { background: linear-gradient(135deg, rgba(14,165,233,0.14), rgba(56,189,248,0.10)); }
.stat-card:nth-child(3) .stat-icon { background: linear-gradient(135deg, rgba(16,185,129,0.14), rgba(52,211,153,0.10)); }

.stat-body { position: relative; z-index: 1; }
.stat-label {
    font-size: 10.5px; font-weight: 800; letter-spacing: 1.8px;
    text-transform: uppercase; color: #93C5FD; margin-bottom: 4px;
}
.stat-value {
    font-size: 32px; font-weight: 800;
    letter-spacing: -1.5px; line-height: 1;
    font-family: 'JetBrains Mono', monospace;
}
.stat-value.sm { font-size: 20px; letter-spacing: -0.5px; }

.stat-card:nth-child(1) .stat-value { background: linear-gradient(135deg, #2563EB, #60A5FA); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
.stat-card:nth-child(2) .stat-value { background: linear-gradient(135deg, #0369A1, #38BDF8); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
.stat-card:nth-child(3) .stat-value { background: linear-gradient(135deg, #059669, #34D399); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }

/* ─── TABLE CARD ─── */
.table-card {
    background: rgba(255,255,255,0.60);
    backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
    border: 1.5px solid #BFDBFE;
    border-radius: 22px; box-shadow: 0 8px 40px rgba(37,99,235,0.08);
    overflow: hidden; position: relative;
    animation: fadeUp 0.45s 0.23s ease both;
}
.table-card::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
    background: linear-gradient(90deg, #2563EB, #0EA5E9, #10B981, #2563EB);
    background-size: 200% 100%; animation: rainbowSlide 4s linear infinite;
}
.table-card-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 20px 28px; border-bottom: 1.5px solid #DBEAFE;
    background: rgba(219,234,254,0.30);
}
.table-card-title { font-size: 15px; font-weight: 800; color: #1E3A5F; }
.table-card-sub   { font-size: 12px; color: #93C5FD; margin-top: 2px; }

.ktable { width: 100%; border-collapse: collapse; }
.ktable thead tr { background: rgba(219,234,254,0.35); }
.ktable thead th {
    padding: 14px 20px; font-size: 10.5px; font-weight: 800;
    letter-spacing: 2px; text-transform: uppercase; color: #2563EB;
    border-bottom: 1.5px solid #DBEAFE; white-space: nowrap;
}
.ktable tbody tr { border-bottom: 1px solid rgba(37,99,235,0.07); transition: background 0.15s; }
.ktable tbody tr:last-child { border-bottom: none; }
.ktable tbody tr:hover { background: rgba(219,234,254,0.25); }
.ktable tbody td { padding: 16px 20px; font-size: 14px; vertical-align: middle; color: #1E3A5F; }

.row-num { font-size: 12px; font-family: 'JetBrains Mono', monospace; color: #93C5FD; }

.room-pill {
    display: inline-flex; align-items: center; gap: 7px;
    background: rgba(37,99,235,0.09); border: 1.5px solid rgba(37,99,235,0.22);
    border-radius: 11px; padding: 6px 14px; font-weight: 700;
    font-size: 14px; color: #1D4ED8;
    font-family: 'JetBrains Mono', monospace;
    box-shadow: 0 2px 8px rgba(37,99,235,0.10);
}
.room-dot {
    width: 8px; height: 8px; border-radius: 50%;
    background: linear-gradient(135deg, #2563EB, #60A5FA);
    box-shadow: 0 0 6px rgba(37,99,235,0.45);
    display: inline-block;
}

.price-main { font-weight: 800; font-size: 15px; font-family: 'JetBrains Mono', monospace; color: #1E3A5F; }
.price-sub  { font-size: 11px; color: #93C5FD; margin-top: 2px; }

.f-badge {
    display: inline-block; padding: 3px 10px; border-radius: 7px;
    font-size: 11px; font-weight: 700;
    background: rgba(37,99,235,0.08); border: 1px solid rgba(37,99,235,0.18);
    color: #2563EB; margin: 2px 2px 2px 0;
}

.btn-edit {
    display: inline-flex; align-items: center; gap: 5px; padding: 7px 14px;
    background: rgba(37,99,235,0.09); border: 1.5px solid rgba(37,99,235,0.25);
    color: #2563EB; border-radius: 10px; font-size: 12px; font-weight: 700;
    cursor: pointer; transition: all 0.18s; text-decoration: none;
}
.btn-edit:hover {
    background: rgba(37,99,235,0.16); border-color: rgba(37,99,235,0.45); color: #1D4ED8;
    box-shadow: 0 4px 14px rgba(37,99,235,0.18); transform: translateY(-1px);
}
.btn-del {
    display: inline-flex; align-items: center; gap: 5px; padding: 7px 14px;
    background: rgba(239,68,68,0.08); border: 1.5px solid rgba(239,68,68,0.22);
    color: #DC2626; border-radius: 10px; font-size: 12px; font-weight: 700;
    cursor: pointer; transition: all 0.18s; text-decoration: none;
}
.btn-del:hover {
    background: rgba(239,68,68,0.16); border-color: rgba(239,68,68,0.44); color: #B91C1C;
    box-shadow: 0 4px 14px rgba(239,68,68,0.16); transform: translateY(-1px);
}

/* ─── STATUS BADGE ─── */
@keyframes pulse-aktif {
    0%, 100% { opacity: 1; transform: scale(1); }
    50%       { opacity: 0.45; transform: scale(0.72); }
}
.status-kamar-badge {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 5px 12px; border-radius: 999px;
    font-size: 12px; font-weight: 700; white-space: nowrap;
}
.status-kamar-badge.aktif {
    background: rgba(16,185,129,0.09); border: 1.5px solid rgba(16,185,129,0.28); color: #059669;
}
.status-kamar-badge.nonaktif {
    background: rgba(239,68,68,0.08); border: 1.5px solid rgba(239,68,68,0.24); color: #DC2626;
}
.status-dot-pulse {
    width: 7px; height: 7px; border-radius: 50%; background: #10B981;
    display: inline-block; animation: pulse-aktif 2s infinite;
}

/* ─── MODAL ─── */
.modal-content {
    border: 1.5px solid #BFDBFE !important; border-radius: 22px !important;
    overflow: hidden; background: rgba(255,255,255,0.92) !important;
    backdrop-filter: blur(30px);
    box-shadow: 0 30px 70px rgba(37,99,235,0.16) !important; color: #1E3A5F;
}
.modal-header {
    background: rgba(219,234,254,0.50) !important;
    border-bottom: 1.5px solid #BFDBFE !important;
    padding: 22px 28px; position: relative; overflow: hidden;
}
.modal-header::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
    background: linear-gradient(90deg, #2563EB, #0EA5E9, #10B981, #2563EB);
    background-size: 200% 100%; animation: rainbowSlide 3s linear infinite;
}
.modal-header::after {
    content: ''; position: absolute; inset: 0;
    background: radial-gradient(ellipse 60% 80% at 100% 0%, rgba(14,165,233,0.10) 0%, transparent 60%);
    pointer-events: none;
}
.modal-title {
    font-size: 15px; font-weight: 800; color: #1E3A5F;
    display: flex; align-items: center; gap: 8px; position: relative; z-index: 1;
}
.modal-title .mtag {
    font-size: 10px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase;
    background: rgba(37,99,235,0.09); border: 1.5px solid rgba(37,99,235,0.25);
    color: #2563EB; padding: 3px 10px; border-radius: 999px;
}
.btn-close-custom {
    background: rgba(37,99,235,0.09); border: 1.5px solid rgba(37,99,235,0.20);
    width: 32px; height: 32px; border-radius: 9px; color: #2563EB; font-size: 15px;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; transition: all 0.18s; position: relative; z-index: 1;
}
.btn-close-custom:hover { background: rgba(37,99,235,0.18); box-shadow: 0 4px 12px rgba(37,99,235,0.18); }

.modal-body { padding: 28px; background: rgba(255,255,255,0.60); }

.form-label-custom {
    font-size: 10.5px; font-weight: 800; letter-spacing: 2px;
    text-transform: uppercase; color: #93C5FD; margin-bottom: 8px; display: block;
}
.form-control-custom {
    width: 100%; padding: 11px 14px;
    background: rgba(255,255,255,0.80); border: 1.5px solid #BFDBFE;
    border-radius: 11px; font-family: 'Sora', sans-serif; font-size: 14px; color: #1E3A5F;
    transition: all 0.18s; outline: none;
}
.form-control-custom:focus {
    background: rgba(255,255,255,0.96); border-color: #2563EB;
    box-shadow: 0 0 0 3px rgba(37,99,235,0.12);
}
textarea.form-control-custom { resize: vertical; min-height: 100px; }

.input-group-custom {
    display: flex; border-radius: 11px; overflow: hidden;
    border: 1.5px solid #BFDBFE; transition: all 0.18s;
    background: rgba(255,255,255,0.80);
}
.input-group-custom:focus-within { border-color: #2563EB; box-shadow: 0 0 0 3px rgba(37,99,235,0.12); }
.input-prefix {
    padding: 11px 14px; font-size: 13px; font-weight: 800; color: #2563EB;
    background: rgba(37,99,235,0.07); border-right: 1.5px solid #BFDBFE;
    white-space: nowrap; font-family: 'JetBrains Mono', monospace;
}
.input-group-custom input {
    flex: 1; border: none; padding: 11px 14px; background: transparent;
    font-family: 'Sora', sans-serif; font-size: 14px; color: #1E3A5F; outline: none;
}

.modal-footer-custom {
    display: flex; gap: 10px; justify-content: flex-end; padding: 20px 28px;
    background: rgba(219,234,254,0.25); border-top: 1.5px solid #DBEAFE;
}
.btn-modal-save {
    display: inline-flex; align-items: center; gap: 7px; padding: 11px 24px;
    background: #2563EB; color: #fff; font-family: 'Sora', sans-serif;
    font-size: 13px; font-weight: 700; border: none; border-radius: 11px;
    cursor: pointer; transition: all 0.22s; box-shadow: 0 4px 16px rgba(37,99,235,0.38);
}
.btn-modal-save:hover { background: #1D4ED8; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(37,99,235,0.48); }
.btn-modal-cancel {
    display: inline-flex; align-items: center; padding: 11px 20px;
    background: rgba(255,255,255,0.70); color: #6B7280; font-family: 'Sora', sans-serif;
    font-size: 13px; font-weight: 700; border: 1.5px solid #BFDBFE; border-radius: 11px;
    cursor: pointer; transition: all 0.18s;
}
.btn-modal-cancel:hover { background: rgba(37,99,235,0.08); color: #1D4ED8; border-color: rgba(37,99,235,0.30); }

/* ─── PAGINATION ─── */
.pagination-wrapper {
    display: flex; align-items: center; justify-content: space-between;
    padding: 16px 28px; border-top: 1.5px solid #DBEAFE;
    flex-wrap: wrap; gap: 12px; background: rgba(219,234,254,0.20);
}
.pagination-info { font-size: 13px; color: #93C5FD; }
.pagination-links { display: flex; align-items: center; gap: 6px; }
.page-btn {
    display: inline-flex; align-items: center; justify-content: center;
    min-width: 34px; height: 34px; padding: 0 10px; border-radius: 8px;
    font-size: 13px; font-weight: 600; color: #2563EB;
    background: rgba(255,255,255,0.70); border: 1.5px solid #BFDBFE;
    text-decoration: none; transition: all .15s ease; cursor: pointer;
}
.page-btn:hover:not(.disabled):not(.active) {
    background: rgba(37,99,235,0.10); border-color: rgba(37,99,235,0.32); color: #1D4ED8;
}
.page-btn.active {
    background: #2563EB; border-color: #2563EB; color: #fff; cursor: default;
    box-shadow: 0 2px 10px rgba(37,99,235,0.38);
}
.page-btn.disabled { opacity: 0.35; cursor: not-allowed; pointer-events: none; }

/* ─── ANIMATIONS ─── */
.stat-card:nth-child(1) { animation: fadeUp 0.45s 0.08s ease both; }
.stat-card:nth-child(2) { animation: fadeUp 0.45s 0.13s ease both; }
.stat-card:nth-child(3) { animation: fadeUp 0.45s 0.18s ease both; }

@media (max-width: 900px) { .stats-row { grid-template-columns: repeat(3, 1fr) !important; } }
@media (max-width: 540px) { .stats-row { grid-template-columns: 1fr 1fr !important; } }

.stat-card::after {
    display: none !important;
}

.table-card::before {
    display: none !important;
}
</style>

{{-- ── HEADER ── --}}
<div class="page-header">
    <div style="position:relative;z-index:1">
        <div class="header-eyebrow">Manajemen Keuangan</div>
        <div class="header-title">
            Data Pengeluaran
        </div>
    </div>
    <a href="{{ route('pengeluaran.tambah') }}" class="btn-add">
        <i class="bi bi-wallet2"></i> Tambah Pengeluaran
    </a>
</div>

{{-- ── STATS ── --}}
@php
    $totalTransaksi = $pengeluaran->count();
    $totalNominal   = $pengeluaran->sum('jumlah');
    $jenisTerbanyak = $pengeluaran->groupBy('jenis_pengeluaran')->map->count()->sortDesc()->keys()->first() ?? '-';
@endphp

<div class="stats-row">
    <div class="stat-card">
        
        <div class="stat-body">
            <div class="stat-label">Total Transaksi</div>
            <div class="stat-value">{{ $totalTransaksi }}</div>
        </div>
    </div>
    <div class="stat-card">
        
        <div class="stat-body">
            <div class="stat-label">Total Nominal</div>
            <div class="stat-value" style="font-size:18px;letter-spacing:-0.5px">
                Rp {{ number_format($totalNominal,0,',','.') }}
            </div>
        </div>
    </div>
    <div class="stat-card">
        
        <div class="stat-body">
            <div class="stat-label">Jenis Terbanyak</div>
            <div class="stat-value" style="font-size:16px;letter-spacing:-0.3px;font-family:'Sora',sans-serif">
                {{ $jenisTerbanyak }}
            </div>
        </div>
    </div>
</div>

{{-- ── TABLE ── --}}
<div class="table-card">
    <div class="table-card-header">
        <div>
            <div class="table-card-title">Semua Data Pengeluaran</div>
            <div class="table-card-sub">Riwayat pengeluaran operasional kost</div>
        </div>
    </div>
    <div style="overflow-x:auto">
        <table class="ktable">
            <thead>
                <tr>
                    <th style="padding-left:24px;width:50px">#</th>
                    <th>Tanggal</th>
                    <th>Jenis Pengeluaran</th>
                    <th>Nominal</th>
                    <th style="text-align:center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pengeluaran as $p)
                <tr style="animation-delay:{{ $loop->index * 0.04 }}s">
                    <td style="padding-left:24px">
                        <span class="row-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    </td>
                    <td>
                        <span class="date-badge">
                            <i class="bi bi-calendar3"></i>
                            {{ date('d M Y', strtotime($p->tanggal)) }}
                        </span>
                    </td>
                    <td>
                        <div class="jenis-pill">
                            <span class="jenis-dot"></span>
                            {{ $p->jenis_pengeluaran }}
                        </div>
                    </td>
                    <td>
                        <div class="nominal-pill">
                            <i class="bi bi-dash-circle-fill" style="font-size:11px"></i>
                            Rp {{ number_format($p->jumlah,0,',','.') }}
                        </div>
                    </td>

                    <td style="text-align:center">
    <a href="{{ route('pengeluaran.edit', $p->id_pengeluaran) }}" class="btn-edit">
        <i class="bi bi-pencil-square"></i> Edit
    </a>
</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">
                        <div class="empty-state">
                            <span class="empty-icon">💸</span>
                            <div class="empty-text">
                                Data pengeluaran belum tersedia.<br>
                                Klik <strong>+ Tambah Pengeluaran</strong> untuk memulai.
                            </div>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection