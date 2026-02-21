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
        --red:      #f87171;
        --red-deep: #ef4444;
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
            radial-gradient(ellipse 55% 90% at 95% 5%,  rgba(248,113,113,0.22) 0%, transparent 60%),
            radial-gradient(ellipse 40% 60% at 5%  95%, rgba(255,137,6,0.14)  0%, transparent 60%);
        pointer-events: none;
    }

    .header-eyebrow {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: var(--red);
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
        background: rgba(248,113,113,0.15);
        border: 1px solid rgba(248,113,113,0.3);
        color: var(--red);
        padding: 3px 12px;
        border-radius: 999px;
    }

    .btn-add {
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 22px;
        background: var(--red);
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
        background: var(--red-deep);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(248,113,113,0.35);
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

    .stat-card:nth-child(1)::after { background: var(--red); }
    .stat-card:nth-child(2)::after { background: #fb923c; }
    .stat-card:nth-child(3)::after { background: #a78bfa; }

    .stat-icon {
        width: 48px; height: 48px;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .stat-card:nth-child(1) .stat-icon { background: rgba(248,113,113,0.12); }
    .stat-card:nth-child(2) .stat-icon { background: rgba(251,146,60,0.12); }
    .stat-card:nth-child(3) .stat-icon { background: rgba(167,139,250,0.12); }

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
    .ktable tbody tr:hover { background: rgba(248,113,113,0.04); }

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

    .jenis-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(248,113,113,0.08);
        border: 1px solid rgba(248,113,113,0.2);
        border-radius: 8px;
        padding: 5px 12px;
        font-size: 13px;
        font-weight: 600;
        color: var(--ink);
    }

    .jenis-dot {
        width: 7px; height: 7px;
        border-radius: 50%;
        background: var(--red);
        display: inline-block;
        flex-shrink: 0;
    }

    .nominal-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(248,113,113,0.10);
        border: 1px solid rgba(248,113,113,0.25);
        border-radius: 999px;
        padding: 5px 14px;
        font-size: 13px;
        font-weight: 700;
        font-family: 'JetBrains Mono', monospace;
        color: #dc2626;
    }

    .empty-state {
        text-align: center;
        padding: 64px 32px;
        color: var(--muted);
    }

    .empty-icon { font-size: 48px; opacity: 0.25; display: block; margin-bottom: 16px; }
    .empty-text { font-size: 14px; }

    /* ─── MODAL PENGELUARAN ──────────────────────────── */
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

    .modal-overlay.active { display: flex; }

    .modal-content-pengeluaran {
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

    .mpengeluaran-header {
        background: var(--ink);
        padding: 22px 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
    }

    .mpengeluaran-header::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse 60% 80% at 100% 0%, rgba(248,113,113,0.25) 0%, transparent 60%);
        pointer-events: none;
    }

    .mpengeluaran-title {
        font-size: 15px;
        font-weight: 700;
        color: var(--paper);
        display: flex;
        align-items: center;
        gap: 8px;
        position: relative;
    }

    .mpengeluaran-tag {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        background: rgba(248,113,113,0.18);
        border: 1px solid rgba(248,113,113,0.35);
        color: var(--red);
        padding: 3px 10px;
        border-radius: 999px;
    }

    .mpengeluaran-close {
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

    .mpengeluaran-close:hover { background: rgba(255,255,255,0.2); }

    .mpengeluaran-body {
        padding: 28px;
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .mpengeluaran-field { display: flex; flex-direction: column; gap: 7px; }

    .mpengeluaran-label {
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: 1.8px;
        text-transform: uppercase;
        color: var(--muted);
    }

    .mpengeluaran-input {
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

    select.mpengeluaran-input {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236b6882' stroke-width='2.5'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        padding-right: 36px;
    }

    .mpengeluaran-input:focus {
        background: var(--paper);
        border-color: var(--red);
        box-shadow: 0 0 0 3px rgba(248,113,113,0.14);
    }

    .mpengeluaran-footer {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
        padding: 20px 28px;
        background: var(--surface);
        border-top: 1px solid rgba(0,0,0,0.06);
    }

    .mpengeluaran-btn-save {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 11px 24px;
        background: var(--red);
        color: var(--ink);
        font-family: 'Sora', sans-serif;
        font-size: 13px;
        font-weight: 700;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.18s;
    }

    .mpengeluaran-btn-save:hover {
        background: var(--red-deep);
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(248,113,113,0.35);
    }

    .mpengeluaran-btn-cancel {
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

    .mpengeluaran-btn-cancel:hover { background: rgba(0,0,0,0.04); color: var(--ink); }

    /* ─── ANIMATIONS ─────────────────────────────────── */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeField {
        from { opacity: 0; transform: translateY(-6px); }
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
            Data Pengeluaran
            <span class="header-count">{{ $pengeluaran->count() }} transaksi</span>
        </div>
    </div>
    {{-- Tombol buka modal, bukan redirect --}}
    <button class="btn-add" onclick="openModal()">
        <i class="bi bi-wallet2"></i> Tambah Pengeluaran
    </button>
</div>

{{-- ── STATS ─────────────────────────────────────────── --}}
@php
    $totalTransaksi = $pengeluaran->count();
    $totalNominal   = $pengeluaran->sum('nominal');
    $jenisTerbanyak = $pengeluaran->groupBy('jenis_pengeluaran')
                        ->map->count()
                        ->sortDesc()
                        ->keys()
                        ->first() ?? '-';
@endphp

<div class="stats-row">
    <div class="stat-card">
        <div class="stat-icon">🧾</div>
        <div>
            <div class="stat-label">Total Transaksi</div>
            <div class="stat-value">{{ $totalTransaksi }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">💸</div>
        <div>
            <div class="stat-label">Total Nominal</div>
            <div class="stat-value" style="font-size:20px;letter-spacing:-0.5px">
                Rp {{ number_format($totalNominal,0,',','.') }}
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">📊</div>
        <div>
            <div class="stat-label">Jenis Terbanyak</div>
            <div class="stat-value" style="font-size:15px;letter-spacing:-0.3px;line-height:1.3;font-family:'Sora',sans-serif">
                {{ $jenisTerbanyak }}
            </div>
        </div>
    </div>
</div>

{{-- ── TABLE ─────────────────────────────────────────── --}}
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
                    <th style="padding-left:28px; width:54px">#</th>
                    <th>Tanggal</th>
                    <th>Jenis Pengeluaran</th>
                    <th>Nominal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pengeluaran as $p)
                <tr>
                    <td style="padding-left:28px">
                        <span class="row-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    </td>

                    <td>
                        <span style="font-family:'JetBrains Mono',monospace; font-size:13px; color:var(--muted)">
                            {{ date('d-m-Y', strtotime($p->tanggal)) }}
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
                            <i class="bi bi-dash-circle"></i>
                            Rp {{ number_format($p->nominal,0,',','.') }}
                        </div>
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

{{-- ── MODAL TAMBAH PENGELUARAN ─────────────────────── --}}
<div class="modal-overlay" id="modalPengeluaran" onclick="handleOverlayClick(event)">
    <div class="modal-content-pengeluaran">
        <form action="{{ route('pengeluaran.simpan') }}" method="POST">
            @csrf

            {{-- Header --}}
            <div class="mpengeluaran-header">
                <div class="mpengeluaran-title">
                    <i class="bi bi-wallet2"></i>
                    Tambah Pengeluaran Baru
                    <span class="mpengeluaran-tag">Baru</span>
                </div>
                <button type="button" class="mpengeluaran-close" onclick="closeModal()">✕</button>
            </div>

            {{-- Body --}}
            <div class="mpengeluaran-body">

                <div class="mpengeluaran-field">
                    <label class="mpengeluaran-label">Tanggal Pengeluaran</label>
                    <input type="date" name="tanggal" class="mpengeluaran-input" required>
                </div>

                <div class="mpengeluaran-field">
                    <label class="mpengeluaran-label">Jenis Pengeluaran</label>
                    <select name="jenis_pengeluaran" id="jenisSelect" class="mpengeluaran-input" required onchange="toggleKeterangan(this)">
                        <option value="" disabled selected>— Pilih jenis —</option>
                        <option value="Listrik">Listrik</option>
                        <option value="Air">Air</option>
                        <option value="Internet">Internet</option>
                        <option value="Kebersihan">Kebersihan</option>
                        <option value="Perbaikan">Perbaikan</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                {{-- Muncul hanya saat "Lainnya" dipilih --}}
                <div class="mpengeluaran-field" id="fieldKeterangan" style="display:none;">
                    <label class="mpengeluaran-label">Keterangan <span style="color:var(--red)">*</span></label>
                    <input type="text" name="keterangan" id="inputKeterangan"
                           class="mpengeluaran-input"
                           placeholder="Tuliskan keterangan pengeluaran...">
                </div>

                <div class="mpengeluaran-field">
                    <label class="mpengeluaran-label">Nominal</label>
                    <input type="number" name="nominal" class="mpengeluaran-input"
                           placeholder="Contoh: 150000" min="0" required>
                </div>

            </div>

            {{-- Footer --}}
            <div class="mpengeluaran-footer">
                <button type="button" class="mpengeluaran-btn-cancel" onclick="closeModal()">Batal</button>
                <button type="submit" class="mpengeluaran-btn-save">
                    <i class="bi bi-check-lg"></i> Simpan Pengeluaran
                </button>
            </div>

        </form>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('modalPengeluaran').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('modalPengeluaran').classList.remove('active');
        document.body.style.overflow = '';
        // Reset field keterangan saat modal ditutup
        document.getElementById('jenisSelect').value = '';
        document.getElementById('fieldKeterangan').style.display = 'none';
        document.getElementById('inputKeterangan').value = '';
        document.getElementById('inputKeterangan').required = false;
    }

    function toggleKeterangan(select) {
        const field = document.getElementById('fieldKeterangan');
        const input = document.getElementById('inputKeterangan');
        if (select.value === 'Lainnya') {
            field.style.display = 'flex';
            field.style.animation = 'fadeField 0.2s ease both';
            input.required = true;
            input.focus();
        } else {
            field.style.display = 'none';
            input.required = false;
            input.value = '';
        }
    }

    function handleOverlayClick(e) {
        if (e.target === document.getElementById('modalPengeluaran')) {
            closeModal();
        }
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModal();
    });
</script>

@endsection