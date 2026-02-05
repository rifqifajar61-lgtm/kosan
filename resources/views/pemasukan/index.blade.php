@extends('layouts.app')

@section('content')
    <h3 class="mb-4">Data Pemasukan</h3>

    <a href="/pemasukan/tambah" class="btn btn-primary mb-3">
        Tambah
    </a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Bulan</th>
                    <th>Jumlah Bayar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pemasukan as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->tanggal }}</td>
                        <td>{{ $p->bulan }}</td>
                        <td>Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
