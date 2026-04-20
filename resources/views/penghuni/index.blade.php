@extends('layouts.app')
 
@section('content')
 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="{{ asset('css/penghuni.css') }}">
 
{{-- ── HEADER ── --}}
<div class="page-header">
    <div style="position:relative;z-index:1">
        <div class="header-eyebrow">Manajemen Penghuni</div>
        <div class="header-title">
            Data Penghuni
           
        </div>
    </div>
    <a href="{{ route('penghuni.tambah') }}" class="btn-add">
        <i class="bi bi-person-plus-fill"></i> Tambah Penghuni
    </a>
</div>
 
{{-- ── STATS ── --}}
<div class="stats-row">
    <div class="stat-card">
        
        <div class="stat-body">
            <div class="stat-label">Total Penghuni</div>
            <div class="stat-value">{{ $penghuni->total() }}</div>
        </div>
    </div>
 
    <div class="stat-card">
        
        <div class="stat-body">
            <div class="stat-label">Laki-laki</div>
            <div class="stat-value">{{ $lakiLaki }}</div>
        </div>
    </div>
 
    <div class="stat-card">
        
        <div class="stat-body">
            <div class="stat-label">Perempuan</div>
            <div class="stat-value">{{ $perempuan }}</div>
        </div>
    </div>
</div>
 
{{-- ── TABLE ── --}}
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
                    <th>Jenis Kelamin</th>
                    <th style="text-align:right; padding-right:28px; width:175px">Aksi</th>
                </tr>
            </thead>
            <tbody id="tablePenghuniBody">
                @forelse ($penghuni as $p)
                <tr>
                    <td style="padding-left:28px">
                        <span style="font-size:12px;font-family:'JetBrains Mono',monospace;color:#9ca3af">
                            {{ str_pad(($penghuni->currentPage() - 1) * $penghuni->perPage() + $loop->iteration, 2, '0', STR_PAD_LEFT) }}
                        </span>
                    </td>
                    <td>
    <span class="name-text">{{ $p->nama_penghuni }}</span>
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
@php
    $jk = strtolower($p->jenis_kelamin);
@endphp

<span class="gender-badge 
    {{ $jk == 'laki-laki' ? 'male' : '' }}
    {{ $jk == 'perempuan' ? 'female' : '' }}
">
    @if($jk == 'laki-laki')
        <i class="bi bi-gender-male"></i> Laki-laki
    @elseif($jk == 'perempuan')
        <i class="bi bi-gender-female"></i> Perempuan
    @else
        <i class="bi bi-question-circle"></i> -
    @endif
</span>
</td>
                    <td style="text-align:right; padding-right:28px">
                        <a href="{{ route('penghuni.edit', $p->id_penghuni) }}" class="btn-edit">
                            <i class="bi bi-pencil-fill"></i> Edit
                        </a>
                    </td>
                </tr>
 
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
 
    {{-- ── PAGINATION ── --}}
    @if ($penghuni->hasPages())
    <div class="pagination-wrapper">
        <div class="pagination-info">
            Menampilkan {{ $penghuni->firstItem() }}–{{ $penghuni->lastItem() }}
            dari {{ $penghuni->total() }} penghuni
        </div>
 
        <div class="pagination-links">
            {{-- Prev --}}
            @if ($penghuni->onFirstPage())
                <span class="page-btn disabled">
                    <i class="bi bi-chevron-left"></i>
                </span>
            @else
                <a href="{{ $penghuni->previousPageUrl() }}" class="page-btn">
                    <i class="bi bi-chevron-left"></i>
                </a>
            @endif
 
            {{-- Nomor Halaman --}}
            @foreach ($penghuni->getUrlRange(1, $penghuni->lastPage()) as $page => $url)
                @if ($page == $penghuni->currentPage())
                    <span class="page-btn active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                @endif
            @endforeach
 
            {{-- Next --}}
            @if ($penghuni->hasMorePages())
                <a href="{{ $penghuni->nextPageUrl() }}" class="page-btn">
                    <i class="bi bi-chevron-right"></i>
                </a>
            @else
                <span class="page-btn disabled">
                    <i class="bi bi-chevron-right"></i>
                </span>
            @endif
        </div>
    </div>
    @endif
 
</div>{{-- end .table-card --}}

<script>
let currentPage = 1;
let lastHash = "";

async function loadData(page = 1){

    currentPage = page;

    const res = await fetch(`/api/penghuni?page=${page}`);
    const result = await res.json();

    const data = result.data;

    renderTable(data, result);
    renderPagination(result);
}

function renderTable(data, meta){

    const tbody = document.getElementById("tablePenghuniBody");

    let html = "";

    data.forEach((p,i)=>{

        const nomor = (meta.current_page - 1) * meta.per_page + (i+1);

        html += `
        <tr>

        <td style="padding-left:28px">
        <span style="font-size:12px;font-family:'JetBrains Mono',monospace;color:#9ca3af">
        ${String(nomor).padStart(2,'0')}
        </span>
        </td>

        <td>
        <div class="name-cell">
        <div class="avatar">${p.nama_penghuni.charAt(0).toUpperCase()}</div>
        <span class="name-text">${p.nama_penghuni}</span>
        </div>
        </td>

        <td><span class="ktp-text">${p.no_ktp}</span></td>

        <td>
        <span class="phone-text">
        <i class="bi bi-telephone-fill"></i>
        ${p.no_hp}
        </span>
        </td>

        <td>
        <span class="addr-text">
        ${p.alamat_penghuni.substring(0,35)}
        </span>
        </td>

        <td>
        <span class="date-badge">
        ${p.jenis_kelamin}
        </span>
        </td>

        <td style="text-align:right;padding-right:28px">
        <a href="/penghuni/edit/${p.id_penghuni}" class="btn-edit">
        Edit
        </a>
        </td>

        </tr>
        `;
    });

    tbody.innerHTML = html;
}

function renderPagination(meta){

    const container = document.querySelector(".pagination-links");

    let html = "";

    // Prev
    html += `
    <span class="page-btn ${meta.current_page == 1 ? 'disabled':''}" 
    onclick="if(${meta.current_page}>1) loadData(${meta.current_page-1})">
    <</span>
    `;

    for(let i=1;i<=meta.last_page;i++){
        html += `
        <span class="page-btn ${i==meta.current_page ? 'active':''}" 
        onclick="loadData(${i})">${i}</span>
        `;
    }

    // Next
    html += `
    <span class="page-btn ${meta.current_page == meta.last_page ? 'disabled':''}" 
    onclick="if(${meta.current_page}<${meta.last_page}) loadData(${meta.current_page+1})">
    ></span>
    `;

    container.innerHTML = html;
}

async function cekRealtime(){

    const res = await fetch(`/api/penghuni?page=${currentPage}`);
    const result = await res.json();

    const newHash = JSON.stringify(result.data);

    if(newHash !== lastHash){
        lastHash = newHash;
        renderTable(result.data, result);
    }
}

// INIT
let interval;

document.addEventListener("visibilitychange", () => {
    if(document.hidden){
        clearInterval(interval);
    } else {
        interval = setInterval(cekRealtime, 5000);
    }
});

interval = setInterval(cekRealtime, 5000);
</script>

@endsection