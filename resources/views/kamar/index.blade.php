@extends('layouts.app')

@section('content')
<h4>Data Kamar</h4>

<a href="/kamar/tambah" class="btn btn-primary mb-3">Tambah Kamar</a>

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Nama Kamar</th>
        <th>Harga</th>
        <th>Status</th>
    </tr>

    @foreach($kamar as $k)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $k->nama_kamar }}</td>
        <td>Rp {{ number_format($k->harga) }}</td>
        <td>{{ $k->status }}</td>
    </tr>
    @endforeach
</table>
@endsection
