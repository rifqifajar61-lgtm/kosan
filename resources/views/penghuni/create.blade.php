@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    {{-- ── HEADER ── --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <p class="text-muted mb-0" style="font-size:.8rem;letter-spacing:.08em;text-transform:uppercase">Manajemen Properti</p>
            <h4 class="fw-bold mb-0">Data Penghuni
                <span class="badge bg-primary ms-1" style="font-size:.75rem">{{ $penghuni->count() }}</span>
            </h4>
        </div>
        <button class="btn btn-dark btn-sm px-3" data-bs-toggle="modal" data-bs-target="#tambahPenghuniModal">
            <i class="bi bi-person-plus-fill me-1"></i> Tambah Penghuni
        </button>
    </div>

    {{-- ── STATS ── --}}
    @php
        $totalPenghuni = $penghuni->count();
        $penghuniBaru  = $penghuni->filter(fn($p) => \Carbon\Carbon::parse($p->tanggal_masuk)->isCurrentMonth())->count();
        $penghuniLama  = $penghuni->filter(fn($p) => \Carbon\Carbon::parse($p->tanggal_masuk)->diffInMonths(now()) >= 6)->count();
    @endphp

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3 bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-people-fill fs-4"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.06em">Total Penghuni</p>
                        <h4 class="fw-bold mb-0">{{ $totalPenghuni }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3 bg-success bg-opacity-10 text-success">
                        <i class="bi bi-person-check-fill fs-4"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.06em">Masuk Bulan Ini</p>
                        <h4 class="fw-bold mb-0">{{ $penghuniBaru }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-3 p-3 bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-person-badge-fill fs-4"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0" style="font-size:.75rem;text-transform:uppercase;letter-spacing:.06em">Penghuni ≥ 6 Bulan</p>
                        <h4 class="fw-bold mb-0">{{ $penghuniLama }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── TABLE CARD ── --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-4" width="50">#</th>
                            <th>Nama Penghuni</th>
                            <th>No KTP</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Tanggal Masuk</th>
                            <th class="text-center pe-4" width="160">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($penghuni as $p)
                        <tr>
                            <td class="ps-4 text-muted small">{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center fw-bold"
                                         style="width:36px;height:36px;font-size:.85rem;flex-shrink:0">
                                        {{ strtoupper(substr($p->nama_penghuni, 0, 1)) }}
                                    </div>
                                    <span class="fw-semibold">{{ $p->nama_penghuni }}</span>
                                </div>
                            </td>
                            <td><span class="text-muted" style="font-size:.85rem">{{ $p->no_ktp }}</span></td>
                            <td><i class="bi bi-telephone text-success me-1"></i>{{ $p->no_hp }}</td>
                            <td><span class="text-muted" style="font-size:.85rem">{{ Str::limit($p->alamat_penghuni, 35) }}</span></td>
                            <td>
                                <span class="badge rounded-pill bg-light text-dark border" style="font-size:.75rem;font-weight:500">
                                    <i class="bi bi-calendar3 me-1"></i>{{ date('d M Y', strtotime($p->tanggal_masuk)) }}
                                </span>
                            </td>
                            <td class="text-center pe-4">
                                <a href="{{ route('penghuni.edit', $p->id_penghuni) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-fill me-1"></i>Edit
                                </a>
                                <a href="{{ route('penghuni.hapus', $p->id_penghuni) }}" class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <i class="bi bi-trash3 me-1"></i>Hapus
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-people d-block mb-2" style="font-size:2.5rem;opacity:.3"></i>
                                Belum ada data penghuni.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

{{-- ── MODAL TAMBAH PENGHUNI ── --}}
<div class="modal fade" id="tambahPenghuniModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">

            <form action="{{ route('penghuni.simpan') }}" method="POST">
                @csrf

                {{-- Header gelap seperti modal kamar --}}
                <div class="modal-header bg-dark text-white">
                    <h6 class="modal-title fw-semibold">
                        <i class="bi bi-person-plus-fill me-2"></i>Tambah Penghuni Baru
                    </h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body px-4 py-3">

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-muted text-uppercase" style="letter-spacing:.06em">
                            Nama Penghuni
                        </label>
                        <input type="text" name="nama_penghuni" class="form-control"
                               placeholder="Masukkan nama lengkap" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-muted text-uppercase" style="letter-spacing:.06em">
                            No KTP
                        </label>
                        <input type="text" name="no_ktp" class="form-control"
                               placeholder="327xxxxxxxxx" maxlength="16" required>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold small text-muted text-uppercase" style="letter-spacing:.06em">
                                No HP
                            </label>
                            <input type="text" name="no_hp" class="form-control"
                                   placeholder="08xxxxxxxxxx" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold small text-muted text-uppercase" style="letter-spacing:.06em">
                                Tanggal Masuk
                            </label>
                            <input type="date" name="tanggal_masuk" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-1">
                        <label class="form-label fw-semibold small text-muted text-uppercase" style="letter-spacing:.06em">
                            Alamat
                            <span class="fw-normal text-muted" style="text-transform:none;letter-spacing:0">(opsional)</span>
                        </label>
                        <textarea name="alamat_penghuni" class="form-control"
                                  placeholder="Alamat lengkap penghuni" rows="2"></textarea>
                    </div>

                </div>

                <div class="modal-footer bg-light">
                    <button type="submit" class="btn btn-dark px-4">
                        <i class="bi bi-check-lg me-1"></i>Simpan
                    </button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection