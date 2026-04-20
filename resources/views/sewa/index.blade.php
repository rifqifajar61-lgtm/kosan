@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="{{ asset('css/sewa.css') }}">

@php
    use Carbon\Carbon;

    $namaBulanId = [
        '01'=>'Jan','02'=>'Feb','03'=>'Mar','04'=>'Apr',
        '05'=>'Mei','06'=>'Jun','07'=>'Jul','08'=>'Agu',
        '09'=>'Sep','10'=>'Okt','11'=>'Nov','12'=>'Des',
    ];
    $fmtBulanShort = fn($ym) => $namaBulanId[substr($ym,5,2)] . ' ' . substr($ym,0,4);
@endphp

{{-- ── HEADER ── --}}
<div class="page-header">
    <div style="position:relative;z-index:1">
        <div class="header-eyebrow">Manajemen Sewa</div>
        <div class="header-title">
            Data Sewa
        </div>
    </div>
    <a href="{{ route('sewa.tambah') }}" class="btn-add">
        <i class="bi bi-receipt-cutoff"></i> Tambah Sewa
    </a>
</div>

@php
    $totalSewa      = $sewa->count();
    $sewaAktif      = $sewa->where('status', 'aktif')->count();
    $sewaNonaktif   = $sewa->where('status', '!=', 'aktif')->count();
    $sewaTelat      = $sewa->where('status_jt', 'telat')->count();
@endphp

{{-- ── SESSION ALERTS ── --}}

