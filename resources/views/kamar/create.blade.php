@extends('layouts.app')

@section('content')
<h4>Tambah Kamar</h4>

<form method="POST" action="/kamar/simpan">
@csrf

<div class="mb-3">
    <label>Nama Kamar</label>
    <input type="text" name="nama_kamar" class="form-control">
</div>

<div class="mb-3">
    <label>Harga / Bulan</label>
    <input type="number" name="harga" class="form-control">
</div>

<div class="mb-3">
    <label>Status</label>
    <select name="status" class="form-control">
        <option value="Kosong">Kosong</option>
        <option value="Terisi">Terisi</option>
    </select>
</div>

<button class="btn btn-success">Save</button>
<a href="/kamar" class="btn btn-secondary">Cancel</a>

</form>
@endsection
