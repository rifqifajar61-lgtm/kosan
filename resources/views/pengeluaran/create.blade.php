@extends('layouts.app')

@section('content')

<!-- ===== PAGE TITLE ===== -->
<div class="mb-4">
    <h4 class="fw-bold mb-1">Tambah Pengeluaran</h4>
    <small class="text-muted">Input data pengeluaran baru</small>
</div>

<div class="row justify-content-center">
    <div class="col-lg-7">

        <div class="form-card shadow-sm">
            <form action="/pengeluaran/simpan" method="POST">
                @csrf

                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-input" required>
                </div>

                <div class="form-group">
                    <label>Jenis Pengeluaran</label>
                    <input type="text" name="jenis_pengeluaran" class="form-input" placeholder="Contoh: Listrik, Air, Perbaikan" required>
                </div>

                <div class="form-group">
                    <label>Nominal</label>
                    <input type="number" name="nominal" class="form-input" placeholder="Masukkan nominal pengeluaran" required>
                </div>

                <!-- ACTION -->
                <div class="form-action">
                    <a href="/pengeluaran" class="btn-cancel">
                        <i class="bi bi-x-circle"></i> Cancel
                    </a>
                    <button type="submit" class="btn-save">
                        <i class="bi bi-save2"></i> Save
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

.form-action{
    display:flex;
    justify-content:flex-end;
    gap:12px;
    margin-top:30px;
}

.btn-cancel{
    padding:12px 22px;
    border-radius:999px;
    background:#fee2e2;
    color:#991b1b;
    font-weight:600;
    text-decoration:none;
}

.btn-cancel:hover{
    background:#fecaca;
}

.btn-save{
    padding:12px 26px;
    border-radius:999px;
    border:none;
    background:linear-gradient(135deg,#2563eb,#1e40af);
    color:#fff;
    font-weight:600;
}

.btn-save:hover{
    background:linear-gradient(135deg,#1e40af,#1e3a8a);
}
</style>

@endsection
