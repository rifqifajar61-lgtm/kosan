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
    @keyframes fadeField {
        from { opacity: 0; transform: translateY(-4px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .page-header { display: flex; align-items: flex-end; justify-content: space-between; gap: 16px; margin-bottom: 20px; animation: fadeUp .35s ease both; }
    .ph-left { display: flex; flex-direction: column; gap: 4px; }
    .ph-kicker { font-size: 10px; font-weight: 700; letter-spacing: 3px; text-transform: uppercase; color: var(--faint); font-family: 'JetBrains Mono', monospace; }
    .ph-title  { font-size: 26px; font-weight: 800; color: var(--blue-dark); letter-spacing: -0.6px; line-height: 1; display: flex; align-items: center; gap: 8px; }
    .ph-badge  { font-size: 10px; font-weight: 700; background: var(--blue-dim); color: var(--blue); border: 1px solid var(--blue-border); padding: 2px 10px; border-radius: 6px; font-family: 'JetBrains Mono', monospace; }
    .btn-back  { display: inline-flex; align-items: center; gap: 7px; padding: 9px 18px; border: 1.5px solid var(--blue-border); background: var(--surface); color: var(--blue); font-family: 'Sora', sans-serif; font-size: 13px; font-weight: 600; border-radius: 10px; text-decoration: none; transition: all .18s; flex-shrink: 0; }
    .btn-back:hover { background: var(--blue-dim); border-color: var(--blue); color: var(--blue-dark); transform: translateX(-2px); }

    .bc { display: flex; align-items: center; gap: 6px; font-size: 12px; color: var(--muted); margin-bottom: 22px; }
    .bc a { color: var(--muted); text-decoration: none; }
    .bc a:hover { color: var(--blue); }
    .bc .sep { color: var(--blue-border); }
    .bc .cur { color: var(--blue); font-weight: 700; }

    .form-layout { display: grid; grid-template-columns: 1fr 300px; gap: 20px; align-items: start; animation: fadeUp .4s .05s ease both; }
    @media (max-width: 860px) { .form-layout { grid-template-columns: 1fr; } }

    .sc { background: var(--surface); border: 1.5px solid rgba(37,99,235,0.13); border-radius: var(--radius); overflow: hidden; box-shadow: 0 2px 16px rgba(37,99,235,0.07); }
    .sc::before { content: ''; display: block; height: 2px; background: var(--blue); }
    .sc-head { padding: 15px 22px; border-bottom: 1.5px solid var(--blue-dim); background: rgba(219,234,254,0.28); display: flex; align-items: center; gap: 10px; }
    .sc-icon { width: 34px; height: 34px; border-radius: 9px; background: var(--blue-dim); border: 1.5px solid var(--blue-border); display: flex; align-items: center; justify-content: center; font-size: 15px; color: var(--blue); flex-shrink: 0; }
    .sc-title { font-size: 13px; font-weight: 700; color: var(--blue-dark); }
    .sc-desc  { font-size: 11px; color: var(--muted); margin-top: 1px; }
    .sc-body  { padding: 22px; display: flex; flex-direction: column; gap: 16px; }

    .fg { display: flex; flex-direction: column; gap: 7px; }
    .fg.hidden { display: none; }
    .fl { font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--muted); }
    .fl .req { color: #EF4444; margin-left: 2px; }
    .fc { width: 100%; padding: 11px 14px; background: rgba(255,255,255,0.90); border: 1.5px solid var(--blue-border); border-radius: 10px; font-family: 'Sora', sans-serif; font-size: 14px; color: #0f1733; transition: border-color .15s, box-shadow .15s; outline: none; box-sizing: border-box; }
    .fc::placeholder { color: var(--faint); }
    .fc:focus { border-color: var(--blue); box-shadow: 0 0 0 3px rgba(37,99,235,0.12); background: #fff; }
    select.fc { appearance: none; -webkit-appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%232563EB' stroke-width='2.5'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 14px center; padding-right: 38px; background-color: rgba(255,255,255,0.90); }
    select.fc option { background: #fff; color: #0f1733; }
    .fh { display: flex; gap: 5px; align-items: flex-start; font-size: 11.5px; color: #b0bac9; }
    .fh i { color: var(--faint); font-size: 11px; margin-top: 1px; flex-shrink: 0; }
    .field-error { font-size: 11.5px; color: #dc2626; display: flex; align-items: center; gap: 5px; }

    .alert-error { display: flex; align-items: flex-start; gap: 12px; background: rgba(239,68,68,0.06); border: 1.5px solid rgba(239,68,68,0.20); border-radius: 12px; padding: 14px 18px; margin-bottom: 20px; }
    .alert-error-title { font-size: 13px; font-weight: 700; color: #dc2626; margin-bottom: 4px; }
    .alert-error-list { list-style: none; padding: 0; margin: 0; }
    .alert-error-list li { font-size: 12px; color: #ef4444; padding: 2px 0; font-weight: 500; }
    .alert-error-list li::before { content: '→ '; }

    .actions { display: flex; justify-content: flex-end; align-items: center; gap: 10px; padding: 16px 22px; border-top: 1.5px solid var(--blue-dim); background: rgba(219,234,254,0.18); }
    .btn-cancel { display: inline-flex; align-items: center; gap: 6px; padding: 10px 20px; border: 1.5px solid var(--blue-border); background: transparent; color: var(--muted); font-family: 'Sora', sans-serif; font-size: 13px; font-weight: 600; border-radius: 10px; text-decoration: none; transition: all .15s; }
    .btn-cancel:hover { background: var(--blue-dim); color: var(--blue-dark); border-color: var(--blue); }
    .btn-save { display: inline-flex; align-items: center; gap: 7px; padding: 10px 24px; background: var(--blue); color: #fff; font-family: 'Sora', sans-serif; font-size: 13px; font-weight: 700; border: none; border-radius: 10px; cursor: pointer; box-shadow: 0 3px 14px rgba(37,99,235,0.38); transition: all .18s; }
    .btn-save:hover { background: var(--blue-dark); transform: translateY(-1px); box-shadow: 0 6px 22px rgba(37,99,235,0.48); }

    /* Sidebar */
    .sb { background: var(--surface); border: 1.5px solid rgba(37,99,235,0.13); border-radius: var(--radius); overflow: hidden; box-shadow: 0 2px 16px rgba(37,99,235,0.07); position: sticky; top: 24px; }
    .sb::before { content: ''; display: block; height: 2px; background: var(--blue); }
    .sb-head { padding: 14px 20px; border-bottom: 1.5px solid var(--blue-dim); background: rgba(219,234,254,0.28); }
    .sb-kicker { font-size: 10px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: var(--faint); font-family: 'JetBrains Mono', monospace; }
    .sb-title  { font-size: 13px; font-weight: 800; color: var(--blue-dark); margin-top: 2px; }
    .sb-body   { padding: 18px; }

    .prev-nominal-box { background: rgba(255,255,255,0.65); border: 1.5px solid var(--blue-border); border-top: 2px solid var(--blue); border-radius: 12px; padding: 18px; margin-bottom: 14px; text-align: center; }
    .prev-nominal-label { font-size: 10px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: var(--faint); margin-bottom: 8px; }
    .prev-nominal-value { font-size: 24px; font-weight: 800; font-family: 'JetBrains Mono', monospace; color: var(--blue-dark); letter-spacing: -0.5px; line-height: 1; }
    .prev-nominal-value.empty { font-size: 14px; font-weight: 400; font-style: italic; color: var(--faint); }
    .prev-nominal-sub { font-size: 11px; color: var(--muted); margin-top: 6px; }

    .prev-list { list-style: none; padding: 0; margin: 0; }
    .prev-item { display: flex; align-items: flex-start; gap: 9px; padding: 8px 0; border-bottom: 1px solid var(--blue-dim); }
    .prev-item:last-child { border-bottom: none; }
    .prev-ico { width: 26px; height: 26px; border-radius: 7px; background: var(--blue-dim); border: 1px solid var(--blue-border); display: flex; align-items: center; justify-content: center; font-size: 11px; color: var(--blue); flex-shrink: 0; margin-top: 1px; }
    .prev-lbl { font-size: 10px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--faint); margin-bottom: 2px; }
    .prev-val { font-size: 12px; font-weight: 600; color: var(--blue-dark); }
    .prev-val.empty { color: var(--faint); font-style: italic; font-weight: 400; }

    .tips-card { background: rgba(219,234,254,0.35); border: 1px solid var(--blue-border); border-radius: 10px; padding: 14px 16px; margin-top: 14px; }
    .tips-title { font-size: 10px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--blue); margin-bottom: 8px; }
    .tips-list { list-style: none; padding: 0; margin: 0; }
    .tips-list li { font-size: 12px; color: var(--muted); font-weight: 500; padding: 3px 0; padding-left: 14px; position: relative; }
    .tips-list li::before { content: '–'; position: absolute; left: 0; color: var(--blue); font-weight: 700; }

    .fl .req {
    display: none !important;
}
.sc::before,
.sb::before {
    display: none !important;
}
</style>

<div class="page-header">
    <div class="ph-left">
        <div class="ph-kicker">Manajemen Keuangan</div>
        <div class="ph-title">Edit Pengeluaran</div>
    </div>
</div>

@if ($errors->any())
<div class="alert-error">
    <div>
        <div class="alert-error-title">Terdapat kesalahan:</div>
        <ul class="alert-error-list">
            @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
</div>
@endif

<form action="{{ route('pengeluaran.update', $pengeluaran->id_pengeluaran) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-layout">
        <div class="sc">
            <div class="sc-head">
                
                <div><div class="sc-title">Edit Detail Pengeluaran</div><div class="sc-desc">Perbarui data transaksi pengeluaran</div></div>
            </div>
            <div class="sc-body">
                <div class="fg">
                    <label class="fl">Tanggal Pengeluaran <span class="req">*</span></label>
                    <input type="date" name="tanggal" id="inputTanggal" class="fc"
                           value="{{ old('tanggal', \Carbon\Carbon::parse($pengeluaran->tanggal)->format('Y-m-d')) }}" required>
                </div>
                <div class="fg">
                    <label class="fl">Jenis Pengeluaran <span class="req">*</span></label>
                    <select name="jenis_pengeluaran" id="jenisSelect" class="fc" required>
                        <option value="" disabled>— Pilih jenis —</option>
                        @foreach(['Listrik','Air','Internet','Kebersihan','Perbaikan','Lainnya'] as $j)
                            <option value="{{ $j }}" {{ old('jenis_pengeluaran', $pengeluaran->jenis_pengeluaran)==$j ? 'selected':'' }}>{{ $j }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="fg hidden" id="fieldKeterangan"
                     style="{{ old('jenis_pengeluaran', $pengeluaran->jenis_pengeluaran)=='Lainnya' ? 'display:flex' : '' }}">
                    <label class="fl">Keterangan <span class="req">*</span></label>
                    <input type="text" name="keterangan" id="inputKeterangan" class="fc"
                           placeholder="Tuliskan keterangan pengeluaran..."
                           value="{{ old('keterangan', $pengeluaran->keterangan) }}"
                           style="animation:fadeField .2s ease both"
                           {{ old('jenis_pengeluaran', $pengeluaran->jenis_pengeluaran)=='Lainnya' ? 'required':'' }}>
                </div>
                <div class="fg">
                    <label class="fl">Jumlah / Nominal <span class="req">*</span></label>
                    <input type="text" name="jumlah" id="inputJumlah" class="fc"
                           placeholder="Contoh: 150.000"
                           value="{{ old('jumlah', number_format($pengeluaran->jumlah, 0, ',', '.')) }}" required>
                </div>
            </div>
            <div class="actions">
                <a href="{{ route('pengeluaran') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-save"><i class="bi bi-floppy2-fill"></i> Simpan Perubahan</button>
            </div>
        </div>

        {{-- Sidebar --}}
        <div>
            <div class="sb">
                <div class="sb-head">
                    <div class="sb-kicker">Preview</div>
                    <div class="sb-title">Pengeluaran</div>
                </div>
                <div class="sb-body">
                    <div class="prev-nominal-box">
                        <div class="prev-nominal-label">Jumlah Pengeluaran</div>
                        <div class="prev-nominal-value" id="prevNominal">Rp {{ number_format($pengeluaran->jumlah,0,',','.') }}</div>
                        <div class="prev-nominal-sub" id="prevTanggalSub">{{ \Carbon\Carbon::parse($pengeluaran->tanggal)->format('d M Y') }}</div>
                    </div>
                    <ul class="prev-list">
                        <li class="prev-item">
                            <div class="prev-ico"><i class="bi bi-tag-fill"></i></div>
                            <div><div class="prev-lbl">Jenis</div><div class="prev-val" id="prevJenis">{{ $pengeluaran->jenis_pengeluaran }}</div></div>
                        </li>
                        <li class="prev-item">
                            <div class="prev-ico"><i class="bi bi-calendar3"></i></div>
                            <div><div class="prev-lbl">Tanggal</div><div class="prev-val" id="prevTanggal">{{ \Carbon\Carbon::parse($pengeluaran->tanggal)->format('d M Y') }}</div></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    function formatRupiah(angka) {
        if (!angka || isNaN(angka)) return null;
        return 'Rp ' + parseInt(angka).toLocaleString('id-ID');
    }
    function formatTgl(val) {
        if (!val) return null;
        const d = new Date(val);
        if (isNaN(d)) return null;
        return d.toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' });
    }
    function setVal(el, val, emptyText) {
        if (val) { el.textContent = val; el.classList.remove('empty'); }
        else     { el.textContent = emptyText; el.classList.add('empty'); }
    }

    const jenisSelect     = document.getElementById('jenisSelect');
    const fieldKeterangan = document.getElementById('fieldKeterangan');
    const inputKeterangan = document.getElementById('inputKeterangan');

    jenisSelect.addEventListener('change', function() {
        if (this.value === 'Lainnya') {
            fieldKeterangan.style.display = 'flex';
            inputKeterangan.required = true;
            inputKeterangan.focus();
        } else {
            fieldKeterangan.style.display = 'none';
            inputKeterangan.required = false;
            inputKeterangan.value = '';
        }
        setVal(document.getElementById('prevJenis'),
            this.value === 'Lainnya' ? (inputKeterangan.value.trim() || 'Lainnya') : this.value, '—');
    });
    inputKeterangan.addEventListener('input', function() {
        if (jenisSelect.value === 'Lainnya') {
            setVal(document.getElementById('prevJenis'), this.value.trim() || 'Lainnya', '—');
        }
    });

    const inputJumlah  = document.getElementById('inputJumlah');
    const inputTanggal = document.getElementById('inputTanggal');

    inputJumlah.addEventListener('input', function() {
        let angka = this.value.replace(/\D/g, '');
        this.value = angka ? angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.') : '';
        const el  = document.getElementById('prevNominal');
        const fmt = formatRupiah(angka);
        if (fmt) { el.textContent = fmt; el.classList.remove('empty'); }
        else     { el.textContent = 'Belum diisi'; el.classList.add('empty'); }
    });

    inputTanggal.addEventListener('change', function() {
        const fmt = formatTgl(this.value);
        setVal(document.getElementById('prevTanggal'), fmt, '—');
        document.getElementById('prevTanggalSub').textContent = fmt || '—';
    });

    if (jenisSelect.value) jenisSelect.dispatchEvent(new Event('change'));
    inputTanggal.dispatchEvent(new Event('change'));
</script>

@endsection