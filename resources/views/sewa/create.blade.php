@extends('layouts.app')

@section('content')

<!-- ===== PAGE HEADER ===== -->
<div class="mb-4">
    <h4 class="fw-bold mb-1">Tambah Sewa</h4>
    <small class="text-muted">Lengkapi data sewa kamar</small>
</div>

<div class="row justify-content-center">
    <div class="col-lg-7">

        <div class="form-card shadow-sm">

            <form method="POST" action="/sewa/simpan">
                @csrf

                <div class="form-group">
                    <label>Penghuni</label>
                    <select name="id_penghuni" class="form-input" required>
                        <option value="">-- Pilih Penghuni --</option>
                        @foreach($penghuni as $p)
                            <option value="{{ $p->id_penghuni }}">
                                {{ $p->nama_penghuni }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Kamar</label>
                    <select name="id_kamar" class="form-input" required>
                        <option value="">-- Pilih Kamar --</option>
                        @foreach($kamar as $k)
                            <option value="{{ $k->id_kamar }}">
                                {{ $k->nomor_kamar }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-input" required>
                        <option value="aktif">Aktif</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>

                <hr class="my-4">

                <!-- ACTION -->
                <div class="form-action">
                    <a href="/sewa" class="btn-cancel">
                        <i class="bi bi-x-circle"></i>
                        Cancel
                    </a>

                    <button type="submit" class="btn-save">
                        <i class="bi bi-check-circle-fill"></i>
                        Save
                    </button>
                </div>

            </form>

        </div>

    </div>
</div>

<!-- ===== STYLE (VIEW ONLY) ===== -->
<style>
.form-card{
    background:#ffffff;
    border-radius:20px;
    padding:28px;
}

/* FORM */
.form-group{
    margin-bottom:20px;
}

.form-group label{
    font-weight:600;
    margin-bottom:8px;
    display:block;
    color:#1f2937;
}

.form-input{
    width:100%;
    padding:14px 16px;
    border-radius:14px;
    border:1px solid #e5e7eb;
    background:#f9fafb;
}

.form-input:focus{
    outline:none;
    border-color:#2563eb;
    background:#ffffff;
    box-shadow:0 0 0 3px rgba(37,99,235,.15);
}

/* ACTION */
.form-action{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-top:30px;
}

/* CANCEL */
.btn-cancel{
    padding:12px 22px;
    border-radius:999px;
    background:#fee2e2;
    color:#991b1b;
    font-weight:600;
    text-decoration:none;
    display:flex;
    align-items:center;
    gap:8px;
}

.btn-cancel:hover{
    background:#fecaca;
}

/* SAVE */
.btn-save{
    padding:14px 28px;
    border-radius:999px;
    border:none;
    background:linear-gradient(135deg,#2563eb,#1e40af);
    color:#ffffff;
    font-weight:600;
    display:flex;
    align-items:center;
    gap:10px;
    box-shadow:0 10px 25px rgba(37,99,235,.35);
}

.btn-save:hover{
    background:linear-gradient(135deg,#1e40af,#1e3a8a);
}
</style>

@endsection
