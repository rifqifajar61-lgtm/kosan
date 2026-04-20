@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="{{ asset('css/kamar.css') }}">

{{-- ── HEADER ── --}}
<div class="page-header">
    <div style="position:relative;z-index:1">
        <div class="header-eyebrow">Manajemen Properti</div>
        <div class="header-title">
            Daftar Kamar
        </div>
    </div>
    <a href="{{ route('kamar.tambah') }}" class="btn-add">
        <i class="bi bi-plus-lg"></i> Tambah Kamar
    </a>
</div>

{{-- ── STATS (5 kartu) ── --}}
<div class="stats-row" style="grid-template-columns: repeat(5, 1fr)">
    <div class="stat-card">
        
        <div class="stat-body">
            <div class="stat-label">Total Kamar</div>
            <div class="stat-value">{{ $kamar->total() }}</div>
        </div>
    </div>
    <div class="stat-card">
        
        <div class="stat-body">
            <div class="stat-label">Aktif</div>
            <div class="stat-value">{{ $totalAktif }}</div>
        </div>
    </div>
    <div class="stat-card">
        
        <div class="stat-body">
            <div class="stat-label">Non-Aktif</div>
            <div class="stat-value">{{ $totalNonaktif }}</div>
        </div>
    </div>
    <div class="stat-card">
        
        <div class="stat-body">
            <div class="stat-label">Harga Terendah</div>
            <div class="stat-value sm">{{ $minHarga }}</div>
        </div>
    </div>
    <div class="stat-card">
       
        <div class="stat-body">
            <div class="stat-label">Harga Tertinggi</div>
            <div class="stat-value sm">{{ $maxHarga }}</div>
        </div>
    </div>
</div>

{{-- ── TABLE ── --}}
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
                    <th>Status</th>
                    <th style="text-align:right; padding-right:28px; width:170px">Aksi</th>
                </tr>
            </thead>
            <tbody id="kamarBody">
                @forelse ($kamar as $index => $item)
                <tr>
                    <td style="padding-left:28px">
                        <span class="row-num">
                            {{ str_pad($kamar->firstItem() + $index, 2, '0', STR_PAD_LEFT) }}
                        </span>
                    </td>

                    <td>
                        <div class="room-pill">
                            <span class="room-dot" style="{{ $item->status_kamar === 'nonaktif' ? 'background:#ef4444;box-shadow:0 0 6px rgba(239,68,68,0.5)' : '' }}"></span>
                            {{ $item->nomor_kamar }}
                        </div>
                    </td>

                    <td>
                        <div class="price-main">Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}</div>
                        <div class="price-sub">per bulan</div>
                    </td>

                    <td>
                        @php $fasilitas = explode("\n", $item->fasilitas_kamar); @endphp
                        @foreach ($fasilitas as $f)
                            @if(trim($f))
                                <span class="f-badge">{{ trim($f) }}</span>
                            @endif
                        @endforeach
                    </td>

                    <td>
                        @if($item->status_kamar === 'aktif')
                            <span class="status-kamar-badge aktif">
                                <span class="status-dot-pulse"></span> Aktif
                            </span>
                        @else
                            <span class="status-kamar-badge nonaktif">
                                <i class="bi bi-slash-circle" style="font-size:10px"></i> Non-Aktif
                            </span>
                        @endif
                    </td>

                    <td style="text-align:right; padding-right:28px">
                        <a href="{{ route('kamar.edit', $item->id_kamar) }}" class="btn-edit">
                            <i class="bi bi-pencil-fill"></i> Edit
                        </a>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="6">
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

    {{-- ── PAGINATION ── --}}
    @if ($kamar->hasPages())
    <div class="pagination-wrapper">
        <div class="pagination-info">
            Menampilkan {{ $kamar->firstItem() }}–{{ $kamar->lastItem() }}
            dari {{ $kamar->total() }} kamar
        </div>
        <div class="pagination-links">
            @if ($kamar->onFirstPage())
                <span class="page-btn disabled"><i class="bi bi-chevron-left"></i></span>
            @else
                <a href="{{ $kamar->previousPageUrl() }}" class="page-btn"><i class="bi bi-chevron-left"></i></a>
            @endif

            @foreach ($kamar->getUrlRange(1, $kamar->lastPage()) as $page => $url)
                @if ($page == $kamar->currentPage())
                    <span class="page-btn active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                @endif
            @endforeach

            @if ($kamar->hasMorePages())
                <a href="{{ $kamar->nextPageUrl() }}" class="page-btn"><i class="bi bi-chevron-right"></i></a>
            @else
                <span class="page-btn disabled"><i class="bi bi-chevron-right"></i></span>
            @endif
        </div>
    </div>
    @endif

</div>

@endsection