@extends('layouts.app')

@section('content')
    <h4 class="mb-3">Data Sewa</h4>

    <a href="/sewa/tambah" class="btn btn-primary mb-3">
        + Tambah Sewa
    </a>

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th style="width: 50px;">No</th>
                <th>Penghuni</th>
                <th>Kamar</th>
                <th>Tanggal</th>
                <th>Bulan</th>
                <th>Jumlah Bayar</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse($sewa as $s)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $s->nama_penghuni }}</td>
                    <td>{{ $s->nama_kamar }}</td>
                    <td>{{ $s->tanggal }}</td>
                    <td>{{ $s->bulan }}</td>
                    <td>Rp {{ number_format($s->jumlah_bayar, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge 
                            {{ $s->status == 'lunas' ? 'bg-success' : 'bg-warning text-dark' }}">
                            {{ ucfirst($s->status) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">
                        Data sewa belum tersedia
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
