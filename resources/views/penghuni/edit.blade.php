@extends('layouts.app')

@section('content')
<h4 class="mb-4">Edit Penghuni</h4>

<form method="POST" action="{{ route('penghuni.update', $penghuni->id_penghuni) }}">
    @csrf

    <div class="mb-3">
        <label class="form-label">Nama Penghuni</label>
        <input type="text" name="nama_penghuni" class="form-control"
               value="{{ $penghuni->nama_penghuni }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">No KTP</label>
        <input type="text" name="no_ktp" class="form-control"
               value="{{ $penghuni->no_ktp }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">No HP</label>
        <input type="text" name="no_hp" class="form-control"
               value="{{ $penghuni->no_hp }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <textarea name="alamat_penghuni" class="form-control" rows="3" required>{{ $penghuni->alamat_penghuni }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Tanggal Masuk</label>
        <input type="date" name="tanggal_masuk" class="form-control"
               value="{{ date('Y-m-d', strtotime($penghuni->tanggal_masuk)) }}" required>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('penghuni') }}" class="btn btn-secondary ms-2">Cancel</a>
</form>
@endsection
