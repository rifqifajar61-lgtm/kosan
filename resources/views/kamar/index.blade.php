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
        --blue:     #0ea5e9;
    }

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
            radial-gradient(ellipse 55% 90% at 95% 5%,  rgba(74,222,128,0.20) 0%, transparent 60%),
            radial-gradient(ellipse 40% 60% at 5%  95%, rgba(255,137,6,0.15)  0%, transparent 60%);
        pointer-events: none;
    }

    .header-eyebrow {
        font-size: 10px; font-weight: 700; letter-spacing: 3px;
        text-transform: uppercase; color: #4ade80; margin-bottom: 6px;
    }

    .header-title {
        position: relative; font-size: 28px; font-weight: 800;
        color: var(--paper); letter-spacing: -0.8px; line-height: 1.1;
        display: flex; align-items: center; gap: 10px;
    }

    .header-count {
        font-size: 13px; font-weight: 700;
        font-family: 'JetBrains Mono', monospace;
        background: rgba(74,222,128,0.15);
        border: 1px solid rgba(74,222,128,0.3);
        color: #4ade80; padding: 3px 12px; border-radius: 999px;
    }

    .btn-add {
        position: relative; display: inline-flex; align-items: center; gap: 8px;
        padding: 12px 22px; background: #4ade80; color: var(--ink);
        font-family: 'Sora', sans-serif; font-size: 13px; font-weight: 700;
        border: none; border-radius: 12px; cursor: pointer;
        white-space: nowrap; transition: all 0.18s ease;
        flex-shrink: 0; text-decoration: none;
    }

    .btn-add:hover {
        background: #22c55e; transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(74,222,128,0.35); color: var(--ink);
    }

    .stats-row {
        display: grid; grid-template-columns: repeat(3, 1fr);
        gap: 16px; margin-bottom: 28px;
    }

    @media (max-width: 768px) { .stats-row { grid-template-columns: 1fr; } }

    .stat-card {
        background: var(--paper); border-radius: 16px; padding: 22px 24px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 8px 24px rgba(0,0,0,0.06);
        display: flex; align-items: center; gap: 16px;
        position: relative; overflow: hidden;
        transition: transform 0.18s ease, box-shadow 0.18s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 6px rgba(0,0,0,0.05), 0 16px 40px rgba(0,0,0,0.1);
    }

    .stat-card::after {
        content: ''; position: absolute; bottom: 0; left: 0; right: 0;
        height: 3px; border-radius: 0 0 16px 16px;
    }

    .stat-card:nth-child(1)::after { background: #4ade80; }
    .stat-card:nth-child(2)::after { background: var(--green); }
    .stat-card:nth-child(3)::after { background: var(--blue); }

    .stat-icon {
        width: 48px; height: 48px; border-radius: 13px;
        display: flex; align-items: center; justify-content: center;
        font-size: 20px; flex-shrink: 0;
    }

    .stat-card:nth-child(1) .stat-icon { background: rgba(74,222,128,0.12); }
    .stat-card:nth-child(2) .stat-icon { background: rgba(61,163,93,0.12); }
    .stat-card:nth-child(3) .stat-icon { background: rgba(14,165,233,0.12); }

    .stat-label {
        font-size: 10.5px; font-weight: 700; letter-spacing: 1.8px;
        text-transform: uppercase; color: var(--muted); margin-bottom: 4px;
    }

    .stat-value {
        font-size: 30px; font-weight: 800; color: var(--ink);
        letter-spacing: -1.5px; line-height: 1;
        font-family: 'JetBrains Mono', monospace;
    }

    .stat-value.sm { font-size: 20px; letter-spacing: -0.5px; }

    .table-card {
        background: var(--paper); border-radius: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 8px 24px rgba(0,0,0,0.06);
        overflow: hidden;
    }

    .table-card-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 20px 28px; border-bottom: 1px solid rgba(0,0,0,0.06);
    }

    .table-card-title { font-size: 14px; font-weight: 700; color: var(--ink); }
    .table-card-sub   { font-size: 12px; color: var(--muted); margin-top: 2px; }

    .ktable { width: 100%; border-collapse: collapse; }
    .ktable thead tr { background: var(--surface); }

    .ktable thead th {
        padding: 14px 20px; font-size: 10.5px; font-weight: 700;
        letter-spacing: 1.8px; text-transform: uppercase; color: var(--muted);
        border-bottom: 1px solid rgba(0,0,0,0.07); white-space: nowrap;
    }

    .ktable tbody tr { border-bottom: 1px solid rgba(0,0,0,0.05); transition: background 0.15s; }
    .ktable tbody tr:last-child { border-bottom: none; }
    .ktable tbody tr:hover { background: rgba(74,222,128,0.04); }

    .ktable tbody td { padding: 16px 20px; font-size: 14px; vertical-align: middle; }

    .row-num { font-size: 12px; font-family: 'JetBrains Mono', monospace; color: var(--muted-lt); }

    .room-pill {
        display: inline-flex; align-items: center; gap: 7px;
        background: rgba(74,222,128,0.08); border: 1px solid rgba(74,222,128,0.2);
        border-radius: 10px; padding: 6px 14px; font-weight: 700;
        font-size: 14px; color: var(--ink); font-family: 'JetBrains Mono', monospace;
    }

    .room-dot { width: 8px; height: 8px; border-radius: 50%; background: #4ade80; display: inline-block; }

    .price-main { font-weight: 800; font-size: 15px; font-family: 'JetBrains Mono', monospace; color: var(--ink); }
    .price-sub  { font-size: 11px; color: var(--muted); margin-top: 2px; }

    .f-badge {
        display: inline-block; padding: 3px 10px; border-radius: 6px;
        font-size: 11px; font-weight: 600; background: var(--surface);
        border: 1px solid rgba(0,0,0,0.08); color: var(--ink);
        margin: 2px 2px 2px 0;
    }

    .btn-edit {
        display: inline-flex; align-items: center; gap: 5px; padding: 7px 14px;
        background: rgba(255,137,6,0.1); border: 1px solid rgba(255,137,6,0.25);
        color: var(--accent); border-radius: 9px; font-size: 12px; font-weight: 600;
        cursor: pointer; transition: all 0.15s; text-decoration: none;
    }

    .btn-edit:hover { background: rgba(255,137,6,0.18); border-color: rgba(255,137,6,0.4); color: var(--accent); }

    .btn-del {
        display: inline-flex; align-items: center; gap: 5px; padding: 7px 14px;
        background: rgba(229,49,112,0.08); border: 1px solid rgba(229,49,112,0.2);
        color: var(--accent2); border-radius: 9px; font-size: 12px; font-weight: 600;
        cursor: pointer; transition: all 0.15s; text-decoration: none;
    }

    .btn-del:hover { background: rgba(229,49,112,0.16); border-color: rgba(229,49,112,0.4); color: var(--accent2); }

    .empty-state { text-align: center; padding: 64px 32px; color: var(--muted); }
    .empty-icon  { font-size: 48px; opacity: 0.25; display: block; margin-bottom: 16px; }
    .empty-text  { font-size: 14px; }
    .empty-text strong { color: var(--ink); }

    /* Modal Edit */
    .modal-content { border: none; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.2); }
    .modal-header  { background: var(--ink); border-bottom: none; padding: 22px 28px; position: relative; overflow: hidden; }
    .modal-header::before {
        content: ''; position: absolute; inset: 0;
        background: radial-gradient(ellipse 60% 80% at 100% 0%, rgba(74,222,128,0.2) 0%, transparent 60%);
        pointer-events: none;
    }
    .modal-title { font-size: 15px; font-weight: 700; color: var(--paper); display: flex; align-items: center; gap: 8px; }
    .modal-title .mtag {
        font-size: 10px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase;
        background: rgba(74,222,128,0.15); border: 1px solid rgba(74,222,128,0.3);
        color: #4ade80; padding: 3px 10px; border-radius: 999px;
    }
    .btn-close-custom {
        background: rgba(255,255,255,0.1); border: none; width: 32px; height: 32px;
        border-radius: 8px; color: var(--paper); font-size: 16px;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; transition: background 0.15s;
    }
    .btn-close-custom:hover { background: rgba(255,255,255,0.18); }
    .modal-body { padding: 28px; background: var(--paper); }
    .form-label-custom {
        font-size: 10.5px; font-weight: 700; letter-spacing: 1.8px;
        text-transform: uppercase; color: var(--muted); margin-bottom: 8px; display: block;
    }
    .form-control-custom {
        width: 100%; padding: 11px 14px; background: var(--surface);
        border: 1.5px solid transparent; border-radius: 10px;
        font-family: 'Sora', sans-serif; font-size: 14px; color: var(--ink);
        transition: all 0.18s; outline: none;
    }
    .form-control-custom:focus { background: var(--paper); border-color: #4ade80; box-shadow: 0 0 0 3px rgba(74,222,128,0.12); }
    textarea.form-control-custom { resize: vertical; min-height: 100px; }
    .input-group-custom {
        display: flex; border-radius: 10px; overflow: hidden;
        border: 1.5px solid transparent; transition: all 0.18s; background: var(--surface);
    }
    .input-group-custom:focus-within { background: var(--paper); border-color: #4ade80; box-shadow: 0 0 0 3px rgba(74,222,128,0.12); }
    .input-prefix {
        padding: 11px 14px; font-size: 13px; font-weight: 700; color: var(--muted);
        background: transparent; border-right: 1.5px solid rgba(0,0,0,0.08);
        white-space: nowrap; font-family: 'JetBrains Mono', monospace;
    }
    .input-group-custom input {
        flex: 1; border: none; padding: 11px 14px; background: transparent;
        font-family: 'Sora', sans-serif; font-size: 14px; color: var(--ink); outline: none;
    }
    .modal-footer-custom {
        display: flex; gap: 10px; justify-content: flex-end;
        padding: 20px 28px; background: var(--surface); border-top: 1px solid rgba(0,0,0,0.06);
    }
    .btn-modal-save {
        display: inline-flex; align-items: center; gap: 7px; padding: 11px 24px;
        background: #4ade80; color: var(--ink); font-family: 'Sora', sans-serif;
        font-size: 13px; font-weight: 700; border: none; border-radius: 10px;
        cursor: pointer; transition: all 0.18s;
    }
    .btn-modal-save:hover { background: #22c55e; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(74,222,128,0.35); }
    .btn-modal-cancel {
        display: inline-flex; align-items: center; padding: 11px 20px;
        background: transparent; color: var(--muted); font-family: 'Sora', sans-serif;
        font-size: 13px; font-weight: 600; border: 1.5px solid rgba(0,0,0,0.1);
        border-radius: 10px; cursor: pointer; transition: all 0.18s;
    }
    .btn-modal-cancel:hover { background: rgba(0,0,0,0.04); color: var(--ink); }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .page-header            { animation: fadeUp 0.45s ease both; }
    .stat-card:nth-child(1) { animation: fadeUp 0.45s 0.08s ease both; }
    .stat-card:nth-child(2) { animation: fadeUp 0.45s 0.13s ease both; }
    .stat-card:nth-child(3) { animation: fadeUp 0.45s 0.18s ease both; }
    .table-card             { animation: fadeUp 0.45s 0.22s ease both; }
</style>

{{-- ── HEADER ────────────────────────────────────────── --}}
<div class="page-header">
    <div style="position:relative;z-index:1">
        <div class="header-eyebrow">Manajemen Properti</div>
        <div class="header-title">
            Daftar Kamar
            <span class="header-count">{{ $kamar->count() }} unit</span>
        </div>
    </div>
    {{-- Redirect ke halaman tambah (bukan modal) --}}
    <a href="{{ route('kamar.tambah') }}" class="btn-add">
        <i class="bi bi-plus-lg"></i> Tambah Kamar
    </a>
</div>

{{-- ── STATS ─────────────────────────────────────────── --}}
@php
    $totalKamar = $kamar->count();
    $maxHarga   = $totalKamar ? $kamar->max('harga_sewa') : 0;
    $minHarga   = $totalKamar ? $kamar->min('harga_sewa') : 0;

    $singkat = function($angka) {
        if ($angka >= 1_000_000_000) return 'Rp ' . rtrim(rtrim(number_format($angka/1_000_000_000,2,',','.'), '0'), ',') . ' M';
        if ($angka >= 1_000_000)     return 'Rp ' . rtrim(rtrim(number_format($angka/1_000_000,2,',','.'), '0'), ',') . ' Jt';
        if ($angka >= 1_000)         return 'Rp ' . rtrim(rtrim(number_format($angka/1_000,2,',','.'), '0'), ',') . ' Rb';
        return 'Rp ' . number_format($angka, 0, ',', '.');
    };
@endphp

<div class="stats-row">
    <div class="stat-card">
        <div class="stat-icon">🏠</div>
        <div>
            <div class="stat-label">Total Kamar</div>
            <div class="stat-value">{{ $totalKamar }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">📉</div>
        <div>
            <div class="stat-label">Harga Terendah</div>
            <div class="stat-value sm">{{ $singkat($minHarga) }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">📈</div>
        <div>
            <div class="stat-label">Harga Tertinggi</div>
            <div class="stat-value sm">{{ $singkat($maxHarga) }}</div>
        </div>
    </div>
</div>

{{-- ── TABLE ─────────────────────────────────────────── --}}
<div class="table-card">
    <div class="table-card-header">
        <div>
            <div class="table-card-title">Semua Kamar</div>
            <div class="table-card-sub">Data lengkap unit yang tersedia</div>
        </div>
    </div>

    <div style="overflow-x:auto">
        <table class="ktable">
            <thead>
                <tr>
                    <th style="width:50px; padding-left:28px">#</th>
                    <th>Nomor Kamar</th>
                    <th>Harga Sewa</th>
                    <th>Fasilitas</th>
                    <th style="text-align:right; padding-right:28px; width:170px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kamar as $index => $item)
                <tr>
                    <td style="padding-left:28px">
                        <span class="row-num">{{ str_pad($index+1, 2, '0', STR_PAD_LEFT) }}</span>
                    </td>
                    <td>
                        <div class="room-pill">
                            <span class="room-dot"></span>
                            {{ $item->nomor_kamar }}
                        </div>
                    </td>
                    <td>
                        <div class="price-main">Rp {{ number_format($item->harga_sewa,0,',','.') }}</div>
                        <div class="price-sub">per bulan</div>
                    </td>
                    <td>
                        @php $fasilitas = explode("\n", $item->fasilitas_kamar); @endphp
                        @foreach ($fasilitas as $f)
                            @if(trim($f))<span class="f-badge">{{ trim($f) }}</span>@endif
                        @endforeach
                    </td>
                    <td style="text-align:right; padding-right:28px">
                        <button class="btn-edit"
                                data-bs-toggle="modal"
                                data-bs-target="#editKamarModal{{ $item->id_kamar }}">
                            <i class="bi bi-pencil-fill"></i> Edit
                        </button>
                        <a href="{{ route('kamar.hapus', $item->id_kamar) }}"
                           class="btn-del"
                           onclick="return confirm('Yakin hapus kamar ini?')"
                           style="margin-left:6px">
                            <i class="bi bi-trash3"></i> Hapus
                        </a>
                    </td>
                </tr>

                {{-- Modal Edit per baris --}}
                <div class="modal fade" id="editKamarModal{{ $item->id_kamar }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('kamar.update', $item->id_kamar) }}">
                                @csrf
                                <div class="modal-header">
                                    <div class="modal-title">
                                        <i class="bi bi-pencil-square"></i> Edit Kamar
                                        <span class="mtag">Edit</span>
                                    </div>
                                    <button type="button" class="btn-close-custom" data-bs-dismiss="modal">✕</button>
                                </div>
                                <div class="modal-body">
                                    <div style="margin-bottom:18px">
                                        <label class="form-label-custom">Nomor Kamar</label>
                                        <input type="text" name="nomor_kamar" class="form-control-custom"
                                               value="{{ $item->nomor_kamar }}" required>
                                    </div>
                                    <div style="margin-bottom:18px">
                                        <label class="form-label-custom">Harga Sewa</label>
                                        <div class="input-group-custom">
                                            <span class="input-prefix">Rp</span>
                                            <input type="number" name="harga_sewa" value="{{ $item->harga_sewa }}" required>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="form-label-custom">
                                            Fasilitas
                                            <span style="font-size:10px;text-transform:none;letter-spacing:0;font-weight:400;color:var(--muted-lt)">(satu per baris)</span>
                                        </label>
                                        <textarea name="fasilitas_kamar" class="form-control-custom">{{ $item->fasilitas_kamar }}</textarea>
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
                    <td colspan="5">
                        <div class="empty-state">
                            <span class="empty-icon">🚪</span>
                            <div class="empty-text">
                                Belum ada data kamar.<br>
                                Klik <strong>+ Tambah Kamar</strong> untuk memulai.
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