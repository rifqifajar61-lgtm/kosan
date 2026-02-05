@extends('layouts.app')

@section('content')
    <h3 class="mb-4">Tambah Pemasukan</h3>

    <form action="/pemasukan/simpan" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Sewa</label>
            <select name="id_sewa" class="form-select" required>
                @foreach ($sewa as $s)
                    <option value="{{ $s->id_sewa }}">
                        {{ $s->id_sewa }}
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
            <input 
                type="text" 
                name="bulan" 
                class="form-control" 
                placeholder="Januari"
                required
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Jumlah Bayar</label>
            <input type="number" name="jumlah_bayar" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">
            Simpan
        </button>
        <a href="/pemasukan" class="btn btn-secondary ms-2">
            Cancel
        </a>
    </form>
@endsection
