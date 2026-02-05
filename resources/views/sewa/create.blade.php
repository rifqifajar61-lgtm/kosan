@extends('layouts.app')

@section('content')
<h4 class="mb-4">Tambah Sewa</h4>

<form method="POST" action="/sewa/simpan">
@csrf

<div class="mb-3">
    <label class="form-label">Penghuni</label>
    <select name="id_penghuni" class="form-control" required>
        <option value="">-- Pilih Penghuni --</option>
        @foreach($penghuni as $p)
            <option value="{{ $p->id_penghuni }}">
                {{ $p->nama_penghuni }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Kamar</label>
    <select name="id_kamar" class="form-control" required>
        <option value="">-- Pilih Kamar --</option>
        @foreach($kamar as $k)
            <option value="{{ $k->id_kamar }}">
                {{ $k->nomor_kamar }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Tanggal</label>
    <input type="date" name="tanggal" class="form-control" required>
</div>

<div class="mb-3">
    <label class="form-label">Bulan</label>
    <input type="text" name="bulan" class="form-control" placeholder="Januari" required>
</div>

<div class="mb-3">
    <label class="form-label">Jumlah Bayar</label>
    <input type="number" name="jumlah_bayar" class="form-control" required>
</div>

<div class="mb-3">
    <label class="form-label">Status</label>
    <select name="status" class="form-control" required>
        <option value="lunas">Lunas</option>
        <option value="belum lunas">Belum Lunas</option>
    </select>
</div>

<button class="btn btn-success">Simpan</button>
<a href="/sewa" class="btn btn-secondary">Batal</a>
</form>
@endsection
