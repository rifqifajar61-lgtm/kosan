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
        --accent:   #ff8906;
        --accent2:  #e53170;
        --purple:   #c084fc;   /* ← warna khusus halaman Sewa */
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
            radial-gradient(ellipse 55% 90% at 95% 5%,  rgba(192,132,252,0.22) 0%, transparent 60%),
            radial-gradient(ellipse 40% 60% at 5%  95%, rgba(255,137,6,0.14)  0%, transparent 60%);
        pointer-events: none;
    }

    .header-eyebrow {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: var(--purple);
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

    .header-count {
        font-size: 13px;
        font-weight: 700;
        font-family: 'JetBrains Mono', monospace;
        background: rgba(192,132,252,0.15);
        border: 1px solid rgba(192,132,252,0.3);
        color: var(--purple);
        padding: 3px 12px;
        border-radius: 999px;
    }

    .btn-add {
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 22px;
        background: var(--purple);
        color: var(--ink);
        font-family: 'Sora', sans-serif;
        font-size: 13px;
        font-weight: 700;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        white-space: nowrap;
        transition: all 0.18s ease;
        flex-shrink: 0;
        text-decoration: none;
    }

    .btn-add:hover {
        background: #a855f7;
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(192,132,252,0.35);
        color: var(--ink);
    }

    /* ─── STATS ROW ──────────────────────────────────── */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 28px;
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

    .stat-card:nth-child(1)::after { background: var(--purple); }
    .stat-card:nth-child(2)::after { background: #34d399; }
    .stat-card:nth-child(3)::after { background: #f87171; }

    .stat-icon {
        width: 48px; height: 48px;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .stat-card:nth-child(1) .stat-icon { background: rgba(192,132,252,0.12); }
    .stat-card:nth-child(2) .stat-icon { background: rgba(52,211,153,0.12); }
    .stat-card:nth-child(3) .stat-icon { background: rgba(248,113,113,0.12); }

    .stat-label {
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: 1.8px;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 4px;
    }

    .stat-value {
        font-size: 34px;
        font-weight: 800;
        color: var(--ink);
        letter-spacing: -1.5px;
        line-height: 1;
        font-family: 'JetBrains Mono', monospace;
    }

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

    /* Table */
    .ktable { width: 100%; border-collapse: collapse; }

    .ktable thead tr { background: var(--surface); }

    .ktable thead th {
        padding: 14px 20px;
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: 1.8px;
        text-transform: uppercase;
        color: var(--muted);
        border-bottom: 1px solid rgba(0,0,0,0.07);
        white-space: nowrap;
    }

    .ktable tbody tr {
        border-bottom: 1px solid rgba(0,0,0,0.05);
        transition: background 0.15s;
    }

    .ktable tbody tr:last-child { border-bottom: none; }
    .ktable tbody tr:hover { background: rgba(192,132,252,0.04); }

    .ktable tbody td {
        padding: 16px 20px;
        font-size: 14px;
        vertical-align: middle;
    }

    /* Row number */
    .row-num {
        font-size: 12px;
        font-family: 'JetBrains Mono', monospace;
        color: var(--muted-lt);
    }

    /* Penghuni name cell */
    .name-cell {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .avatar {
        width: 36px; height: 36px;
        border-radius: 10px;
        background: rgba(192,132,252,0.12);
        border: 1.5px solid rgba(192,132,252,0.25);
        color: var(--purple);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 800;
        flex-shrink: 0;
        font-family: 'JetBrains Mono', monospace;
    }

    .name-text {
        font-weight: 700;
        font-size: 14px;
        color: var(--ink);
    }

    /* Room pill */
    .room-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(192,132,252,0.08);
        border: 1px solid rgba(192,132,252,0.2);
        border-radius: 8px;
        padding: 5px 12px;
        font-size: 13px;
        font-weight: 600;
        font-family: 'JetBrains Mono', monospace;
        color: var(--ink);
    }

    .room-dot {
        width: 7px; height: 7px;
        border-radius: 50%;
        background: var(--purple);
        display: inline-block;
    }

    /* Status badges */
    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
        font-family: 'JetBrains Mono', monospace;
    }

    .status-aktif {
        background: rgba(52,211,153,0.12);
        border: 1px solid rgba(52,211,153,0.3);
        color: #34d399;
    }

    .status-aktif::before {
        content: '';
        width: 6px; height: 6px;
        border-radius: 50%;
        background: #34d399;
        display: inline-block;
        animation: pulse 2s infinite;
    }

    .status-nonaktif {
        background: rgba(107,104,130,0.1);
        border: 1px solid rgba(107,104,130,0.2);
        color: var(--muted);
    }

    .status-nonaktif::before {
        content: '';
        width: 6px; height: 6px;
        border-radius: 50%;
        background: var(--muted);
        display: inline-block;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50%       { opacity: 0.5; transform: scale(0.8); }
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 64px 32px;
        color: var(--muted);
    }

    .empty-icon { font-size: 48px; opacity: 0.25; display: block; margin-bottom: 16px; }
    .empty-text { font-size: 14px; }

    /* ─── ANIMATIONS ─────────────────────────────────── */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .page-header               { animation: fadeUp 0.45s ease both; }
    .stat-card:nth-child(1)    { animation: fadeUp 0.45s 0.08s ease both; }
    .stat-card:nth-child(2)    { animation: fadeUp 0.45s 0.13s ease both; }
    .stat-card:nth-child(3)    { animation: fadeUp 0.45s 0.18s ease both; }
    .table-card                { animation: fadeUp 0.45s 0.22s ease both; }
</style>

{{-- ── HEADER ────────────────────────────────────────── --}}
<div class="page-header">
    <div style="position:relative;z-index:1">
        <div class="header-eyebrow">Manajemen Sewa</div>
        <div class="header-title">
            Data Sewa
            <span class="header-count">{{ $sewa->count() }} kontrak</span>
        </div>
    </div>
    <button class="btn-add" data-bs-toggle="modal" data-bs-target="#tambahSewaModal">
        <i class="bi bi-receipt-cutoff"></i> Tambah Sewa
    </button>
</div>

{{-- ── STATS ─────────────────────────────────────────── --}}
@php
    $totalSewa    = $sewa->count();
    $sewaAktif    = $sewa->where('status', 'aktif')->count();
    $sewaNonaktif = $sewa->where('status', '!=', 'aktif')->count();
@endphp

<div class="stats-row">
    <div class="stat-card">
        <div class="stat-icon">📋</div>
        <div>
            <div class="stat-label">Total Kontrak</div>
            <div class="stat-value">{{ $totalSewa }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">✅</div>
        <div>
            <div class="stat-label">Sewa Aktif</div>
            <div class="stat-value">{{ $sewaAktif }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">⏸️</div>
        <div>
            <div class="stat-label">Non-Aktif</div>
            <div class="stat-value">{{ $sewaNonaktif }}</div>
        </div>
    </div>
</div>

{{-- ── TABLE ─────────────────────────────────────────── --}}
<div class="table-card">
    <div class="table-card-header">
        <div>
            <div class="table-card-title">Semua Data Sewa</div>
            <div class="table-card-sub">Riwayat dan status kontrak hunian</div>
        </div>
    </div>

    <div style="overflow-x:auto">
        <table class="ktable">
            <thead>
                <tr>
                    <th style="padding-left:28px; width:54px">#</th>
                    <th>Penghuni</th>
                    <th>Kamar</th>
                    <th style="text-align:center">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sewa as $s)
                <tr>
                    <td style="padding-left:28px">
                        <span class="row-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    </td>

                    <td>
                        <div class="name-cell">
                            <div class="avatar">{{ strtoupper(substr($s->nama_penghuni, 0, 1)) }}</div>
                            <span class="name-text">{{ $s->nama_penghuni }}</span>
                        </div>
                    </td>

                    <td>
                        <div class="room-pill">
                            <span class="room-dot"></span>
                            Kamar {{ $s->nomor_kamar }}
                        </div>
                    </td>

                    <td style="text-align:center">
                        <span class="status-pill {{ $s->status == 'aktif' ? 'status-aktif' : 'status-nonaktif' }}">
                            {{ ucfirst($s->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">
                        <div class="empty-state">
                            <span class="empty-icon">📋</span>
                            <div class="empty-text">
                                Data sewa belum tersedia.<br>
                                Klik <strong>+ Tambah Sewa</strong> untuk memulai.
                            </div>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ── MODAL TAMBAH SEWA ────────────────────────────── --}}
<div class="modal fade" id="tambahSewaModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content-sewa">
            <form action="{{ route('sewa.simpan') }}" method="POST">
                @csrf

                {{-- Header --}}
                <div class="msewa-header">
                    <div class="msewa-title">
                        <i class="bi bi-receipt-cutoff"></i>
                        Tambah Sewa Baru
                        <span class="msewa-tag">Baru</span>
                    </div>
                    <button type="button" class="msewa-close" data-bs-dismiss="modal">✕</button>
                </div>

                {{-- Body --}}
                <div class="msewa-body">

                    <div class="msewa-field">
                        <label class="msewa-label">Penghuni</label>
                        <select name="id_penghuni" class="msewa-input" required>
                            <option value="" disabled selected>— Pilih penghuni —</option>
                            @foreach ($penghuni as $p)
                                <option value="{{ $p->id_penghuni }}">{{ $p->nama_penghuni }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="msewa-field">
                        <label class="msewa-label">Kamar</label>
                        <select name="id_kamar" class="msewa-input" required>
                            <option value="" disabled selected>— Pilih kamar —</option>
                            @foreach ($kamar as $k)
                                <option value="{{ $k->id_kamar }}">
                                    Kamar {{ $k->nomor_kamar }}
                                    — Rp {{ number_format($k->harga_sewa,0,',','.') }}/bln
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="msewa-grid2">
                        <div class="msewa-field">
                            <label class="msewa-label">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" class="msewa-input" required>
                        </div>
                        <div class="msewa-field">
                            <label class="msewa-label">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" class="msewa-input">
                        </div>
                    </div>

                    <div class="msewa-field">
                        <label class="msewa-label">Status</label>
                        <select name="status" class="msewa-input" required>
                            <option value="aktif" selected>Aktif</option>
                            <option value="nonaktif">Non-Aktif</option>
                        </select>
                    </div>

                </div>

                {{-- Footer --}}
                <div class="msewa-footer">
                    <button type="button" class="msewa-btn-cancel" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="msewa-btn-save">
                        <i class="bi bi-check-lg"></i> Simpan Sewa
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<style>
    /* ─── MODAL SEWA ─────────────────────────────────── */
    .modal-content-sewa {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,0.25);
        background: var(--paper);
    }

    .msewa-header {
        background: var(--ink);
        padding: 22px 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
    }

    .msewa-header::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse 60% 80% at 100% 0%, rgba(192,132,252,0.25) 0%, transparent 60%);
        pointer-events: none;
    }

    .msewa-title {
        font-size: 15px;
        font-weight: 700;
        color: var(--paper);
        display: flex;
        align-items: center;
        gap: 8px;
        position: relative;
    }

    .msewa-tag {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        background: rgba(192,132,252,0.18);
        border: 1px solid rgba(192,132,252,0.35);
        color: var(--purple);
        padding: 3px 10px;
        border-radius: 999px;
    }

    .msewa-close {
        background: rgba(255,255,255,0.1);
        border: none;
        width: 32px; height: 32px;
        border-radius: 8px;
        color: var(--paper);
        font-size: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.15s;
        position: relative;
    }

    .msewa-close:hover { background: rgba(255,255,255,0.2); }

    .msewa-body {
        padding: 28px;
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .msewa-grid2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    @media (max-width: 480px) { .msewa-grid2 { grid-template-columns: 1fr; } }

    .msewa-field { display: flex; flex-direction: column; gap: 7px; }

    .msewa-label {
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: 1.8px;
        text-transform: uppercase;
        color: var(--muted);
    }

    .msewa-input {
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
    }

    select.msewa-input {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236b6882' stroke-width='2.5'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        padding-right: 36px;
    }

    .msewa-input:focus {
        background: var(--paper);
        border-color: var(--purple);
        box-shadow: 0 0 0 3px rgba(192,132,252,0.14);
    }

    .msewa-footer {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
        padding: 20px 28px;
        background: var(--surface);
        border-top: 1px solid rgba(0,0,0,0.06);
    }

    .msewa-btn-save {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 11px 24px;
        background: var(--purple);
        color: var(--ink);
        font-family: 'Sora', sans-serif;
        font-size: 13px;
        font-weight: 700;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.18s;
    }

    .msewa-btn-save:hover {
        background: #a855f7;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(192,132,252,0.35);
    }

    .msewa-btn-cancel {
        display: inline-flex;
        align-items: center;
        padding: 11px 20px;
        background: transparent;
        color: var(--muted);
        font-family: 'Sora', sans-serif;
        font-size: 13px;
        font-weight: 600;
        border: 1.5px solid rgba(0,0,0,0.1);
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.18s;
    }

    .msewa-btn-cancel:hover { background: rgba(0,0,0,0.04); color: var(--ink); }
</style>

@endsection