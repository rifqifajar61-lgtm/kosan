@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    :root {
        --blue:        #2563EB;
        --blue-dark:   #1E40AF;
        --blue-dim:    #DBEAFE;
        --blue-border: #BFDBFE;
        --text:        #0f1733;
        --muted:       #5a6a8a;
        --faint:       #93C5FD;
        --surface:     rgba(255,255,255,0.86);
        --radius:      14px;
    }

    @keyframes slideIn {
        from { opacity:0; transform:translateY(12px); }
        to   { opacity:1; transform:translateY(0); }
    }
    @keyframes pop {
        from { opacity:0; transform:scale(0.90); }
        to   { opacity:1; transform:scale(1); }
    }
    @keyframes pulse-dot {
        0%,100%{ box-shadow:0 0 0 0 rgba(16,185,129,0.5); }
        50%    { box-shadow:0 0 0 5px rgba(16,185,129,0); }
    }

    /* BREADCRUMB */
    .bc { display:flex; align-items:center; gap:6px; font-size:12px; color:var(--muted); margin-bottom:22px; animation:slideIn .3s ease both; }
    .bc a { color:var(--muted); text-decoration:none; }
    .bc a:hover { color:var(--blue); }
    .bc .sep { color:var(--blue-border); }
    .bc .cur { color:var(--blue); font-weight:700; }

    /* PAGE HEADER */
    .ph { display:flex; align-items:flex-end; justify-content:space-between; gap:16px; margin-bottom:28px; animation:slideIn .35s ease both; }
    .ph-kicker { font-size:10px; font-weight:700; letter-spacing:3px; text-transform:uppercase; color:var(--faint); font-family:'JetBrains Mono',monospace; margin-bottom:4px; }
    .ph-title { font-size:26px; font-weight:800; color:var(--blue-dark); letter-spacing:-0.6px; line-height:1; }
    .ph-title sup { font-size:10px; font-weight:700; letter-spacing:1px; background:var(--blue-dim); color:var(--blue); border:1px solid var(--blue-border); padding:2px 8px; border-radius:6px; vertical-align:middle; margin-left:8px; font-family:'JetBrains Mono',monospace; }
    .btn-back { display:inline-flex; align-items:center; gap:7px; padding:9px 18px; border:1.5px solid var(--blue-border); background:var(--surface); color:var(--blue); font-family:'Sora',sans-serif; font-size:13px; font-weight:600; border-radius:10px; text-decoration:none; transition:all .18s ease; }
    .btn-back:hover { background:var(--blue-dim); border-color:var(--blue); color:var(--blue-dark); transform:translateX(-2px); }

    /* GRID */
    .grid { display:grid; grid-template-columns:1fr 300px; gap:20px; align-items:start; animation:slideIn .4s .05s ease both; }
    @media(max-width:860px){ .grid{ grid-template-columns:1fr; } }

    /* SECTION CARD */
    .sc { background:var(--surface); border:1.5px solid rgba(37,99,235,0.13); border-radius:var(--radius); overflow:hidden; margin-bottom:16px; box-shadow:0 2px 16px rgba(37,99,235,0.07); }
    .sc:last-child { margin-bottom:0; }
    .sc-head { padding:15px 22px; border-bottom:1.5px solid var(--blue-dim); background:rgba(219,234,254,0.28); display:flex; align-items:center; gap:10px; }
    .sc-num { width:26px; height:26px; border-radius:8px; background:var(--blue); color:#fff; font-size:11px; font-weight:800; font-family:'JetBrains Mono',monospace; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
    .sc-title { font-size:13px; font-weight:700; color:var(--blue-dark); }
    .sc-desc  { font-size:11px; color:var(--muted); margin-top:1px; }
    .sc-body  { padding:22px; }

    /* FORM FIELDS */
    .fg { margin-bottom:18px; }
    .fg:last-child { margin-bottom:0; }
    .fl { display:block; font-size:11px; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; color:var(--muted); margin-bottom:7px; }
    .fl .req  { color:#EF4444; margin-left:2px; }
    .fl .hint { text-transform:none; letter-spacing:0; font-weight:500; color:#b0bac9; }

    .fc { width:100%; padding:11px 14px; background:rgba(255,255,255,0.90); border:1.5px solid var(--blue-border); border-radius:10px; font-family:'Sora',sans-serif; font-size:14px; color:var(--text); transition:border-color .15s, box-shadow .15s; outline:none; box-sizing:border-box; }
    .fc::placeholder { color:var(--faint); }
    .fc:focus { border-color:var(--blue); box-shadow:0 0 0 3px rgba(37,99,235,0.13); background:#fff; }
    textarea.fc { resize:vertical; min-height:130px; line-height:1.65; }

    .rp-wrap { display:flex; border:1.5px solid var(--blue-border); border-radius:10px; overflow:hidden; background:rgba(255,255,255,0.90); transition:border-color .15s, box-shadow .15s; }
    .rp-wrap:focus-within { border-color:var(--blue); box-shadow:0 0 0 3px rgba(37,99,235,0.13); background:#fff; }
    .rp-prefix { padding:11px 14px; background:var(--blue-dim); color:var(--blue); font-weight:800; font-size:13px; font-family:'JetBrains Mono',monospace; border-right:1.5px solid var(--blue-border); flex-shrink:0; }
    .rp-wrap input { flex:1; border:none; outline:none; padding:11px 14px; background:transparent; font-family:'JetBrains Mono',monospace; font-size:14px; color:var(--text); min-width:0; }
    .rp-wrap input::placeholder { color:var(--faint); }

    .fh { display:flex; gap:5px; align-items:flex-start; font-size:11.5px; color:#b0bac9; margin-top:6px; }
    .fh i { color:var(--faint); font-size:11px; margin-top:1px; flex-shrink:0; }

    /* inline tags */
    .tag-row { display:flex; flex-wrap:wrap; gap:5px; margin-top:10px; min-height:24px; }
    .tag { display:inline-flex; align-items:center; gap:5px; padding:3px 10px; background:var(--blue-dim); border:1px solid var(--blue-border); color:var(--blue); font-size:11.5px; font-weight:600; border-radius:7px; animation:pop .18s ease both; }
    .tag i { font-size:9px; }

    /* STATUS TOGGLE */
    .status-grid { display:grid; grid-template-columns:1fr 1fr; gap:12px; }
    @media(max-width:480px){ .status-grid{ grid-template-columns:1fr; } }

    .status-opt {
    display: flex;
    align-items: center;
    justify-content: center; /* center horizontal */
    text-align: center;      /* center text */
    gap: 0;                  /* biar tidak ada jarak aneh */
    padding: 14px 16px;
    border-radius: 12px;
    cursor: pointer;
    border: 1.5px solid var(--blue-border);
    background: rgba(255,255,255,0.60);
    transition: all .18s ease;
}

.status-opt > div {
    display: flex;
    flex-direction: column;
    align-items: center; /* center isi dalam */
}
    .status-opt input[type="radio"] { display:none; }
    .status-opt:hover { border-color:var(--blue); background:var(--blue-dim); }
    .status-opt.sel-aktif    { border-color:rgba(16,185,129,0.45); background:rgba(16,185,129,0.07); box-shadow:0 0 0 3px rgba(16,185,129,0.12); }
    .status-opt.sel-nonaktif { border-color:rgba(239,68,68,0.40); background:rgba(239,68,68,0.06); box-shadow:0 0 0 3px rgba(239,68,68,0.10); }

    .s-dot { width:11px; height:11px; border-radius:50%; flex-shrink:0; }
    .s-dot.aktif    { background:#10b981; animation:pulse-dot 2s infinite; }
    .s-dot.nonaktif { background:#ef4444; }

    .s-title { font-size:13.5px; font-weight:700; color:var(--text); }
    .s-desc  { font-size:11px; color:var(--muted); margin-top:2px; }
    .sel-aktif    .s-title { color:#059669; }
    .sel-nonaktif .s-title { color:#dc2626; }

    /* ACTIONS */
    .actions { display:flex; justify-content:flex-end; align-items:center; gap:10px; padding:16px 22px; border-top:1.5px solid var(--blue-dim); background:rgba(219,234,254,0.18); }
    .btn-cancel { display:inline-flex; align-items:center; gap:6px; padding:10px 20px; border:1.5px solid var(--blue-border); background:transparent; color:var(--muted); font-family:'Sora',sans-serif; font-size:13px; font-weight:600; border-radius:10px; text-decoration:none; transition:all .15s; }
    .btn-cancel:hover { background:var(--blue-dim); color:var(--blue-dark); border-color:var(--blue); }
    .btn-save { display:inline-flex; align-items:center; gap:7px; padding:10px 24px; background:var(--blue); color:#fff; font-family:'Sora',sans-serif; font-size:13px; font-weight:700; border:none; border-radius:10px; cursor:pointer; box-shadow:0 3px 14px rgba(37,99,235,0.38); transition:all .18s; }
    .btn-save:hover { background:var(--blue-dark); transform:translateY(-1px); box-shadow:0 6px 22px rgba(37,99,235,0.48); }

    /* SIDEBAR */
    .sb { background:var(--surface); border:1.5px solid rgba(37,99,235,0.13); border-radius:var(--radius); overflow:hidden; box-shadow:0 2px 16px rgba(37,99,235,0.07); position:sticky; top:24px; }
    .sb-head { padding:14px 20px; border-bottom:1.5px solid var(--blue-dim); background:rgba(219,234,254,0.28); }
    .sb-head-label { font-size:10px; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:var(--faint); font-family:'JetBrains Mono',monospace; }
    .sb-head-title { font-size:13px; font-weight:800; color:var(--blue-dark); margin-top:2px; }
    .sb-body { padding:18px; }

    .prev-card { border:1.5px solid var(--blue-dim); border-radius:12px; padding:18px; background:rgba(255,255,255,0.65); }
    .prev-block { margin-bottom:14px; }
    .prev-block:last-child { margin-bottom:0; }
    .prev-label { font-size:9.5px; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:var(--faint); font-family:'JetBrains Mono',monospace; margin-bottom:5px; }
    .prev-val   { font-size:22px; font-weight:800; font-family:'JetBrains Mono',monospace; color:var(--blue-dark); letter-spacing:-0.5px; }
    .prev-price { font-size:18px; font-weight:800; font-family:'JetBrains Mono',monospace; color:var(--blue); }
    .prev-empty { font-size:12px; color:var(--faint); font-style:italic; }
    .prev-div   { height:1px; background:var(--blue-dim); margin:14px 0; }
    .prev-tags  { display:flex; flex-wrap:wrap; gap:4px; }
    .prev-tag   { padding:2px 9px; border-radius:6px; font-size:11px; font-weight:600; background:var(--blue-dim); border:1px solid var(--blue-border); color:var(--blue); }

    .note-box { margin-top:14px; padding:13px 15px; background:rgba(219,234,254,0.35); border:1px solid var(--blue-border); border-radius:10px; font-size:12px; color:var(--muted); line-height:1.65; }
    .note-box strong { color:var(--blue-dark); }

    .fl .req {
    display: none !important;
}
</style>

{{-- HEADER --}}
<div class="ph">
    <div>
        <div class="ph-kicker">Manajemen Properti</div>
        <div class="ph-title">Edit Kamar</div>
    </div>
    <a href="{{ route('kamar') }}" class="btn-back">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

{{-- FORM --}}
<form method="POST" action="{{ route('kamar.update', $kamar->id_kamar) }}" id="frmEdit">
    @csrf

    <div class="grid">

        {{-- KIRI --}}
        <div>

            {{-- 1. Identitas --}}
            <div class="sc">
                <div class="sc-head">
                   
                    <div>
                        <div class="sc-title">Identitas Kamar</div>
                        <div class="sc-desc">Nomor unik untuk unit ini</div>
                    </div>
                </div>
                <div class="sc-body">
                    <div class="fg">
                        <label class="fl">Nomor Kamar <span class="req">*</span></label>
                        <input type="text" name="nomor_kamar" id="iNomor"
                               class="fc" value="{{ $kamar->nomor_kamar }}"
                               required autocomplete="off">
                        
                    </div>
                </div>
            </div>

            {{-- 2. Harga --}}
            <div class="sc">
                <div class="sc-head">
                    
                    <div>
                        <div class="sc-title">Harga Sewa</div>
                        <div class="sc-desc">Tarif per bulan dalam Rupiah</div>
                    </div>
                </div>
                <div class="sc-body">
                    <div class="fg">
                        <label class="fl">Harga / Bulan <span class="req">*</span></label>
                        <div class="rp-wrap">
                            <span class="rp-prefix">Rp</span>
                            <input type="text" id="iHargaDisplay" placeholder="1.500.000" inputmode="numeric" autocomplete="off">
                        </div>
                        <input type="hidden" name="harga_sewa" id="iHargaReal">
                       
                    </div>
                </div>
            </div>

            {{-- 3. Fasilitas --}}
            <div class="sc">
                <div class="sc-head">
                    
                    <div>
                        <div class="sc-title">Fasilitas</div>
                        <div class="sc-desc">Satu fasilitas per baris</div>
                    </div>
                </div>
                <div class="sc-body">
                    <div class="fg">
                        <label class="fl">Daftar Fasilitas </label>
                        <textarea name="fasilitas_kamar" id="iFas" class="fc">{{ $kamar->fasilitas_kamar }}</textarea>
                       
                        <div class="tag-row" id="tagInline"></div>
                    </div>
                </div>
            </div>

            {{-- 4. Status --}}
            <div class="sc">
                <div class="sc-head">
                    <div>
                        <div class="sc-title">Status Kamar</div>
                        <div class="sc-desc">Aktif atau non-aktif untuk disewa</div>
                    </div>
                </div>
                <div class="sc-body">

                    @error('status_kamar')
                    <div style="background:rgba(239,68,68,0.08);border:1.5px solid rgba(239,68,68,0.28);border-radius:10px;padding:10px 14px;margin-bottom:14px;font-size:12px;color:#dc2626;display:flex;align-items:center;gap:8px;">
                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                    </div>
                    @enderror

                    <div class="status-grid">
                        <label class="status-opt {{ $kamar->status_kamar === 'aktif' ? 'sel-aktif' : '' }}" id="lblAktif">
                            <input type="radio" name="status_kamar" value="aktif"
                                   {{ $kamar->status_kamar === 'aktif' ? 'checked' : '' }}
                                   onchange="toggleStatus(this)">
                           
                            <div>
                                <div class="s-title">Aktif</div>
                            </div>
                        </label>

                        <label class="status-opt {{ $kamar->status_kamar === 'nonaktif' ? 'sel-nonaktif' : '' }}" id="lblNonaktif">
                            <input type="radio" name="status_kamar" value="nonaktif"
                                   {{ $kamar->status_kamar === 'nonaktif' ? 'checked' : '' }}
                                   onchange="toggleStatus(this)">
                            
                            <div>
                                <div class="s-title">Non-Aktif</div>                          
                            </div>
                        </label>
                    </div>
                </div>
                <div class="actions">
                    <a href="{{ route('kamar') }}" class="btn-cancel">
                        <i class="bi bi-x"></i> Batal
                    </a>
                    <button type="submit" class="btn-save">
                        <i class="bi bi-check2"></i> Update Kamar
                    </button>
                </div>
            </div>

        </div>

        {{-- KANAN — PREVIEW --}}
        <div>
            <div class="sb">
                <div class="sb-head">
                   
                    <div class="sb-head-title">Tampilan Perubahan Data Kamar</div>
                </div>
                <div class="sb-body">
                    <div class="prev-card">

                        <div class="prev-block">
                            <div class="prev-label">Nomor</div>
                            <div class="prev-val" id="pNomor">
                                <span style="color:var(--blue-dark)">{{ $kamar->nomor_kamar }}</span>
                            </div>
                        </div>

                        <div class="prev-div"></div>

                        <div class="prev-block">
                            <div class="prev-label">Harga / Bulan</div>
                            <div class="prev-price" id="pHarga">
                                <span class="prev-empty">Rp —</span>
                            </div>
                        </div>

                        <div class="prev-div"></div>

                        <div class="prev-block">
                            <div class="prev-label">Fasilitas</div>
                            <div class="prev-tags" id="pTags">
                                <span class="prev-empty">Belum ada</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</form>

<script>
(function () {

    function formatRibuan(angka) {
        return angka.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function bersihkan(val) {
        return val.replace(/\D/g, '');
    }

    let display = document.getElementById("iHargaDisplay");
    let real    = document.getElementById("iHargaReal");

    let iNomor  = document.getElementById("iNomor");
    let iFas    = document.getElementById("iFas");

    let pNomor  = document.getElementById("pNomor");
    let pHarga  = document.getElementById("pHarga");
    let pTags   = document.getElementById("pTags");

    let lblAktif    = document.getElementById("lblAktif");
    let lblNonaktif = document.getElementById("lblNonaktif");

    let radioStatus = document.querySelectorAll('input[name="status_kamar"]');

    // ✅ DATA DARI BACKEND (AMAN)
    let dbHarga = @json($kamar->harga_sewa ?? 0);
    let dbFas   = @json($kamar->fasilitas_kamar ?? '');

    /* =========================
       INIT SAAT LOAD
    ========================= */

    // Harga
    if (dbHarga) {
        display.value = formatRibuan(dbHarga.toString());
        real.value    = dbHarga;
        pHarga.innerHTML = "Rp " + formatRibuan(dbHarga.toString());
    }

    // Fasilitas
    if (dbFas) {
        let items = dbFas.split("\n").filter(i => i.trim() !== "");
        if (items.length) {
            pTags.innerHTML = items.map(i =>
                `<span class="prev-tag">${i}</span>`
            ).join('');
        }
    }

    // Status INIT
    radioStatus.forEach(r => {
        if (r.checked) {
            updateStatusUI(r.value);
        }
    });

    /* =========================
       LIVE UPDATE
    ========================= */

    // NOMOR
    iNomor.addEventListener("input", function () {
        pNomor.innerHTML = `<span>${this.value || "-"}</span>`;
    });

    // HARGA
    display.addEventListener("input", function () {

        let angka = bersihkan(this.value);

        this.value = formatRibuan(angka);
        real.value = angka;

        pHarga.innerHTML = angka
            ? "Rp " + formatRibuan(angka)
            : "Rp —";
    });

    // FASILITAS
    iFas.addEventListener("input", function () {

        let items = this.value.split("\n").filter(i => i.trim() !== "");

        if (!items.length) {
            pTags.innerHTML = `<span class="prev-empty">Belum ada</span>`;
            return;
        }

        pTags.innerHTML = items.map(i =>
            `<span class="prev-tag">${i}</span>`
        ).join('');
    });

    // STATUS (FIX UTAMA)
    radioStatus.forEach(r => {
        r.addEventListener("change", function () {
            updateStatusUI(this.value);
        });
    });

    function updateStatusUI(val) {
        lblAktif.classList.remove("sel-aktif");
        lblNonaktif.classList.remove("sel-nonaktif");

        if (val === "aktif") {
            lblAktif.classList.add("sel-aktif");
        } else {
            lblNonaktif.classList.add("sel-nonaktif");
        }
    }

    /* =========================
       SUBMIT FIX
    ========================= */

    document.getElementById("frmEdit").addEventListener("submit", function () {

        let clean = bersihkan(display.value);
        real.value = parseInt(clean || 0);

    });

})();
</script>
@endsection