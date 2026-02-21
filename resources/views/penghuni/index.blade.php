@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --ink:      #0f0e17;
        --ink-soft: #252333;
        --paper:    #fffffe;
        --surface:  #f5f5f7;
        --muted:    #6b6882;
        --muted-lt: #a7a9be;
        --accent:   #ff8906;
        --accent2:  #e53170;
        --green:    #3da35d;
        --blue:     #60a5fa;   /* ← warna khusus halaman Penghuni */
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

    .header-count {
        font-size: 13px;
        font-weight: 700;
        font-family: 'JetBrains Mono', monospace;
        background: rgba(96,165,250,0.15);
        border: 1px solid rgba(96,165,250,0.3);
        color: var(--blue);
        padding: 3px 12px;
        border-radius: 999px;
    }

    .btn-add {
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 22px;
        background: var(--blue);
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
        background: #3b82f6;
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(96,165,250,0.35);
        color: var(--ink);
    }

    /* ─── STAT CARDS ─────────────────────────────────── */
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

    .stat-card:nth-child(1)::after { background: var(--blue); }
    .stat-card:nth-child(2)::after { background: #34d399; }
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

    .stat-card:nth-child(1) .stat-icon { background: rgba(96,165,250,0.12); }
    .stat-card:nth-child(2) .stat-icon { background: rgba(52,211,153,0.12); }
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

    /* Table */
    .ktable { width: 100%; border-collapse: collapse; }

    .ktable thead tr { background: var(--surface); }

    .ktable thead th {
        padding: 14px 16px;
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
    .ktable tbody tr:hover { background: rgba(96,165,250,0.04); }

    .ktable tbody td {
        padding: 14px 16px;
        font-size: 14px;
        vertical-align: middle;
    }

    /* Avatar */
    .avatar {
        width: 36px; height: 36px;
        border-radius: 10px;
        background: rgba(96,165,250,0.12);
        border: 1.5px solid rgba(96,165,250,0.25);
        color: var(--blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 800;
        flex-shrink: 0;
        font-family: 'JetBrains Mono', monospace;
    }

    .name-cell {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .name-text {
        font-weight: 700;
        font-size: 14px;
        color: var(--ink);
    }

    /* KTP mono */
    .ktp-text {
        font-family: 'JetBrains Mono', monospace;
        font-size: 12px;
        color: var(--muted);
        letter-spacing: 0.5px;
    }

    /* Phone */
    .phone-text {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 13px;
        color: #34d399;
        font-weight: 600;
    }

    /* Address */
    .addr-text {
        font-size: 12.5px;
        color: var(--muted);
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Date badge */
    .date-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 11px;
        border-radius: 8px;
        font-size: 11.5px;
        font-weight: 600;
        font-family: 'JetBrains Mono', monospace;
        background: rgba(96,165,250,0.08);
        border: 1px solid rgba(96,165,250,0.18);
        color: var(--blue);
    }

    /* Action buttons */
    .btn-edit {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 7px 13px;
        background: rgba(255,137,6,0.10);
        border: 1px solid rgba(255,137,6,0.25);
        color: var(--accent);
        border-radius: 9px;
        font-size: 12px;
        font-weight: 600;
        font-family: 'Sora', sans-serif;
        cursor: pointer;
        transition: all 0.15s;
        text-decoration: none;
    }

    .btn-edit:hover {
        background: rgba(255,137,6,0.18);
        border-color: rgba(255,137,6,0.4);
        color: var(--accent);
    }

    .btn-del {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 7px 13px;
        background: rgba(229,49,112,0.08);
        border: 1px solid rgba(229,49,112,0.2);
        color: var(--accent2);
        border-radius: 9px;
        font-size: 12px;
        font-weight: 600;
        font-family: 'Sora', sans-serif;
        cursor: pointer;
        transition: all 0.15s;
        text-decoration: none;
        margin-left: 6px;
    }

    .btn-del:hover {
        background: rgba(229,49,112,0.16);
        border-color: rgba(229,49,112,0.4);
        color: var(--accent2);
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 64px 32px;
        color: var(--muted);
    }

    .empty-icon { font-size: 48px; opacity: 0.25; display: block; margin-bottom: 16px; }
    .empty-text { font-size: 14px; }

    /* ─── MODAL ──────────────────────────────────────── */
    /* Modal dipindah ke #modal-root di <body> via JS teleport di layout,
       sehingga position:fixed = full viewport tanpa offset sidebar. */
    .modal-content {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,0.2);
    }

    .modal-header {
        background: var(--ink);
        border-bottom: none;
        padding: 22px 28px;
        position: relative;
        overflow: hidden;
    }

    .modal-header::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse 60% 80% at 100% 0%, rgba(96,165,250,0.22) 0%, transparent 60%);
        pointer-events: none;
    }

    .modal-title {
        font-size: 15px;
        font-weight: 700;
        color: var(--paper);
        display: flex;
        align-items: center;
        gap: 8px;
        position: relative;
    }

    .modal-title .mtag {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        background: rgba(96,165,250,0.15);
        border: 1px solid rgba(96,165,250,0.3);
        color: var(--blue);
        padding: 3px 10px;
        border-radius: 999px;
    }

    .btn-close-custom {
        background: rgba(255,255,255,0.1);
        border: none;
        width: 32px; height: 32px;
        border-radius: 8px;
        color: var(--paper);
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.15s;
        margin-left: auto;
        position: relative;
    }

    .btn-close-custom:hover { background: rgba(255,255,255,0.18); }

    .modal-body {
        padding: 28px;
        background: var(--paper);
    }

    .form-label-custom {
        font-size: 10.5px;
        font-weight: 700;
        letter-spacing: 1.8px;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 8px;
        display: block;
    }

    .form-label-custom .opt {
        font-size: 10px;
        text-transform: none;
        letter-spacing: 0;
        font-weight: 400;
        color: var(--muted-lt);
    }

    .form-control-custom {
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
    }

    .form-control-custom:focus {
        background: var(--paper);
        border-color: var(--blue);
        box-shadow: 0 0 0 3px rgba(96,165,250,0.12);
    }

    textarea.form-control-custom { resize: vertical; min-height: 80px; }

    .form-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    @media (max-width: 480px) { .form-grid-2 { grid-template-columns: 1fr; } }

    .modal-footer-custom {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
        padding: 20px 28px;
        background: var(--surface);
        border-top: 1px solid rgba(0,0,0,0.06);
    }

    .btn-modal-save {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 11px 24px;
        background: var(--blue);
        color: var(--ink);
        font-family: 'Sora', sans-serif;
        font-size: 13px;
        font-weight: 700;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.18s;
    }

    .btn-modal-save:hover {
        background: #3b82f6;
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(96,165,250,0.35);
    }

    .btn-modal-cancel {
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

    .btn-modal-cancel:hover { background: rgba(0,0,0,0.04); color: var(--ink); }

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
        <div class="header-eyebrow">Manajemen Penghuni</div>
        <div class="header-title">
            Data Penghuni
            <span class="header-count">{{ $penghuni->count() }} orang</span>
        </div>
    </div>
    <button class="btn-add" data-bs-toggle="modal" data-bs-target="#tambahPenghuniModal">
        <i class="bi bi-person-plus-fill"></i> Tambah Penghuni
    </button>
</div>

{{-- ── STATS ─────────────────────────────────────────── --}}
@php
    $totalPenghuni = $penghuni->count();
    $penghuniBaru  = $penghuni->filter(fn($p) => \Carbon\Carbon::parse($p->tanggal_masuk)->isCurrentMonth())->count();
    $penghuniLama  = $penghuni->filter(fn($p) => \Carbon\Carbon::parse($p->tanggal_masuk)->diffInMonths(now()) >= 6)->count();
@endphp

<div class="stats-row">
    <div class="stat-card">
        <div class="stat-icon">👥</div>
        <div>
            <div class="stat-label">Total Penghuni</div>
            <div class="stat-value">{{ $totalPenghuni }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">🆕</div>
        <div>
            <div class="stat-label">Masuk Bulan Ini</div>
            <div class="stat-value">{{ $penghuniBaru }}</div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">⭐</div>
        <div>
            <div class="stat-label">Penghuni ≥ 6 Bln</div>
            <div class="stat-value">{{ $penghuniLama }}</div>
        </div>
    </div>
</div>

{{-- ── TABLE ─────────────────────────────────────────── --}}
<div class="table-card">
    <div class="table-card-header">
        <div>
            <div class="table-card-title">Semua Penghuni</div>
            <div class="table-card-sub">Data identitas dan informasi hunian</div>
        </div>
    </div>

    <div style="overflow-x:auto">
        <table class="ktable">
            <thead>
                <tr>
                    <th style="padding-left:28px; width:50px">#</th>
                    <th>Nama Penghuni</th>
                    <th>No KTP</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                    <th>Tanggal Masuk</th>
                    <th style="text-align:right; padding-right:28px; width:175px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($penghuni as $p)
                <tr>
                    <td style="padding-left:28px">
                        <span style="font-size:12px;font-family:'JetBrains Mono',monospace;color:var(--muted-lt)">
                            {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                        </span>
                    </td>

                    <td>
                        <div class="name-cell">
                            <div class="avatar">{{ strtoupper(substr($p->nama_penghuni, 0, 1)) }}</div>
                            <span class="name-text">{{ $p->nama_penghuni }}</span>
                        </div>
                    </td>

                    <td><span class="ktp-text">{{ $p->no_ktp }}</span></td>

                    <td>
                        <span class="phone-text">
                            <i class="bi bi-telephone-fill" style="font-size:11px"></i>
                            {{ $p->no_hp }}
                        </span>
                    </td>

                    <td>
                        <span class="addr-text" title="{{ $p->alamat_penghuni }}">
                            {{ Str::limit($p->alamat_penghuni, 35) }}
                        </span>
                    </td>

                    <td>
                        <span class="date-badge">
                            <i class="bi bi-calendar3"></i>
                            {{ date('d M Y', strtotime($p->tanggal_masuk)) }}
                        </span>
                    </td>

                    <td style="text-align:right; padding-right:28px">
                        <button class="btn-edit"
                                data-bs-toggle="modal"
                                data-bs-target="#editPenghuniModal{{ $p->id_penghuni }}">
                            <i class="bi bi-pencil-fill"></i> Edit
                        </button>
                        <a href="{{ route('penghuni.hapus', $p->id_penghuni) }}"
                           class="btn-del"
                           onclick="return confirm('Yakin ingin menghapus data ini?')">
                            <i class="bi bi-trash3"></i> Hapus
                        </a>
                    </td>
                </tr>

                {{-- ── MODAL EDIT ── --}}
                <div class="modal fade" id="editPenghuniModal{{ $p->id_penghuni }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form action="{{ route('penghuni.update', $p->id_penghuni) }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <div class="modal-title">
                                        <i class="bi bi-pencil-square"></i>
                                        Edit Penghuni
                                        <span class="mtag">Penghuni</span>
                                    </div>
                                    <button type="button" class="btn-close-custom" data-bs-dismiss="modal">✕</button>
                                </div>

                                <div class="modal-body">
                                    <div style="margin-bottom:16px">
                                        <label class="form-label-custom">Nama Penghuni</label>
                                        <input type="text" name="nama_penghuni"
                                               class="form-control-custom"
                                               value="{{ $p->nama_penghuni }}" required>
                                    </div>

                                    <div style="margin-bottom:16px">
                                        <label class="form-label-custom">No KTP</label>
                                        <input type="text" name="no_ktp"
                                               class="form-control-custom"
                                               value="{{ $p->no_ktp }}" maxlength="16" required>
                                    </div>

                                    <div class="form-grid-2" style="margin-bottom:16px">
                                        <div>
                                            <label class="form-label-custom">No HP</label>
                                            <input type="text" name="no_hp"
                                                   class="form-control-custom"
                                                   value="{{ $p->no_hp }}" required>
                                        </div>
                                        <div>
                                            <label class="form-label-custom">Tanggal Masuk</label>
                                            <input type="date" name="tanggal_masuk"
                                                   class="form-control-custom"
                                                   value="{{ $p->tanggal_masuk }}" required>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="form-label-custom">Alamat</label>
                                        <textarea name="alamat_penghuni"
                                                  class="form-control-custom">{{ $p->alamat_penghuni }}</textarea>
                                    </div>
                                </div>

                                <div class="modal-footer-custom">
                                    <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn-modal-save">
                                        <i class="bi bi-check-lg"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <span class="empty-icon">👥</span>
                            <div class="empty-text">
                                Belum ada data penghuni.<br>
                                Klik <strong>+ Tambah Penghuni</strong> untuk memulai.
                            </div>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ── MODAL TAMBAH ──────────────────────────────────── --}}
<div class="modal fade" id="tambahPenghuniModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('penghuni.simpan') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <div class="modal-title">
                        <i class="bi bi-person-plus-fill"></i>
                        Tambah Penghuni Baru
                        <span class="mtag">Baru</span>
                    </div>
                    <button type="button" class="btn-close-custom" data-bs-dismiss="modal">✕</button>
                </div>

                <div class="modal-body">
                    <div style="margin-bottom:16px">
                        <label class="form-label-custom">Nama Penghuni</label>
                        <input type="text" name="nama_penghuni"
                               class="form-control-custom"
                               placeholder="Masukkan nama lengkap" required>
                    </div>

                    <div style="margin-bottom:16px">
                        <label class="form-label-custom">No KTP</label>
                        <input type="text" name="no_ktp"
                               class="form-control-custom"
                               placeholder="327xxxxxxxxx" maxlength="16" required>
                    </div>

                    <div class="form-grid-2" style="margin-bottom:16px">
                        <div>
                            <label class="form-label-custom">No HP</label>
                            <input type="text" name="no_hp"
                                   class="form-control-custom"
                                   placeholder="08xxxxxxxxxx" required>
                        </div>
                        <div>
                            <label class="form-label-custom">Tanggal Masuk</label>
                            <input type="date" name="tanggal_masuk"
                                   class="form-control-custom" required>
                        </div>
                    </div>

                    <div>
                        <label class="form-label-custom">
                            Alamat <span class="opt">(opsional)</span>
                        </label>
                        <textarea name="alamat_penghuni"
                                  class="form-control-custom"
                                  placeholder="Alamat lengkap penghuni"></textarea>
                    </div>
                </div>

                <div class="modal-footer-custom">
                    <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-modal-save">
                        <i class="bi bi-check-lg"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection