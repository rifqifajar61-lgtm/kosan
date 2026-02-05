@extends('layouts.app')

@section('content')
<h3>Tambah Pengeluaran</h3>

<form action="/pengeluaran/simpan" method="POST">
    @csrf

    <div class="mb-3">
        <label>Tanggal</label>
        <input type="date" name="tanggal" class="form-control">
    </div>

    <div class="mb-3">
        <label>Jenis Pengeluaran</label>
        <input type="text" name="jenis_pengeluaran" class="form-control">
    </div>

    <div class="mb-3">
        <label>Nominal</label>
        <input type="number" name="nominal" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="/pengeluaran" class="btn btn-secondary">Cancel</a>
</form>
@endsection
