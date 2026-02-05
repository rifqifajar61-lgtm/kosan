@extends('layouts.app')

@section('content')
<h3>Data Pengeluaran</h3>

<a href="/pengeluaran/tambah" class="btn btn-primary mb-3">Tambah</a>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Jenis Pengeluaran</th>
        <th>Nominal</th>
    </tr>

    @foreach($pengeluaran as $p)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $p->tanggal }}</td>
        <td>{{ $p->jenis_pengeluaran }}</td>
        <td>Rp {{ number_format($p->nominal, 0, ',', '.') }}</td>
    </tr>
    @endforeach
</table>
@endsection
