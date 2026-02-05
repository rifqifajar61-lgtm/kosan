@extends('layouts.app')

@section('content')
<h3>Laporan Keuangan</h3>

<form method="POST" action="/laporan" class="mb-4">
    @csrf

    <label>Pilih Bulan</label><br>
    <select name="bulan">
        <option value="">-- Pilih Bulan --</option>
        <option value="Januari">Januari</option>
        <option value="Februari">Februari</option>
        <option value="Maret">Maret</option>
        <option value="April">April</option>
        <option value="Mei">Mei</option>
        <option value="Juni">Juni</option>
        <option value="Juli">Juli</option>
        <option value="Agustus">Agustus</option>
        <option value="September">September</option>
        <option value="Oktober">Oktober</option>
        <option value="November">November</option>
        <option value="Desember">Desember</option>
    </select>

    <button type="submit">OK</button>
</form>

<hr>

{{-- ================= HASIL (LANGSUNG MUNCUL) ================= --}}
<h5>Hasil</h5>
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>Pengeluaran</th>
        <th>Pemasukan</th>
        <th>Jumlah</th>
    </tr>
    <tr>
        <td>
            Rp {{ isset($totalPengeluaran) ? number_format($totalPengeluaran,0,',','.') : 0 }}
        </td>
        <td>
            Rp {{ isset($totalPemasukan) ? number_format($totalPemasukan,0,',','.') : 0 }}
        </td>
        <td>
            <b>
            Rp {{
                isset($totalPemasukan, $totalPengeluaran)
                ? number_format($totalPemasukan - $totalPengeluaran,0,',','.')
                : 0
            }}
            </b>
        </td>
    </tr>
</table>

{{-- ================= DETAIL (SETELAH KLIK OK) ================= --}}
@if(isset($bulan))
<hr>

<h4>Bulan: {{ $bulan }}</h4>

<h5>Pemasukan</h5>
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Jumlah</th>
    </tr>

    @foreach($pemasukan as $p)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $p->tanggal }}</td>
        <td>Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}</td>
    </tr>
    @endforeach

    <tr>
        <td colspan="2"><b>Total</b></td>
        <td><b>Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</b></td>
    </tr>
</table>

<br>

<h5>Pengeluaran</h5>
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Jenis</th>
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

    <tr>
        <td colspan="3"><b>Total</b></td>
        <td><b>Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</b></td>
    </tr>
</table>
@endif
@endsection
