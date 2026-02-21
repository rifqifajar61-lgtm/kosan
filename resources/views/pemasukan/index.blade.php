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
        --purple:   #c084fc;
        --green:    #34d399;
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
            radial-gradient(ellipse 55% 90% at 95% 5%,  rgba(52,211,153,0.22) 0%, transparent 60%),
            radial-gradient(ellipse 40% 60% at 5%  95%, rgba(255,137,6,0.14)  0%, transparent 60%);
        pointer-events: none;
    }

    .header-eyebrow {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: var(--green);
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
        background: rgba(52,211,153,0.15);
        border: 1px solid rgba(52,211,153,0.3);
        color: var(--green);
        padding: 3px 12px;
        border-radius: 999px;
    }

    .btn-add {
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 22px;
        background: var(--green);
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
        background: #10b981;
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(52,211,153,0.35);
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

    .stat-card:nth-child(1)::after { background: var(--green); }
    .stat-card:nth-child(2)::after { background: #60a5fa; }
    .stat-card:nth-child(3)::after { background: var(--accent); }

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
    .stat-card:nth-child(2) .stat-icon { background: rgba(96,165,250,0.12); }
    .stat-card:nth-child(3) .stat-icon { background: rgba(255,137,6,0.12); }

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
    .ktable tbody tr:hover { background: rgba(52,211,153,0.04); }

    .ktable tbody td {
        padding: 16px 20px;
        font-size: 14px;
        vertical-align: middle;
    }

    .row-num {
        font-size: 12px;
        font-family: 'JetBrains Mono', monospace;
        color: var(--muted-lt);
    }

    .name-cell { display: flex; align-items: center; gap: 10px; }

    .avatar {
        width: 36px; height: 36px;
        border-radius: 10px;
        background: rgba(52,211,153,0.12);
        border: 1.5px solid rgba(52,211,153,0.25);
        color: var(--green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 800;
        flex-shrink: 0;
        font-family: 'JetBrains Mono', monospace;
    }

    .name-text { font-weight: 700; font-size: 14px; color: var(--ink); }

    .room-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(52,211,153,0.08);
        border: 1px solid rgba(52,211,153,0.2);
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
        background: var(--green);
        display: inline-block;
    }

    .amount-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(52,211,153,0.10);
        border: 1px solid rgba(52,211,153,0.25);
        border-radius: 999px;
        padding: 5px 14px;
        font-size: 13px;
        font-weight: 700;
        font-family: 'JetBrains Mono', monospace;
        color: #059669;
    }

    .empty-state {
        text-align: center;
        padding: 64px 32px;
        color: var(--muted);
    }

    .empty-icon { font-size: 48px; opacity: 0.25; display: block; margin-bottom: 16px; }
    .empty-text { font-size: 14px; }

    /* ─── MODAL PEMASUKAN ────────────────────────────── */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(15,14,23,0.6);
        backdrop-filter: blur(4px);
        z-index: 999;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .modal-overlay.active {
        display: flex;
    }

    .modal-content-pemasukan {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,0.35);
        background: var(--paper);
        width: 100%;
        max-width: 480px;
        animation: modalIn 0.25s ease both;
    }

    @keyframes modalIn {
        from { opacity: 0; transform: translateY(20px) scale(0.97); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    .mpemasukan-header {
        background: var(--ink);
        padding: 22px 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
    }

    .mpemasukan-header::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse 60% 80% at 100% 0%, rgba(52,211,153,0.25) 0%, transparent 60%);
        pointer-events: none;
    }

    .mpemasukan-title {
        font-size: 15px;
        font-weight: 700;
        color: var(--paper);
        display: flex;
        align-items: center;
        gap: 8px;
        position: relative;
    }

    .mpemasukan-tag {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        background: rgba(52,211,153,0.18);
        border: 1px solid rgba(52,211,153,0.35);
        color: var(--green);
        padding: 3px 10px;
        border-radius: 999px;
    }

    .mpemasukan-close {
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

    .mpemasukan-close:hover { background: rgba(255,255,255,0.2); }

    .mpemasukan-body {
        padding: 28px;
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .mpemasukan-field { display: flex; flex-direction: column; gap: 7px; }

    .mpemasukan-label {
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: 1.8px;
        text-transform: uppercase;
        color: var(--muted);
    }

    .mpemasukan-input {
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

    select.mpemasukan-input {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236b6882' stroke-width='2.5'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        padding-right: 36px;
    }

    .mpemasukan-input:focus {
        background: var(--paper);
        border-color: var(--green);
        box-shadow: 0 0 0 3px rgba(52,211,153,0.14);
    }

    .mpemasukan-footer {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
        padding: 20px 28px;
        background: var(--surface);
        border-top: 1px solid rgba(0,0,0,0.06);
    }

    .mpemasukan-btn-save {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 11px 24px;
        background: var(--green);
        color: var(--ink);
        font-family: 'Sora', sans-serif;
        font-size: 13px;
        font-weight: 700;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.18s;
    }

    .mpemasukan-btn-save:hover {
        background: #10b981;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(52,211,153,0.35);
    }

    .mpemasukan-btn-cancel {
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

    .mpemasukan-btn-cancel:hover { background: rgba(0,0,0,0.04); color: var(--ink); }

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
        <div class="header-eyebrow">Manajemen Keuangan</div>
        <div class="header-title">
            Data Pemasukan
            <span class="header-count">{{ $pemasukan->count() }} transaksi</span>
        </div>
    </div>
    {{-- Tombol buka modal, bukan redirect --}}
    <button class="btn-add" onclick="openModal()">
        <i class="bi bi-cash-stack"></i> Tambah Pemasukan
    </button>
</div>

{{-- ── STATS ─────────────────────────────────────────── --}}
@php
    $totalPemasukan = $pemasukan->count();
    $totalNominal   = $pemasukan->sum('jumlah_bayar');
    $bulanIni       = $pemasukan->filter(fn($p) => \Carbon\Carbon::parse($p->tanggal_pemasukan)->isCurrentMonth())->count();
@endphp

<div class="stats-row">
    <div class="stat-card">
        <div class="stat-icon">💰</div>
        <div>
            <div class="stat-label">Total Transaksi</div>
            <div class="stat-value">{{ $totalPemasukan }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">📅</div>
        <div>
            <div class="stat-label">Bulan Ini</div>
            <div class="stat-value">{{ $bulanIni }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">🏦</div>
        <div>
            <div class="stat-label">Total Nominal</div>
            <div class="stat-value" style="font-size:20px;letter-spacing:-0.5px">
                Rp {{ number_format($totalNominal,0,',','.') }}
            </div>
        </div>
    </div>
</div>

{{-- ── TABLE ─────────────────────────────────────────── --}}
<div class="table-card">
    <div class="table-card-header">
        <div>
            <div class="table-card-title">Semua Data Pemasukan</div>
            <div class="table-card-sub">Riwayat transaksi pemasukan kost</div>
        </div>
    </div>

    <div style="overflow-x:auto">
        <table class="ktable">
            <thead>
                <tr>
                    <th style="padding-left:28px; width:54px">#</th>
                    <th>Penghuni</th>
                    <th>Kamar</th>
                    <th>Tanggal</th>
                    <th>Jumlah Bayar</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pemasukan as $p)
                <tr>
                    <td style="padding-left:28px">
                        <span class="row-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    </td>

                    <td>
                        <div class="name-cell">
                            <div class="avatar">{{ strtoupper(substr($p->nama_penghuni, 0, 1)) }}</div>
                            <span class="name-text">{{ $p->nama_penghuni }}</span>
                        </div>
                    </td>

                    <td>
                        <div class="room-pill">
                            <span class="room-dot"></span>
                            Kamar {{ $p->nomor_kamar }}
                        </div>
                    </td>

                    <td>
                        <span style="font-family:'JetBrains Mono',monospace; font-size:13px; color:var(--muted)">
                            {{ date('d-m-Y', strtotime($p->tanggal_pemasukan)) }}
                        </span>
                    </td>

                    <td>
                        <div class="amount-pill">
                            <i class="bi bi-cash"></i>
                            Rp {{ number_format($p->jumlah_bayar,0,',','.') }}
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">
                        <div class="empty-state">
                            <span class="empty-icon">💰</span>
                            <div class="empty-text">
                                Data pemasukan belum tersedia.<br>
                                Klik <strong>+ Tambah Pemasukan</strong> untuk memulai.
                            </div>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ── MODAL TAMBAH PEMASUKAN ───────────────────────── --}}
<div class="modal-overlay" id="modalPemasukan" onclick="handleOverlayClick(event)">
    <div class="modal-content-pemasukan">
        <form action="{{ route('pemasukan.simpan') }}" method="POST">
            @csrf

            {{-- Header --}}
            <div class="mpemasukan-header">
                <div class="mpemasukan-title">
                    <i class="bi bi-cash-stack"></i>
                    Tambah Pemasukan Baru
                    <span class="mpemasukan-tag">Baru</span>
                </div>
                <button type="button" class="mpemasukan-close" onclick="closeModal()">✕</button>
            </div>

            {{-- Body --}}
            <div class="mpemasukan-body">

                <div class="mpemasukan-field">
                    <label class="mpemasukan-label">Sewa</label>
                    <select name="id_sewa" class="mpemasukan-input" required>
                        <option value="" disabled selected>— Pilih sewa —</option>
                        @foreach ($sewa as $s)
                            <option value="{{ $s->id_sewa }}">
                                {{ $s->nama_penghuni }} — Kamar {{ $s->nomor_kamar }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mpemasukan-field">
                    <label class="mpemasukan-label">Tanggal Pemasukan</label>
                    <input type="date" name="tanggal_pemasukan" class="mpemasukan-input" required>
                </div>

                <div class="mpemasukan-field">
                    <label class="mpemasukan-label">Jumlah Bayar</label>
                    <input type="number" name="jumlah_bayar" class="mpemasukan-input"
                           placeholder="Contoh: 750000" min="0" required>
                </div>

            </div>

            {{-- Footer --}}
            <div class="mpemasukan-footer">
                <button type="button" class="mpemasukan-btn-cancel" onclick="closeModal()">Batal</button>
                <button type="submit" class="mpemasukan-btn-save">
                    <i class="bi bi-check-lg"></i> Simpan Pemasukan
                </button>
            </div>

        </form>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('modalPemasukan').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('modalPemasukan').classList.remove('active');
        document.body.style.overflow = '';
    }

    // Klik di luar modal → tutup
    function handleOverlayClick(e) {
        if (e.target === document.getElementById('modalPemasukan')) {
            closeModal();
        }
    }

    // Tekan Escape → tutup
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModal();
    });
</script>

@endsection