@extends('layouts.app')

@section('content')
<h4 class="mb-4">Edit Kamar</h4>

<form method="POST" action="{{ route('kamar.update', $kamar->id_kamar) }}">
    @csrf

    <div class="mb-3">
        <label class="form-label">Nomor Kamar</label>
        <input type="text" name="nomor_kamar" class="form-control"
               value="{{ $kamar->nomor_kamar }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Harga Sewa</label>
        <input type="number" name="harga_sewa" class="form-control"
               value="{{ $kamar->harga_sewa }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Fasilitas</label>
        <textarea name="fasilitas_kamar" class="form-control" rows="3">{{ $kamar->fasilitas_kamar }}</textarea>
    </div>

    <button class="btn btn-success">Update</button>
</form>


@endsection