{{-- ── STATS ── --}}
<div class="stats-row">
    <div class="stat-card">
        <div class="stat-body">
            <div class="stat-label">Total Kontrak</div>
            <div class="stat-value">{{ $totalSewa }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-body">
            <div class="stat-label">Sewa Aktif</div>
            <div class="stat-value">{{ $sewaAktif }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-body">
            <div class="stat-label">Selesai</div>
            <div class="stat-value">{{ $sewaNonaktif }}</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-body">
            <div class="stat-label">Terlambat Bayar</div>
            <div class="stat-value stat-value--danger">{{ $sewaTelat }}</div>
        </div>
    </div>
</div>

{{-- ── TABLE ── --}}
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
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th style="text-align:center">Status</th>
                    <th style="text-align:center">Keterlambatan</th>
                    <th style="text-align:right; padding-right:28px; width:160px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sewa as $s)
                <tr class="{{ $s->status_jt === 'telat' ? 'row-telat' : '' }}">
                    <td style="padding-left:28px">
                        <span class="row-num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    </td>
                    <td>
                        <div class="name-cell">
                            <span class="name-text">{{ $s->nama_penghuni ?? optional($s->penghuni)->nama_penghuni ?? '-' }}</span>
                        </div>
                    </td>
                    <td>
                        <div class="room-pill">
                            <span class="room-dot"></span>
                            Kamar {{ $s->nomor_kamar ?? optional($s->kamar)->nomor_kamar ?? '-' }}
                        </div>
                    </td>
                    <td>
                        <span class="date-text">{{ \Carbon\Carbon::parse($s->tanggal_mulai)->format('d M Y') }}</span>
                    </td>
                    <td>
                        @if($s->tanggal_selesai)
                            <span class="date-text">{{ \Carbon\Carbon::parse($s->tanggal_selesai)->format('d M Y') }}</span>
                        @else
                            <span class="date-empty">—</span>
                        @endif
                    </td>
                    <td style="text-align:center">
                        <span class="status-pill {{ $s->status == 'aktif' ? 'status-aktif' : 'status-selesai' }}">
                            {{ ucfirst($s->status) }}
                        </span>
                    </td>

                    {{-- ── KOLOM KETERLAMBATAN ── --}}
                    <td style="text-align:center">
                        @if($s->status_jt === 'telat')
                            {{-- Ada bulan yang terlambat --}}
                            <div class="telat-cell">
                                <div class="telat-summary">
                                    <span class="telat-badge">
                                        <i class="bi bi-exclamation-triangle-fill" style="font-size:9px"></i>
                                        {{ $s->jumlah_bulan_telat }} bulan telat
                                    </span>
                                </div>
                                {{-- Tooltip bulan-bulan yang terlambat --}}
                                <div class="telat-bulan-list">
                                    @foreach($s->bulan_terlambat as $bln)
                                        <span class="telat-bulan-tag">{{ $fmtBulanShort($bln) }}</span>
                                    @endforeach
                                </div>
                                @if($s->total_denda > 0)
                                <div class="telat-denda">
                                    Rp {{ number_format($s->total_denda, 0, ',', '.') }}
                                </div>
                                @endif
                            </div>

                        @elseif($s->status_jt === 'jatuh')
                            <span class="jt-badge">
                                <i class="bi bi-alarm-fill" style="font-size:9px"></i>
                                Jatuh Tempo Hari Ini
                            </span>

                        @elseif($s->status_jt === 'lunas')
                            <span class="lunas-badge">
                                <i class="bi bi-check-circle-fill" style="font-size:9px"></i>
                                Lunas
                            </span>

                        @elseif($s->status_jt === 'selesai')
                            <span class="selesai-badge">
                                <i class="bi bi-archive-fill" style="font-size:9px"></i>
                                Selesai
                            </span>

                        @else
                            {{-- Aman / belum jatuh tempo --}}
                            <span class="aman-badge">
                                <i class="bi bi-shield-check-fill" style="font-size:9px"></i>
                                Tepat Waktu
                            </span>
                        @endif
                    </td>

                    <td style="text-align:right; padding-right:28px">
                        <a href="{{ route('sewa.detail', $s->id_sewa) }}" class="btn-detail">
                            <i class="bi bi-eye-fill"></i> Detail
                        </a>
                        <a href="{{ route('sewa.edit', $s->id_sewa) }}" class="btn-edit" title="Edit">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">
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

<style>
/* ── Stat card danger ── */
.stat-card--danger {
    border-top: 3px solid #DC2626 !important;
}
.stat-value--danger {
    color: #DC2626 !important;
}

/* ── Row highlight kalau telat ── */
.row-telat {
    background: rgba(254,226,226,0.18) !important;
}
.row-telat:hover {
    background: rgba(254,226,226,0.32) !important;
}

/* ── Tombol Detail ── */
.btn-detail {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: #eff6ff;
    color: #2563eb;
    border: 1px solid #bfdbfe;
    border-radius: 7px;
    padding: 5px 11px;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: all .15s;
    margin-right: 4px;
}
.btn-detail:hover {
    background: #2563eb;
    color: #fff;
    border-color: #2563eb;
}

/* ══ KOLOM KETERLAMBATAN ══ */

/* -- Telat cell wrapper -- */
.telat-cell {
    display: inline-flex;
    flex-direction: column;
    align-items: center;
    gap: 5px;
}

/* -- Badge merah: "N bulan telat" -- */
.telat-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: #FEE2E2;
    color: #B91C1C;
    border: 1.5px solid #FCA5A5;
    border-radius: 7px;
    padding: 3px 9px;
    font-size: 11px;
    font-weight: 700;
    font-family: 'JetBrains Mono', monospace;
    white-space: nowrap;
}

/* -- List nama bulan yang terlambat -- */
.telat-bulan-list {
    display: flex;
    flex-wrap: wrap;
    gap: 3px;
    justify-content: center;
    max-width: 200px;
}
.telat-bulan-tag {
    background: #fff;
    border: 1px solid #FCA5A5;
    color: #DC2626;
    border-radius: 5px;
    padding: 1px 7px;
    font-size: 10px;
    font-weight: 700;
    font-family: 'JetBrains Mono', monospace;
    white-space: nowrap;
}

/* -- Estimasi denda merah kecil -- */
.telat-denda {
    font-size: 11px;
    font-weight: 700;
    color: #DC2626;
    font-family: 'JetBrains Mono', monospace;
    background: #FEE2E2;
    border-radius: 5px;
    padding: 1px 7px;
    border: 1px dashed #FCA5A5;
    white-space: nowrap;
}

/* -- Jatuh tempo hari ini -- */
.jt-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: #FEF3C7;
    color: #92400E;
    border: 1.5px solid #FDE68A;
    border-radius: 7px;
    padding: 3px 9px;
    font-size: 11px;
    font-weight: 700;
    font-family: 'JetBrains Mono', monospace;
    white-space: nowrap;
}

/* -- Lunas -- */
.lunas-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: #D1FAE5;
    color: #065F46;
    border: 1.5px solid #6EE7B7;
    border-radius: 7px;
    padding: 3px 9px;
    font-size: 11px;
    font-weight: 700;
    font-family: 'JetBrains Mono', monospace;
    white-space: nowrap;
}

/* -- Selesai -- */
.selesai-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: #F1F5F9;
    color: #64748B;
    border: 1.5px solid #E2E8F0;
    border-radius: 7px;
    padding: 3px 9px;
    font-size: 11px;
    font-weight: 700;
    font-family: 'JetBrains Mono', monospace;
    white-space: nowrap;
}

/* -- Tepat waktu / aman -- */
.aman-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    background: #EFF6FF;
    color: #1E40AF;
    border: 1.5px solid #BFDBFE;
    border-radius: 7px;
    padding: 3px 9px;
    font-size: 11px;
    font-weight: 700;
    font-family: 'JetBrains Mono', monospace;
    white-space: nowrap;
}
</style>

@endsection