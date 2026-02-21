@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
:root{
    --ink:#0f0e17;
    --paper:#fffffe;
    --surface:#f5f5f7;
    --muted:#6b6882;
    --muted-lt:#a7a9be;
    --green:#3da35d;
}

/* HEADER */
.page-header{
    background:var(--ink);
    border-radius:20px;
    padding:32px 40px;
    margin-bottom:28px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    color:#fff;
}

.header-eyebrow{
    font-size:10px;
    font-weight:700;
    letter-spacing:3px;
    text-transform:uppercase;
    color:#4ade80;
}

.header-title{
    font-size:28px;
    font-weight:800;
}

.header-tag{
    font-size:13px;
    font-weight:700;
    background:rgba(74,222,128,0.15);
    border:1px solid rgba(74,222,128,0.3);
    color:#4ade80;
    padding:3px 12px;
    border-radius:999px;
    margin-left:8px;
}

/* BUTTON */
.btn-back{
    padding:10px 18px;
    background:rgba(255,255,255,0.12);
    border:1px solid rgba(255,255,255,0.2);
    color:#fff;
    border-radius:10px;
    text-decoration:none;
    font-size:13px;
}
.btn-back:hover{background:rgba(255,255,255,0.2)}

.form-card{
    background:#fff;
    border-radius:20px;
    box-shadow:0 10px 30px rgba(0,0,0,0.05);
    max-width:700px;
    margin:auto;
}

.form-card-header{
    padding:22px 32px;
    border-bottom:1px solid rgba(0,0,0,0.05);
    display:flex;
    gap:12px;
    align-items:center;
}

.form-card-icon{
    width:40px;
    height:40px;
    border-radius:11px;
    background:rgba(74,222,128,0.12);
    display:flex;
    align-items:center;
    justify-content:center;
    color:#22c55e;
}

.form-body{
    padding:32px;
    display:flex;
    flex-direction:column;
    gap:20px;
}

.field{
    display:flex;
    flex-direction:column;
    gap:6px;
}

.field-label{
    font-size:11px;
    font-weight:700;
    text-transform:uppercase;
    color:var(--muted);
}

.field-input{
    padding:12px 15px;
    border-radius:12px;
    border:1px solid #e5e7eb;
    background:var(--surface);
    font-size:14px;
}

.field-input:focus{
    background:#fff;
    border-color:#4ade80;
    box-shadow:0 0 0 3px rgba(74,222,128,0.15);
    outline:none;
}

textarea.field-input{
    min-height:110px;
    resize:vertical;
}

/* INPUT RP */
.input-rp{
    display:flex;
    border-radius:12px;
    overflow:hidden;
    border:1px solid #e5e7eb;
    background:var(--surface);
}
.rp-prefix{
    padding:12px 14px;
    font-weight:700;
    color:var(--muted);
    border-right:1px solid #e5e7eb;
}
.input-rp input{
    flex:1;
    border:none;
    background:transparent;
    padding:12px 14px;
}
.input-rp input:focus{outline:none}

/* FASILITAS TAG */
.fasilitas-preview{
    display:flex;
    flex-wrap:wrap;
    gap:6px;
}
.f-tag{
    background:rgba(74,222,128,0.1);
    border:1px solid rgba(74,222,128,0.25);
    color:var(--green);
    padding:4px 12px;
    border-radius:7px;
    font-size:12px;
    font-weight:600;
}

.divider{
    height:1px;
    background:#eee;
    margin:6px 0;
}

/* FOOTER */
.form-footer{
    padding:20px 32px;
    background:#f8fafc;
    display:flex;
    justify-content:flex-end;
    gap:10px;
}

.btn-save{
    background:#4ade80;
    border:none;
    padding:12px 26px;
    border-radius:12px;
    font-weight:700;
    cursor:pointer;
}
.btn-save:hover{
    background:#22c55e;
}

.btn-cancel{
    padding:12px 22px;
    border-radius:12px;
    border:1px solid #ddd;
    text-decoration:none;
    color:#666;
}
.btn-cancel:hover{background:#f1f1f1}
</style>


{{-- HEADER --}}
<div class="page-header">
    <div>
        <div class="header-eyebrow">Manajemen Properti</div>
        <div class="header-title">
            Tambah Kamar <span class="header-tag">Baru</span>
        </div>
    </div>

    {{-- ROUTE SUDAH SESUAI WEB.PHP --}}
    <a href="{{ route('kamar') }}" class="btn-back">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>


<div class="form-card">

    <div class="form-card-header">
        <div class="form-card-icon"><i class="bi bi-door-open-fill"></i></div>
        <div>
            <b>Data Kamar Baru</b><br>
            <small>Isi semua kolom yang diperlukan</small>
        </div>
    </div>

    <form action="{{ route('kamar.simpan') }}" method="POST">
        @csrf

        <div class="form-body">

            <div class="field">
                <label class="field-label">Nomor Kamar</label>
                <input type="text" name="nomor_kamar" class="field-input"
                       value="{{ old('nomor_kamar') }}" required>
            </div>

            <div class="field">
                <label class="field-label">Harga Sewa</label>
                <div class="input-rp">
                    <span class="rp-prefix">Rp</span>
                    <input type="number" name="harga_sewa"
                           value="{{ old('harga_sewa') }}" required>
                </div>
            </div>

            <div class="divider"></div>

            <div class="field">
                <label class="field-label">Fasilitas</label>
                <textarea name="fasilitas_kamar" id="fasilitasInput"
                          class="field-input"
                          oninput="updatePreview()">{{ old('fasilitas_kamar') }}</textarea>
                <div class="fasilitas-preview" id="fasilitasPreview"></div>
            </div>

        </div>

        <div class="form-footer">
            <a href="{{ route('kamar') }}" class="btn-cancel">Batal</a>
            <button class="btn-save">Simpan Kamar</button>
        </div>

    </form>
</div>

<script>
function updatePreview(){
    const val=document.getElementById('fasilitasInput').value;
    const prev=document.getElementById('fasilitasPreview');
    const items=val.split('\n').map(s=>s.trim()).filter(Boolean);
    prev.innerHTML=items.length
        ? items.map(f=>`<span class="f-tag">${f}</span>`).join('')
        : '';
}
updatePreview();
</script>

@endsection