@extends('layouts.app')

@section('content')
    <h4 class="mb-3">Data Penghuni</h4>

    <a href="/penghuni/tambah" class="btn btn-primary mb-3">
        + Tambah Penghuni
    </a>

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th style="width: 50px;">No</th>
                <th>Nama Penghuni</th>
                <th>No KTP</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>Tanggal Masuk</th>
            </tr>
        </thead>

        <tbody>
            @forelse($penghuni as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->nama_penghuni }}</td>
                    <td>{{ $p->no_ktp }}</td>
                    <td>{{ $p->no_hp }}</td>
                    <td>{{ $p->alamat }}</td>
                    <td>{{ $p->tanggal_masuk }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">
                        Data penghuni belum ada
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
