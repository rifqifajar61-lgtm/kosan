@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    body { background: transparent !important; color: #0f1733 !important; }

    :root {
        --blue:        #2563EB;
        --blue-dark:   #1E40AF;
        --blue-dim:    #DBEAFE;
        --blue-border: #BFDBFE;
        --surface:     rgba(255,255,255,0.86);
        --muted:       #5a6a8a;
        --faint:       #93C5FD;
        --radius:      14px;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(14px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50%       { opacity: 0.4; }
    }

    .page-header {
        display: flex; align-items: flex-end; justify-content: space-between; gap: 16px;
        margin-bottom: 20px; animation: fadeUp .35s ease both;
    }
    .ph-left { display: flex; flex-direction: column; gap: 4px; }
    .ph-kicker { font-size: 10px; font-weight: 700; letter-spacing: 3px; text-transform: uppercase; color: var(--faint); font-family: 'JetBrains Mono', monospace; }
    .ph-title  { font-size: 26px; font-weight: 800; color: var(--blue-dark); letter-spacing: -0.6px; line-height: 1; display: flex; align-items: center; gap: 8px; }
    .ph-badge  { font-size: 10px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; background: var(--blue-dim); color: var(--blue); border: 1px solid var(--blue-border); padding: 2px 10px; border-radius: 6px; font-family: 'JetBrains Mono', monospace; vertical-align: middle; }
    .btn-back  { display: inline-flex; align-items: center; gap: 7px; padding: 9px 18px; border: 1.5px solid var(--blue-border); background: var(--surface); color: var(--blue); font-family: 'Sora', sans-serif; font-size: 13px; font-weight: 600; border-radius: 10px; text-decoration: none; transition: all .18s; }
    .btn-back:hover { background: var(--blue-dim); border-color: var(--blue); color: var(--blue-dark); transform: translateX(-2px); }

    .bc { display: flex; align-items: center; gap: 6px; font-size: 12px; color: var(--muted); margin-bottom: 22px; }
    .bc a { color: var(--muted); text-decoration: none; }
    .bc a:hover { color: var(--blue); }
    .bc .sep { color: var(--blue-border); }
    .bc .cur { color: var(--blue); font-weight: 700; }

    .form-layout { display: grid; grid-template-columns: 1fr 300px; gap: 20px; align-items: start; animation: fadeUp .4s .05s ease both; }
    @media (max-width: 860px) { .form-layout { grid-template-columns: 1fr; } }

    .sc { background: var(--surface); border: 1.5px solid rgba(37,99,235,0.13); border-radius: var(--radius); overflow: hidden; margin-bottom: 16px; box-shadow: 0 2px 16px rgba(37,99,235,0.07); }
    .sc:last-child { margin-bottom: 0; }
    .sc::before { content: ''; display: block; height: 2px; background: var(--blue); }
    .sc-head { padding: 15px 22px; border-bottom: 1.5px solid var(--blue-dim); background: rgba(219,234,254,0.28); display: flex; align-items: center; gap: 10px; }
    .sc-icon { width: 34px; height: 34px; border-radius: 9px; background: var(--blue-dim); border: 1.5px solid var(--blue-border); display: flex; align-items: center; justify-content: center; font-size: 15px; color: var(--blue); flex-shrink: 0; }
    .sc-title { font-size: 13px; font-weight: 700; color: var(--blue-dark); }
    .sc-desc  { font-size: 11px; color: var(--muted); margin-top: 1px; }
    .sc-body  { padding: 22px; }

    .fg { margin-bottom: 18px; }
    .fg:last-child { margin-bottom: 0; }
    .fg-grid2 { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
    @media (max-width: 560px) { .fg-grid2 { grid-template-columns: 1fr; } }
    .fl { display: block; font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--muted); margin-bottom: 7px; }
    .fl .req { color: #EF4444; margin-left: 2px; }
    .fc { width: 100%; padding: 11px 14px; background: rgba(255,255,255,0.90); border: 1.5px solid var(--blue-border); border-radius: 10px; font-family: 'Sora', sans-serif; font-size: 14px; color: #0f1733; transition: border-color .15s, box-shadow .15s; outline: none; box-sizing: border-box; }
    .fc::placeholder { color: var(--faint); }
    .fc:focus { border-color: var(--blue); box-shadow: 0 0 0 3px rgba(37,99,235,0.12); background: #fff; }
    select.fc { appearance: none; -webkit-appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%232563EB' stroke-width='2.5'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 14px center; padding-right: 38px; background-color: rgba(255,255,255,0.90); }
    select.fc option { background: #fff; color: #0f1733; }
    .fh { display: flex; gap: 5px; align-items: flex-start; font-size: 11.5px; color: #b0bac9; margin-top: 6px; }
    .fh i { color: var(--faint); font-size: 11px; margin-top: 1px; flex-shrink: 0; }
    .field-error { font-size: 11.5px; color: #dc2626; margin-top: 6px; display: flex; align-items: center; gap: 5px; }

    .alert-error { display: flex; align-items: flex-start; gap: 12px; background: rgba(239,68,68,0.06); border: 1.5px solid rgba(239,68,68,0.20); border-radius: 12px; padding: 14px 18px; margin-bottom: 20px; }
    .alert-error-title { font-size: 13px; font-weight: 700; color: #dc2626; margin-bottom: 4px; }
    .alert-error-list { list-style: none; padding: 0; margin: 0; }
    .alert-error-list li { font-size: 12px; color: #ef4444; padding: 2px 0; display: flex; align-items: flex-start; gap: 6px; font-weight: 500; }
    .alert-error-list li::before { content: '→'; flex-shrink: 0; }

    .actions { display: flex; justify-content: flex-end; align-items: center; gap: 10px; padding: 16px 22px; border-top: 1.5px solid var(--blue-dim); background: rgba(219,234,254,0.18); }
    .btn-cancel {
    display: inline-flex; align-items: center; gap: 6px; padding: 10px 20px;
    border: 1.5px solid #dc2626; background: #dc2626;
    color: #fff; font-family: 'Sora', sans-serif; font-size: 13px; font-weight: 600;
    border-radius: 10px; text-decoration: none; transition: all .15s;
}
.btn-cancel:hover { background: #b91c1c; border-color: #b91c1c; color: #fff; }
    .btn-save { display: inline-flex; align-items: center; gap: 7px; padding: 10px 24px; background: var(--blue); color: #fff; font-family: 'Sora', sans-serif; font-size: 13px; font-weight: 700; border: none; border-radius: 10px; cursor: pointer; box-shadow: 0 3px 14px rgba(37,99,235,0.38); transition: all .18s; }
    .btn-save:hover { background: var(--blue-dark); transform: translateY(-1px); box-shadow: 0 6px 22px rgba(37,99,235,0.48); }

    /* SIDEBAR */
    .sb { background: var(--surface); border: 1.5px solid rgba(37,99,235,0.13); border-radius: var(--radius); overflow: hidden; box-shadow: 0 2px 16px rgba(37,99,235,0.07); position: sticky; top: 24px; }
    .sb::before { content: ''; display: block; height: 2px; background: var(--blue); }
    .sb-head { padding: 14px 20px; border-bottom: 1.5px solid var(--blue-dim); background: rgba(219,234,254,0.28); }
    .sb-kicker { font-size: 10px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: var(--faint); font-family: 'JetBrains Mono', monospace; }
    .sb-title  { font-size: 13px; font-weight: 800; color: var(--blue-dark); margin-top: 2px; }
    .sb-body   { padding: 18px; }

    .prev-card { border: 1.5px solid var(--blue-dim); border-radius: 12px; padding: 16px; background: rgba(255,255,255,0.65); }
    .prev-penghuni { display: flex; align-items: center; gap: 10px; margin-bottom: 14px; padding-bottom: 14px; border-bottom: 1px solid var(--blue-dim); }
    .prev-avatar { width: 40px; height: 40px; border-radius: 11px; background: var(--blue-dim); border: 1.5px solid var(--blue-border); color: var(--blue); display: flex; align-items: center; justify-content: center; font-size: 16px; font-weight: 800; font-family: 'JetBrains Mono', monospace; flex-shrink: 0; }
    .prev-pname { font-size: 14px; font-weight: 700; color: var(--blue-dark); }
    .prev-pname.empty { font-size: 12px; font-weight: 400; color: var(--faint); font-style: italic; }

    .prev-list { list-style: none; padding: 0; margin: 0; }
    .prev-item { display: flex; align-items: flex-start; gap: 9px; padding: 8px 0; border-bottom: 1px solid var(--blue-dim); }
    .prev-item:last-child { border-bottom: none; }
    .prev-ico { width: 26px; height: 26px; border-radius: 7px; background: var(--blue-dim); border: 1px solid var(--blue-border); display: flex; align-items: center; justify-content: center; font-size: 11px; color: var(--blue); flex-shrink: 0; margin-top: 1px; }
    .prev-lbl { font-size: 10px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--faint); margin-bottom: 2px; }
    .prev-val { font-size: 12px; font-weight: 600; color: var(--blue-dark); }
    .prev-val.empty { color: var(--faint); font-style: italic; font-weight: 400; }
    .prev-status-badge { display: inline-flex; align-items: center; gap: 5px; padding: 3px 10px; border-radius: 999px; font-size: 11px; font-weight: 700; background: rgba(16,185,129,0.12); border: 1px solid rgba(16,185,129,0.25); color: #059669; }
    .prev-status-badge::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: #10b981; display: inline-block; animation: pulse 2s infinite; }

    .sc::before,
.sb::before {
    display: none !important;
}

.fl .req {
    display: none !important;
}
</style>

<div class="page-header">
    <div class="ph-left">
        <div class="ph-kicker">Manajemen Sewa</div>
        <div class="ph-title">Tambah Sewa Baru</div>
    </div>
</div>



@if ($errors->any())
<div class="alert-error">
    <div>
        <div class="alert-error-title">Terdapat kesalahan, periksa kembali data berikut:</div>
        <ul class="alert-error-list">
            @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
</div>
@endif

<form action="{{ route('sewa.simpan') }}" method="POST" id="formTambahSewa">
    @csrf
    <input type="hidden" name="status" value="aktif">

    <div class="form-layout">
        <div>
            {{-- Penghuni & Kamar --}}
            <div class="sc">
                <div class="sc-head">
                    <div><div class="sc-title">Penghuni & Kamar</div><div class="sc-desc">Pilih penghuni dan kamar yang disewa</div></div>
                </div>
                <div class="sc-body">
                    <div class="fg">
                        <label class="fl">Penghuni <span class="req">*</span></label>
                        <select name="id_penghuni" id="selectPenghuni" class="fc @error('id_penghuni') is-invalid @enderror" required>
                            <option value="" disabled selected>— Pilih penghuni —</option>
                            @foreach ($penghuni as $p)
                                <option value="{{ $p->id_penghuni }}" data-nama="{{ $p->nama_penghuni }}"
                                        {{ old('id_penghuni') == $p->id_penghuni ? 'selected' : '' }}>
                                    {{ $p->nama_penghuni }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_penghuni')<div class="field-error"><i class="bi bi-exclamation-circle-fill"></i> {{ $message }}</div>@enderror
                    </div>
                    <div class="fg">
                        <label class="fl">Kamar <span class="req">*</span></label>
                        <select name="id_kamar" id="selectKamar" class="fc @error('id_kamar') is-invalid @enderror" required>
                            <option value="" disabled selected>— Pilih kamar —</option>
                            @foreach ($kamar as $k)
                                <option value="{{ $k->id_kamar }}"
                                        data-nomor="{{ $k->nomor_kamar }}"
                                        data-harga="{{ number_format($k->harga_sewa,0,',','.') }}"
                                        {{ old('id_kamar') == $k->id_kamar ? 'selected' : '' }}>
                                    Kamar {{ $k->nomor_kamar }} — Rp {{ number_format($k->harga_sewa,0,',','.') }}/bln
                                </option>
                            @endforeach
                        </select>
                        @error('id_kamar')<div class="field-error"><i class="bi bi-exclamation-circle-fill"></i> {{ $message }}</div>@enderror
                        
                    </div>
                </div>
            </div>

            {{-- Periode Sewa + Actions (digabung) --}}
            <div class="sc">
                <div class="sc-head">
                    <div><div class="sc-title">Periode Sewa</div><div class="sc-desc">Tanggal mulai dan selesai kontrak</div></div>
                </div>
                <div class="sc-body">
                    <div class="fg fg-grid2">
                        <div>
                            <label class="fl">Tanggal Mulai <span class="req">*</span></label>
                            <input type="date" name="tanggal_mulai" id="inputMulai" class="fc"
                                   value="{{ old('tanggal_mulai', date('Y-m-d')) }}" required>
                        </div>
                        <div>
                            <label class="fl">Tanggal Selesai <span class="req">*</span></label>
                            <input type="date" name="tanggal_selesai" id="inputSelesai" class="fc"
                                   value="{{ old('tanggal_selesai') }}" required>
                        </div>
                    </div>
                    <div class="fh" id="durasiHelper" style="display:none">
                        <i class="bi bi-clock"></i>
                        <span id="durasiText"></span>
                    </div>
                </div>
                <div class="actions">
                    <a href="{{ route('sewa') }}" class="btn-cancel"> Batal</a>
                    <button type="submit" class="btn-save">Simpan Sewa</button>
                </div>
            </div>
        </div>

        {{-- SIDEBAR --}}
        <div>
            <div class="sb">
                <div class="sb-head">
                    
                    <div class="sb-title">Tampilan Kontrak Sewa</div>
                </div>
                <div class="sb-body">
                    <div class="prev-card">
                        <div class="prev-penghuni">
                            <div class="prev-avatar" id="prevAvatar">?</div>
                            <div class="prev-pname empty" id="prevNama">Penghuni belum dipilih</div>
                        </div>
                        <ul class="prev-list">
                            <li class="prev-item">
                                <div><div class="prev-lbl">Kamar</div><div class="prev-val empty" id="prevKamar">—</div></div>
                            </li>
                            <li class="prev-item">
                                <div><div class="prev-lbl">Harga Sewa</div><div class="prev-val empty" id="prevHarga">—</div></div>
                            </li>
                            <li class="prev-item">
                               
                                <div><div class="prev-lbl">Tanggal Mulai</div><div class="prev-val empty" id="prevMulai">—</div></div>
                            </li>
                            <li class="prev-item">
                                
                                <div><div class="prev-lbl">Tanggal Selesai</div><div class="prev-val empty" id="prevSelesai">—</div></div>
                            </li>
                            <li class="prev-item">
                                
                                <div><div class="prev-lbl">Status</div><div><span class="prev-status-badge">Aktif</span></div></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    function formatTgl(val) {
        if (!val) return null;
        const d = new Date(val);
        if (isNaN(d)) return null;
        return d.toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' });
    }
    function setVal(el, val, emptyText) {
        if (val) { el.textContent = val; el.classList.remove('empty'); }
        else      { el.textContent = emptyText; el.classList.add('empty'); }
    }

    document.getElementById('selectPenghuni').addEventListener('change', function() {
        const opt = this.options[this.selectedIndex];
        const nama = opt.dataset.nama || '';
        const el = document.getElementById('prevNama');
        if (nama) { el.textContent = nama; el.className = 'prev-pname'; document.getElementById('prevAvatar').textContent = nama.charAt(0).toUpperCase(); }
        else { el.textContent = 'Penghuni belum dipilih'; el.className = 'prev-pname empty'; document.getElementById('prevAvatar').textContent = '?'; }
    });
    document.getElementById('selectKamar').addEventListener('change', function() {
        const opt = this.options[this.selectedIndex];
        setVal(document.getElementById('prevKamar'), opt.dataset.nomor ? 'Kamar ' + opt.dataset.nomor : null, '—');
        setVal(document.getElementById('prevHarga'), opt.dataset.harga ? 'Rp ' + opt.dataset.harga + ' / bulan' : null, '—');
    });

    const inputMulai   = document.getElementById('inputMulai');
    const inputSelesai = document.getElementById('inputSelesai');
    function updateTanggal() {
        setVal(document.getElementById('prevMulai'),   formatTgl(inputMulai.value),   '—');
        setVal(document.getElementById('prevSelesai'), formatTgl(inputSelesai.value), '—');
        if (inputMulai.value && inputSelesai.value) {
            const selisih = Math.round((new Date(inputSelesai.value) - new Date(inputMulai.value)) / 86400000);
            if (selisih > 0) {
                const bulan = Math.floor(selisih / 30), sisa = selisih % 30;
                let durasi = '';
                if (bulan > 0) durasi += bulan + ' bulan ';
                if (sisa  > 0) durasi += sisa  + ' hari';
                document.getElementById('durasiText').textContent = 'Durasi kontrak: ' + durasi.trim();
                document.getElementById('durasiHelper').style.display = 'flex';
            } else { document.getElementById('durasiHelper').style.display = 'none'; }
        } else { document.getElementById('durasiHelper').style.display = 'none'; }
    }
    inputMulai.addEventListener('change', updateTanggal);
    inputSelesai.addEventListener('change', updateTanggal);

    if (document.getElementById('selectPenghuni').value) document.getElementById('selectPenghuni').dispatchEvent(new Event('change'));
    if (document.getElementById('selectKamar').value)    document.getElementById('selectKamar').dispatchEvent(new Event('change'));
    updateTanggal();
</script>

@endsection