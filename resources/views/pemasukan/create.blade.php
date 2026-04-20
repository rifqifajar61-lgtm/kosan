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
    @keyframes calcPop {
        from { opacity: 0; transform: scale(0.97) translateY(4px); }
        to   { opacity: 1; transform: scale(1) translateY(0); }
    }

    .page-header { display: flex; align-items: flex-end; justify-content: space-between; gap: 16px; margin-bottom: 20px; animation: fadeUp .35s ease both; }
    .ph-left { display: flex; flex-direction: column; gap: 4px; }
    .ph-kicker { font-size: 10px; font-weight: 700; letter-spacing: 3px; text-transform: uppercase; color: var(--faint); font-family: 'JetBrains Mono', monospace; }
    .ph-title  { font-size: 26px; font-weight: 800; color: var(--blue-dark); letter-spacing: -0.6px; line-height: 1; display: flex; align-items: center; gap: 8px; }
    .ph-badge  { font-size: 10px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; background: var(--blue-dim); color: var(--blue); border: 1px solid var(--blue-border); padding: 2px 10px; border-radius: 6px; font-family: 'JetBrains Mono', monospace; }
    .btn-back  { display: inline-flex; align-items: center; gap: 7px; padding: 9px 18px; border: 1.5px solid var(--blue-border); background: var(--surface); color: var(--blue); font-family: 'Sora', sans-serif; font-size: 13px; font-weight: 600; border-radius: 10px; text-decoration: none; transition: all .18s; }
    .btn-back:hover { background: var(--blue-dim); border-color: var(--blue); color: var(--blue-dark); transform: translateX(-2px); }

    .bc { display: flex; align-items: center; gap: 6px; font-size: 12px; color: var(--muted); margin-bottom: 22px; }
    .bc a { color: var(--muted); text-decoration: none; }
    .bc a:hover { color: var(--blue); }
    .bc .sep { color: var(--blue-border); }
    .bc .cur { color: var(--blue); font-weight: 700; }

    .form-layout { display: grid; grid-template-columns: 1fr 320px; gap: 20px; align-items: start; animation: fadeUp .4s .05s ease both; }
    @media (max-width: 900px) { .form-layout { grid-template-columns: 1fr; } }

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
    .fl { display: block; font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--muted); margin-bottom: 7px; }
    .fl .req { color: #EF4444; margin-left: 2px; }
    .fc { width: 100%; padding: 11px 14px; background: rgba(255,255,255,0.90); border: 1.5px solid var(--blue-border); border-radius: 10px; font-family: 'Sora', sans-serif; font-size: 14px; color: #0f1733; transition: border-color .15s, box-shadow .15s; outline: none; box-sizing: border-box; appearance: none; -webkit-appearance: none; }
    select.fc { background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%232563EB' stroke-width='2.5'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 14px center; padding-right: 38px; background-color: rgba(255,255,255,0.90); }
    .fc::placeholder { color: var(--faint); }
    .fc:focus { border-color: var(--blue); box-shadow: 0 0 0 3px rgba(37,99,235,0.12); background: #fff; }
    select.fc option { background: #fff; color: #0f1733; }
    .fc.is-invalid { border-color: rgba(239,68,68,0.50) !important; }

    .rp-wrap { display: flex; border: 1.5px solid var(--blue-border); border-radius: 10px; overflow: hidden; background: rgba(255,255,255,0.90); transition: border-color .15s, box-shadow .15s; }
    .rp-wrap:focus-within { border-color: var(--blue); box-shadow: 0 0 0 3px rgba(37,99,235,0.12); background: #fff; }
    .rp-prefix { padding: 11px 14px; background: var(--blue-dim); color: var(--blue); font-weight: 800; font-size: 13px; font-family: 'JetBrains Mono', monospace; border-right: 1.5px solid var(--blue-border); flex-shrink: 0; }
    .rp-wrap input { flex: 1; border: none; outline: none; padding: 11px 14px; background: transparent; font-family: 'JetBrains Mono', monospace; font-size: 15px; color: #0f1733; min-width: 0; font-weight: 700; }
    .rp-wrap input::placeholder { color: var(--faint); font-weight: 400; }
    .rp-wrap input:disabled { opacity: 0.45; cursor: not-allowed; }

    .fh { display: flex; gap: 5px; align-items: flex-start; font-size: 11.5px; color: #b0bac9; margin-top: 6px; }
    .fh i { color: var(--faint); font-size: 11px; margin-top: 1px; flex-shrink: 0; }
    .field-error { font-size: 11.5px; color: #dc2626; margin-top: 6px; display: flex; align-items: center; gap: 5px; }

    /* Kuota */
    .kuota-box { background: rgba(255,255,255,0.65); border: 1.5px solid var(--blue-border); border-radius: 12px; padding: 14px 16px; margin-bottom: 14px; }
    .kuota-row { display: flex; align-items: center; justify-content: space-between; margin-bottom: 9px; }
    .kuota-label { font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--muted); }
    .kuota-nums { font-family: 'JetBrains Mono', monospace; font-size: 12px; font-weight: 700; color: #0f1733; }
    .kuota-nums span { color: var(--blue); }
    .kuota-bar-track { height: 7px; border-radius: 99px; background: var(--blue-dim); overflow: hidden; }
    .kuota-bar-fill  { height: 100%; border-radius: 99px; background: var(--blue); transition: width 0.4s ease; }
    .kuota-bar-fill.done { background: #10b981; }
    .kuota-bar-fill.warn { background: #f59e0b; }

    .next-info { display: flex; align-items: flex-start; gap: 9px; background: var(--blue-dim); border: 1.5px solid var(--blue-border); border-radius: 10px; padding: 10px 14px; font-size: 13px; margin-top: 10px; }
    .next-info i { color: var(--blue); flex-shrink: 0; margin-top: 1px; }
    .next-info strong { color: var(--blue-dark); }

    .lunas-badge { display: inline-flex; align-items: center; gap: 6px; background: rgba(16,185,129,0.10); border: 1.5px solid rgba(16,185,129,0.25); border-radius: 9px; padding: 8px 14px; font-size: 12px; font-weight: 700; color: #059669; margin-top: 10px; }

    /* Calc */
    .calc-result { background: var(--blue-dim); border: 1.5px solid var(--blue-border); border-radius: 12px; padding: 18px 20px; margin-top: 8px; text-align: center; animation: calcPop .22s ease both; }
    .calc-formula { font-size: 12px; color: var(--muted); margin-bottom: 6px; font-family: 'JetBrains Mono', monospace; font-weight: 600; }
    .calc-total   { font-size: 26px; font-weight: 800; color: var(--blue-dark); font-family: 'JetBrains Mono', monospace; letter-spacing: -0.5px; line-height: 1; }
    .calc-label   { font-size: 10px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: var(--muted); margin-top: 6px; }

    .bulan-preview-list { display: flex; flex-wrap: wrap; gap: 5px; margin-top: 8px; }
    .bulan-tag { display: inline-flex; align-items: center; gap: 4px; background: var(--blue-dim); border: 1px solid var(--blue-border); border-radius: 7px; padding: 3px 9px; font-size: 11.5px; font-weight: 700; color: var(--blue-dark); font-family: 'JetBrains Mono', monospace; }

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
    .btn-save:disabled { opacity: 0.45; cursor: not-allowed; transform: none; box-shadow: none; }

    /* Sidebar */
    .sb { background: var(--surface); border: 1.5px solid rgba(37,99,235,0.13); border-radius: var(--radius); overflow: hidden; box-shadow: 0 2px 16px rgba(37,99,235,0.07); position: sticky; top: 24px; }
    .sb::before { content: ''; display: block; height: 2px; background: var(--blue); }
    .sb-head { padding: 14px 20px; border-bottom: 1.5px solid var(--blue-dim); background: rgba(219,234,254,0.28); }
    .sb-kicker { font-size: 10px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: var(--faint); font-family: 'JetBrains Mono', monospace; }
    .sb-title  { font-size: 13px; font-weight: 800; color: var(--blue-dark); margin-top: 2px; }
    .sb-body   { padding: 18px; }

    .prev-nominal-box { background: rgba(255,255,255,0.65); border: 1.5px solid var(--blue-border); border-radius: 12px; padding: 18px; margin-bottom: 14px; text-align: center; border-top: 2px solid var(--blue); }
    .prev-nominal-label { font-size: 10px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: var(--faint); margin-bottom: 8px; }
    .prev-nominal-value { font-size: 24px; font-weight: 800; font-family: 'JetBrains Mono', monospace; color: var(--blue-dark); letter-spacing: -0.5px; line-height: 1; }
    .prev-nominal-value.empty { font-size: 14px; font-weight: 400; font-style: italic; color: var(--faint); }
    .prev-nominal-sub { font-size: 11px; color: var(--muted); margin-top: 6px; font-weight: 500; }

    .prev-list { list-style: none; padding: 0; margin: 0 0 14px; }
    .prev-item { display: flex; align-items: flex-start; gap: 9px; padding: 8px 0; border-bottom: 1px solid var(--blue-dim); }
    .prev-item:last-child { border-bottom: none; }
    .prev-ico { width: 26px; height: 26px; border-radius: 7px; background: var(--blue-dim); border: 1px solid var(--blue-border); display: flex; align-items: center; justify-content: center; font-size: 11px; color: var(--blue); flex-shrink: 0; margin-top: 1px; }
    .prev-lbl { font-size: 10px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--faint); margin-bottom: 2px; }
    .prev-val { font-size: 12px; font-weight: 600; color: var(--blue-dark); }
    .prev-val.empty { color: var(--faint); font-style: italic; font-weight: 400; }

    .prev-bulan-box { background: var(--blue-dim); border: 1.5px solid var(--blue-border); border-radius: 11px; padding: 12px 14px; }
    .prev-bulan-title { font-size: 10px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--blue); margin-bottom: 8px; }
    .prev-bulan-tags  { display: flex; flex-wrap: wrap; gap: 5px; min-height: 24px; }
    .prev-bulan-empty { font-size: 12px; color: var(--faint); font-style: italic; }

    .sc::before,
.sb::before {
    display: none !important;
}

.fl .req {
    display: none !important;
}
</style>

{{-- HEADER --}}
<div class="page-header">
    <div class="ph-left">
        <div class="ph-kicker">Manajemen Keuangan</div>
        <div class="ph-title">Tambah Pemasukan </div>
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

@php
$sewaJson = $sewa->mapWithKeys(function ($s) {
    return [
        $s->id_sewa => [
            'nama'          => $s->nama_penghuni,
            'kamar'         => $s->nomor_kamar,
            'harga'         => $s->harga_sewa,
            'durasi_total'  => $s->durasi_total,
            'sudah_dibayar' => $s->sudah_dibayar,
            'sisa_kuota'    => $s->sisa_kuota,
            'tanggal_mulai' => $s->tanggal_mulai,
        ]
    ];
});
@endphp
<script>const SEWA_DATA = @json($sewaJson);</script>

<form action="{{ route('pemasukan.simpan') }}" method="POST" id="formTambahPemasukan">
    @csrf
    <div class="form-layout">
        <div>
            <div class="sc">
                <div class="sc-head">
                    <div><div class="sc-title">Data Sewa</div><div class="sc-desc">Pilih kontrak sewa yang melakukan pembayaran</div></div>
                </div>
                <div class="sc-body">
                    <div class="fg">
                        <label class="fl">Kontrak Sewa <span class="req">*</span></label>
                        <select name="id_sewa" id="selectSewa" class="fc @error('id_sewa') is-invalid @enderror" required>
                            <option value="" disabled selected>— Pilih sewa —</option>
                            @foreach ($sewa as $s)
                                <option value="{{ $s->id_sewa }}" {{ old('id_sewa') == $s->id_sewa ? 'selected' : '' }}>
                                    {{ $s->nama_penghuni }} — Kamar {{ $s->nomor_kamar }}
                                    @if($s->sisa_kuota !== null && $s->sisa_kuota <= 0) (LUNAS)
                                    @elseif($s->sisa_kuota !== null) (sisa {{ $s->sisa_kuota }} bln)
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('id_sewa')<div class="field-error"><i class="bi bi-exclamation-circle-fill"></i> {{ $message }}</div>@enderror
                        <div class="fh"></div>
                    </div>
                    <div id="kuotaSection" style="display:none">
                        <div id="bulanLunasBadge" class="lunas-badge" style="display:none">
                            <i class="bi bi-check-circle-fill"></i> Semua bulan sudah lunas
                        </div>
                        <div id="bulanNextInfo" class="next-info" style="display:none">
                            <i class="bi bi-calendar-arrow-up"></i>
                            <span>Pembayaran berikutnya mulai dari bulan <strong id="bulanNextLabel">—</strong></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sc">
                <div class="sc-head">
                    <div><div class="sc-title">Detail Pembayaran</div><div class="sc-desc">Tanggal dan jumlah bulan yang dibayar</div></div>
                </div>
                <div class="sc-body">
                    <div class="fg">
                        <label class="fl">Tanggal Pemasukan <span class="req">*</span></label>
                        <input type="date" name="tanggal_pemasukan" id="inputTanggal"
                               class="fc @error('tanggal_pemasukan') is-invalid @enderror"
                               value="{{ old('tanggal_pemasukan', date('Y-m-d')) }}" required>
                        @error('tanggal_pemasukan')<div class="field-error"><i class="bi bi-exclamation-circle-fill"></i> {{ $message }}</div>@enderror
                    </div>
                    <div class="fg">
                        <label class="fl">Jumlah Bulan Dibayar <span class="req">*</span></label>
                        <div class="rp-wrap">
                            <span class="rp-prefix">Bulan</span>
                            <input type="number" name="jumlah_bulan" id="inputJumlah"
                                   placeholder="1" value="{{ old('jumlah_bulan', 1) }}" min="1" max="999" required>
                        </div>
                        @error('jumlah_bulan')<div class="field-error"><i class="bi bi-exclamation-circle-fill"></i> {{ $message }}</div>@enderror
                        <div class="fh" id="sisaHelper"></div>
                    </div>
                    <div id="bulanPreviewWrap" style="display:none">
                        <div style="font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:var(--muted);margin-bottom:7px">Bulan yang akan dicatat:</div>
                        <div class="bulan-preview-list" id="bulanPreviewList"></div>
                    </div>
                    <div class="calc-result" id="calcResult" style="display:none;margin-top:14px">
                        <div class="calc-formula" id="calcFormula">— × — = —</div>
                        <div class="calc-total" id="calcTotal">Rp 0</div>
                        <div class="calc-label">Total nominal yang akan dicatat</div>
                    </div>
                </div>
                <div class="actions">
                    <a href="{{ route('pemasukan') }}" class="btn-cancel"> Batal</a>
                    <button type="submit" class="btn-save" id="btnSimpan"> Simpan Pemasukan</button>
                </div>
            </div>
        </div>

        <div>
            <div class="sb">
                <div class="sb-head">
                   
                    <div class="sb-title">Tampilan Transaksi Pemasukan</div>
                </div>
                <div class="sb-body">
                    <div class="prev-nominal-box">
                        <div class="prev-nominal-label">Jumlah Pembayaran</div>
                        <div class="prev-nominal-value empty" id="prevNominal">Belum diisi</div>
                        <div class="prev-nominal-sub" id="prevNominalSub">—</div>
                    </div>
                    <ul class="prev-list">
                        <li class="prev-item">
                            
                            <div><div class="prev-lbl">Penghuni</div><div class="prev-val empty" id="prevNama">—</div></div>
                        </li>
                        <li class="prev-item">
                           
                            <div><div class="prev-lbl">Kamar</div><div class="prev-val empty" id="prevKamar">—</div></div>
                        </li>
                        <li class="prev-item">
                
                            <div><div class="prev-lbl">Tanggal Catat</div><div class="prev-val empty" id="prevTanggal">—</div></div>
                        </li>
                    </ul>
                    <div class="prev-bulan-box">
                        <div class="prev-bulan-title">Bulan Dibayar</div>
                        <div class="prev-bulan-tags" id="prevBulanTags"><span class="prev-bulan-empty">Belum ada</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
const BULAN_ID = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
function formatRp(n) { return 'Rp ' + parseInt(n).toLocaleString('id-ID'); }
function formatTgl(val) {
    if (!val) return null;
    const d = new Date(val + 'T00:00:00');
    if (isNaN(d)) return null;
    return d.toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' });
}
function setVal(el, val, emptyText) {
    if (val) { el.textContent = val; el.classList.remove('empty'); }
    else     { el.textContent = emptyText; el.classList.add('empty'); }
}
function labelBulan(ym) {
    const [y, m] = ym.split('-');
    return BULAN_ID[parseInt(m) - 1] + ' ' + y;
}
function hitungBulanList(startYM, n) {
    const [sy, sm] = startYM.split('-').map(Number);
    const list = [];
    for (let i = 0; i < n; i++) {
        let m = sm + i;
        let y = sy + Math.floor((m - 1) / 12);
        m = ((m - 1) % 12) + 1;
        list.push(y + '-' + String(m).padStart(2, '0'));
    }
    return list;
}
function getBulanBerikutnya(sewaId) {
    const d = SEWA_DATA[sewaId];
    if (!d) return null;
    const [y, m] = d.tanggal_mulai.split('-').map(Number);
    let totalBulan = m + d.sudah_dibayar;
    let nextY = y + Math.floor((totalBulan - 1) / 12);
    let nextM = ((totalBulan - 1) % 12) + 1;
    return nextY + '-' + String(nextM).padStart(2, '0');
}
function updateAll() {
    const sewaId  = document.getElementById('selectSewa').value;
    const jumlah  = parseInt(document.getElementById('inputJumlah').value) || 0;
    const tanggal = document.getElementById('inputTanggal').value;
    setVal(document.getElementById('prevTanggal'), formatTgl(tanggal), '—');
    if (!sewaId || !SEWA_DATA[sewaId]) {
        document.getElementById('kuotaSection').style.display = 'none';
        document.getElementById('calcResult').style.display = 'none';
        document.getElementById('bulanPreviewWrap').style.display = 'none';
        setVal(document.getElementById('prevNominal'), null, 'Belum diisi');
        document.getElementById('prevNominalSub').textContent = '—';
        setVal(document.getElementById('prevNama'), null, '—');
        setVal(document.getElementById('prevKamar'), null, '—');
        document.getElementById('prevBulanTags').innerHTML = '<span class="prev-bulan-empty">Belum ada</span>';
        document.getElementById('btnSimpan').disabled = false;
        return;
    }
    const d = SEWA_DATA[sewaId];
    setVal(document.getElementById('prevNama'), d.nama, '—');
    setVal(document.getElementById('prevKamar'), 'Kamar ' + d.kamar, '—');
    document.getElementById('kuotaSection').style.display = 'block';
    document.getElementById('kuotaSudah').textContent = d.sudah_dibayar;
    document.getElementById('kuotaTotal').textContent = d.durasi_total !== null ? d.durasi_total : '∞';
    const pct = d.durasi_total ? Math.min(100, Math.round((d.sudah_dibayar / d.durasi_total) * 100)) : 0;
    const bar = document.getElementById('kuotaBarFill');
    bar.style.width = pct + '%';
    bar.className = 'kuota-bar-fill' + (pct >= 100 ? ' done' : (pct >= 75 ? ' warn' : ''));
    if (d.sisa_kuota !== null && d.sisa_kuota <= 0) {
        document.getElementById('bulanLunasBadge').style.display = 'flex';
        document.getElementById('bulanNextInfo').style.display = 'none';
        document.getElementById('inputJumlah').disabled = true;
        document.getElementById('btnSimpan').disabled = true;
        document.getElementById('sisaHelperText').textContent = 'Semua bulan sudah terbayar.';
    } else {
        document.getElementById('bulanLunasBadge').style.display = 'none';
        document.getElementById('bulanNextInfo').style.display = 'flex';
        document.getElementById('inputJumlah').disabled = false;
        document.getElementById('btnSimpan').disabled = false;
        const nextYM = getBulanBerikutnya(sewaId);
        document.getElementById('bulanNextLabel').textContent = nextYM ? labelBulan(nextYM) : '—';
        if (d.sisa_kuota !== null) {
            document.getElementById('inputJumlah').max = d.sisa_kuota;
            document.getElementById('sisaHelper').textContent = 'Sisa ' + d.sisa_kuota + ' bulan. Maks: ' + d.sisa_kuota + ' bulan.';
        } else {
            document.getElementById('inputJumlah').removeAttribute('max');
            document.getElementById('sisaHelper').textContent = 'Sewa tanpa batas waktu.';
        }
        if (nextYM && jumlah > 0) {
            const bulanList = hitungBulanList(nextYM, jumlah);
            const html = bulanList.map(ym => `<span class="bulan-tag"><i class="bi bi-calendar-check"></i> ${labelBulan(ym)}</span>`).join('');
            document.getElementById('bulanPreviewList').innerHTML = html;
            document.getElementById('bulanPreviewWrap').style.display = 'block';
            document.getElementById('prevBulanTags').innerHTML = html;
            const total = jumlah * d.harga;
            if (total > 0) {
                document.getElementById('calcResult').style.display = 'block';
                document.getElementById('calcFormula').textContent = jumlah + ' bulan × ' + formatRp(d.harga) + ' =';
                document.getElementById('calcTotal').textContent = formatRp(total);
                setVal(document.getElementById('prevNominal'), formatRp(total), 'Belum diisi');
                document.getElementById('prevNominalSub').textContent = jumlah + ' bulan × ' + formatRp(d.harga);
            } else {
                document.getElementById('calcResult').style.display = 'none';
                setVal(document.getElementById('prevNominal'), null, 'Belum diisi');
            }
        } else {
            document.getElementById('bulanPreviewWrap').style.display = 'none';
            document.getElementById('calcResult').style.display = 'none';
            document.getElementById('prevBulanTags').innerHTML = '<span class="prev-bulan-empty">Belum ada</span>';
            setVal(document.getElementById('prevNominal'), null, 'Belum diisi');
            document.getElementById('prevNominalSub').textContent = '—';
        }
    }
}
document.getElementById('selectSewa').addEventListener('change', updateAll);
document.getElementById('inputJumlah').addEventListener('input', updateAll);
document.getElementById('inputTanggal').addEventListener('change', updateAll);
updateAll();
</script>

@endsection