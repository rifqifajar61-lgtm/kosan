@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --ink:      #0f0e17;
        --paper:    #fffffe;
        --surface:  #f5f5f7;
        --muted:    #6b6882;
        --muted-lt: #a7a9be;
        --blue:     #60a5fa;   /* ← warna khusus halaman Laporan */
        --blue-deep:#3b82f6;
    }

    /* ─── HEADER ────────────────────────────────────── */
    .page-header {
        position: relative;
        overflow: hidden;
        background: var(--ink);
        border-radius: 20px;
        padding: 32px 40px;
        margin-bottom: 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .page-header::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse 55% 90% at 95% 5%,  rgba(96,165,250,0.22) 0%, transparent 60%),
            radial-gradient(ellipse 40% 60% at 5%  95%, rgba(255,137,6,0.14)  0%, transparent 60%);
        pointer-events: none;
    }

    .header-eyebrow {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: var(--blue);
        margin-bottom: 6px;
        position: relative;
    }

    .header-title {
        position: relative;
        font-size: 28px;
        font-weight: 800;
        color: var(--paper);
        letter-spacing: -0.8px;
        line-height: 1.1;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .header-sub {
        position: relative;
        font-size: 13px;
        color: rgba(255,255,255,0.45);
        margin-top: 6px;
        font-weight: 400;
    }

    /* ─── FILTER CARD ────────────────────────────────── */
    .filter-card {
        background: var(--paper);
        border-radius: 20px;
        padding: 24px 28px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 8px 24px rgba(0,0,0,0.06);
        margin-bottom: 20px;
    }

    .filter-card-label {
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: 1.8px;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 14px;
    }

    .filter-form {
        display: flex;
        align-items: flex-end;
        gap: 16px;
    }

    .filter-group {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .filter-group label {
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: 1.8px;
        text-transform: uppercase;
        color: var(--muted);
    }

    .filter-input {
        width: 100%;
        padding: 11px 14px;
        background: var(--surface);
        border: 1.5px solid transparent;
        border-radius: 10px;
        font-family: 'Sora', sans-serif;
        font-size: 14px;
        color: var(--ink);
        transition: all 0.18s;
        outline: none;
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236b6882' stroke-width='2.5'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        padding-right: 36px;
    }

    .filter-input:focus {
        background-color: var(--paper);
        border-color: var(--blue);
        box-shadow: 0 0 0 3px rgba(96,165,250,0.14);
    }

    .btn-filter {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 22px;
        background: var(--blue);
        color: var(--ink);
        font-family: 'Sora', sans-serif;
        font-size: 13px;
        font-weight: 700;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        white-space: nowrap;
        transition: all 0.18s ease;
        flex-shrink: 0;
    }

    .btn-filter:hover {
        background: var(--blue-deep);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(96,165,250,0.35);
        color: #fff;
    }

    /* ─── STATS ROW ──────────────────────────────────── */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 20px;
    }

    @media (max-width: 768px) { .stats-row { grid-template-columns: 1fr; } }

    .stat-card {
        background: var(--paper);
        border-radius: 16px;
        padding: 22px 24px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 8px 24px rgba(0,0,0,0.06);
        display: flex;
        align-items: center;
        gap: 16px;
        position: relative;
        overflow: hidden;
        transition: transform 0.18s ease, box-shadow 0.18s ease;
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

    .stat-card:nth-child(1)::after { background: #34d399; }
    .stat-card:nth-child(2)::after { background: #f87171; }
    .stat-card:nth-child(3)::after { background: var(--blue); }

    .stat-icon {
        width: 48px; height: 48px;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .stat-card:nth-child(1) .stat-icon { background: rgba(52,211,153,0.12); }
    .stat-card:nth-child(2) .stat-icon { background: rgba(248,113,113,0.12); }
    .stat-card:nth-child(3) .stat-icon { background: rgba(96,165,250,0.12); }

    .stat-label {
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: 1.8px;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 4px;
    }

    .stat-value {
        font-size: 20px;
        font-weight: 800;
        color: var(--ink);
        letter-spacing: -0.5px;
        line-height: 1.2;
        font-family: 'JetBrains Mono', monospace;
    }

    .stat-value.positive { color: #059669; }
    .stat-value.negative { color: #dc2626; }
    .stat-value.neutral  { color: #2563eb; }

    /* ─── TABLE CARD ─────────────────────────────────── */
    .table-card {
        background: var(--paper);
        border-radius: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 8px 24px rgba(0,0,0,0.06);
        overflow: hidden;
    }

    .table-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px 28px;
        border-bottom: 1px solid rgba(0,0,0,0.06);
    }

    .table-card-title { font-size: 14px; font-weight: 700; color: var(--ink); }
    .table-card-sub   { font-size: 12px; color: var(--muted); margin-top: 2px; }

    .bulan-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(96,165,250,0.1);
        border: 1px solid rgba(96,165,250,0.25);
        color: var(--blue-deep);
        border-radius: 999px;
        padding: 4px 14px;
        font-size: 12px;
        font-weight: 700;
        font-family: 'JetBrains Mono', monospace;
    }

    /* Table */
    .ktable { width: 100%; border-collapse: collapse; }
    .ktable thead tr { background: var(--surface); }

    .ktable thead th {
        padding: 14px 24px;
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: 1.8px;
        text-transform: uppercase;
        color: var(--muted);
        border-bottom: 1px solid rgba(0,0,0,0.07);
        white-space: nowrap;
        text-align: center;
    }

    .ktable thead th:first-child { text-align: left; }

    .ktable tbody tr {
        border-bottom: 1px solid rgba(0,0,0,0.05);
        transition: background 0.15s;
    }

    .ktable tbody tr:last-child { border-bottom: none; }
    .ktable tbody tr:hover { background: rgba(96,165,250,0.04); }

    .ktable tbody td {
        padding: 20px 24px;
        font-size: 14px;
        vertical-align: middle;
        text-align: center;
    }

    .ktable tbody td:first-child { text-align: left; }

    /* Bulan cell */
    .bulan-cell {
        font-weight: 700;
        font-size: 15px;
        color: var(--ink);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .bulan-dot {
        width: 8px; height: 8px;
        border-radius: 50%;
        background: var(--blue);
        display: inline-block;
        flex-shrink: 0;
    }

    /* Amount pills */
    .pill-green {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(52,211,153,0.10);
        border: 1px solid rgba(52,211,153,0.25);
        border-radius: 999px;
        padding: 6px 16px;
        font-size: 13px;
        font-weight: 700;
        font-family: 'JetBrains Mono', monospace;
        color: #059669;
    }

    .pill-red {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(248,113,113,0.10);
        border: 1px solid rgba(248,113,113,0.25);
        border-radius: 999px;
        padding: 6px 16px;
        font-size: 13px;
        font-weight: 700;
        font-family: 'JetBrains Mono', monospace;
        color: #dc2626;
    }

    .pill-blue {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(96,165,250,0.10);
        border: 1px solid rgba(96,165,250,0.25);
        border-radius: 999px;
        padding: 6px 16px;
        font-size: 13px;
        font-weight: 700;
        font-family: 'JetBrains Mono', monospace;
        color: #2563eb;
    }

    .pill-blue.minus {
        background: rgba(248,113,113,0.10);
        border-color: rgba(248,113,113,0.25);
        color: #dc2626;
    }

    /* Empty / no filter state */
    .empty-state {
        text-align: center;
        padding: 64px 32px;
        color: var(--muted);
    }

    .empty-icon { font-size: 48px; opacity: 0.2; display: block; margin-bottom: 16px; }
    .empty-text { font-size: 14px; }

    /* ─── ANIMATIONS ─────────────────────────────────── */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .page-header            { animation: fadeUp 0.45s ease both; }
    .filter-card            { animation: fadeUp 0.45s 0.06s ease both; }
    .stat-card:nth-child(1) { animation: fadeUp 0.45s 0.10s ease both; }
    .stat-card:nth-child(2) { animation: fadeUp 0.45s 0.15s ease both; }
    .stat-card:nth-child(3) { animation: fadeUp 0.45s 0.20s ease both; }
    .table-card             { animation: fadeUp 0.45s 0.24s ease both; }
</style>

{{-- ── HEADER ────────────────────────────────────────── --}}
<div class="page-header">
    <div style="position:relative;z-index:1">
        <div class="header-eyebrow">Manajemen Keuangan</div>
        <div class="header-title">Laporan Keuangan</div>
        <div class="header-sub">Ringkasan pemasukan & pengeluaran bulanan</div>
    </div>
</div>

{{-- ── FILTER CARD ───────────────────────────────────── --}}
<div class="filter-card">
    <div class="filter-card-label">Filter Laporan</div>
    <form method="POST" action="/laporan/filter" class="filter-form">
        @csrf
        <div class="filter-group">
            <label>Pilih Bulan</label>
            <select name="bulan" class="filter-input" required>
                <option value="">— Pilih Bulan —</option>
                @foreach ([
                    'Januari','Februari','Maret','April','Mei','Juni',
                    'Juli','Agustus','September','Oktober','November','Desember'
                ] as $b)
                    <option value="{{ $b }}" {{ ($bulan ?? '') == $b ? 'selected' : '' }}>
                        {{ $b }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn-filter">
            <i class="bi bi-funnel-fill"></i> Tampilkan
        </button>
    </form>
</div>

{{-- ── STATS (hanya tampil jika sudah filter) ─────────── --}}
@if(isset($bulan))
@php
    $pemasukan    = $totalPemasukan    ?? 0;
    $pengeluaran  = $totalPengeluaran  ?? 0;
    $selisih      = $pemasukan - $pengeluaran;
@endphp
<div class="stats-row">
    <div class="stat-card">
        <div class="stat-icon">💰</div>
        <div>
            <div class="stat-label">Total Pemasukan</div>
            <div class="stat-value positive">Rp {{ number_format($pemasukan,0,',','.') }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">💸</div>
        <div>
            <div class="stat-label">Total Pengeluaran</div>
            <div class="stat-value negative">Rp {{ number_format($pengeluaran,0,',','.') }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">📊</div>
        <div>
            <div class="stat-label">Selisih Bersih</div>
            <div class="stat-value {{ $selisih >= 0 ? 'positive' : 'negative' }}">
                Rp {{ number_format(abs($selisih),0,',','.') }}
            </div>
        </div>
    </div>
</div>
@endif

{{-- ── TABLE ─────────────────────────────────────────── --}}
<div class="table-card">
    <div class="table-card-header">
        <div>
            <div class="table-card-title">Rekapitulasi Bulanan</div>
            <div class="table-card-sub">Perbandingan pemasukan dan pengeluaran</div>
        </div>
        @if(isset($bulan))
            <div class="bulan-tag"><i class="bi bi-calendar3"></i> {{ $bulan }}</div>
        @endif
    </div>

    <div style="overflow-x:auto">
        <table class="ktable">
            <thead>
                <tr>
                    <th>Bulan</th>
                    <th>Pemasukan</th>
                    <th>Pengeluaran</th>
                    <th>Selisih Bersih</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($bulan))
                @php
                    $selisih = ($totalPemasukan ?? 0) - ($totalPengeluaran ?? 0);
                @endphp
                <tr>
                    <td>
                        <div class="bulan-cell">
                            <span class="bulan-dot"></span>
                            {{ $bulan }}
                        </div>
                    </td>
                    <td>
                        <div class="pill-green">
                            <i class="bi bi-arrow-up-circle"></i>
                            Rp {{ number_format($totalPemasukan ?? 0, 0, ',', '.') }}
                        </div>
                    </td>
                    <td>
                        <div class="pill-red">
                            <i class="bi bi-arrow-down-circle"></i>
                            Rp {{ number_format($totalPengeluaran ?? 0, 0, ',', '.') }}
                        </div>
                    </td>
                    <td>
                        <div class="pill-blue {{ $selisih < 0 ? 'minus' : '' }}">
                            <i class="bi bi-{{ $selisih >= 0 ? 'graph-up' : 'graph-down' }}"></i>
                            Rp {{ number_format(abs($selisih), 0, ',', '.') }}
                        </div>
                    </td>
                </tr>
                @else
                <tr>
                    <td colspan="4">
                        <div class="empty-state">
                            <span class="empty-icon">📊</span>
                            <div class="empty-text">
                                Pilih bulan terlebih dahulu<br>untuk melihat laporan keuangan.
                            </div>
                        </div>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

@endsection