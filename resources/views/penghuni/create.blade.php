@extends('layouts.app')

@section('content')
    <h4 class="mb-4">Tambah Penghuni</h4>

    <form method="POST" action="/penghuni/simpan">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Penghuni</label>
            <input 
                type="text" 
                name="nama_penghuni" 
                class="form-control"
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">No KTP</label>
            <input 
                type="text" 
                name="no_ktp" 
                class="form-control"
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">No HP</label>
            <input 
                type="text" 
                name="no_hp" 
                class="form-control"
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea 
                name="alamat" 
                class="form-control" 
                rows="3"
                required
            ></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Masuk</label>
            <input 
                type="date" 
                name="tanggal_masuk" 
                class="form-control"
                required
            >
        </div>

        <button type="submit" class="btn btn-success">
            Simpan
        </button>
        <a href="/penghuni" class="btn btn-secondary ms-2">
            Batal
        </a>
    </form>
@endsection
