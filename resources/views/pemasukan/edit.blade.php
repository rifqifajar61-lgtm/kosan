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

    .page-header { display: flex; align-items: flex-end; justify-content: space-between; gap: 16px; margin-bottom: 20px; animation: fadeUp .35s ease both; }
    .ph-left { display: flex; flex-direction: column; gap: 4px; }
    .ph-kicker { font-size: 10px; font-weight: 700; letter-spacing: 3px; text-transform: uppercase; color: var(--faint); font-family: 'JetBrains Mono', monospace; }
    .ph-title  { font-size: 26px; font-weight: 800; color: var(--blue-dark); letter-spacing: -0.6px; line-height: 1; }
    .btn-back  { display: inline-flex; align-items: center; gap: 7px; padding: 9px 18px; border: 1.5px solid var(--blue-border); background: var(--surface); color: var(--blue); font-family: 'Sora', sans-serif; font-size: 13px; font-weight: 600; border-radius: 10px; text-decoration: none; transition: all .18s; flex-shrink: 0; }
    .btn-back:hover { background: var(--blue-dim); border-color: var(--blue); color: var(--blue-dark); transform: translateX(-2px); }

    .form-layout { display: grid; grid-template-columns: 1fr 300px; gap: 20px; align-items: start; animation: fadeUp .4s .05s ease both; }
    @media (max-width: 860px) { .form-layout { grid-template-columns: 1fr; } }

    .sc { background: var(--surface); border: 1.5px solid rgba(37,99,235,0.13); border-radius: var(--radius); overflow: hidden; box-shadow: 0 2px 16px rgba(37,99,235,0.07); }
    .sc-head { padding: 15px 22px; border-bottom: 1.5px solid var(--blue-dim); background: rgba(219,234,254,0.28); display: flex; align-items: center; gap: 10px; }
    .sc-title { font-size: 13px; font-weight: 700; color: var(--blue-dark); }
    .sc-desc  { font-size: 11px; color: var(--muted); margin-top: 1px; }
    .sc-body  { padding: 22px; display: flex; flex-direction: column; gap: 16px; }

    /* Info strip penghuni */
    .info-strip { display: flex; align-items: center; gap: 12px; background: rgba(219,234,254,0.40); border: 1.5px solid var(--blue-border); border-radius: 12px; padding: 14px 18px; }
    .info-av { width: 40px; height: 40px; border-radius: 11px; background: var(--blue-dim); border: 1.5px solid var(--blue-border); color: var(--blue); display: flex; align-items: center; justify-content: center; font-size: 15px; font-weight: 800; font-family: 'JetBrains Mono', monospace; flex-shrink: 0; }
    .info-name { font-size: 14px; font-weight: 700; color: var(--blue-dark); }
    .info-meta { display: flex; align-items: center; gap: 8px; margin-top: 3px; flex-wrap: wrap; }
    .info-pill { display: inline-flex; align-items: center; gap: 5px; font-size: 11px; font-weight: 700; font-family: 'JetBrains Mono', monospace; padding: 2px 9px; border-radius: 5px; border: 1px solid; }
    .info-pill-blue { background: rgba(37,99,235,0.10); border-color: var(--blue-border); color: var(--blue-dark); }
    .info-pill-lock { background: rgba(0,0,0,0.04); border-color: #d1d5db; color: var(--muted); }

    .fg { display: flex; flex-direction: column; gap: 7px; }
    .fl { font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--muted); }
    .fc { width: 100%; padding: 11px 14px; background: rgba(255,255,255,0.90); border: 1.5px solid var(--blue-border); border-radius: 10px; font-family: 'Sora', sans-serif; font-size: 14px; color: #0f1733; transition: border-color .15s, box-shadow .15s; outline: none; box-sizing: border-box; }
    .fc::placeholder { color: var(--faint); }
    .fc:focus { border-color: var(--blue); box-shadow: 0 0 0 3px rgba(37,99,235,0.12); background: #fff; }
    .fh { display: flex; gap: 5px; align-items: flex-start; font-size: 11.5px; color: #b0bac9; }
    .fh i { color: var(--faint); font-size: 11px; margin-top: 1px; flex-shrink: 0; }

    /* Stepper */
    .stepper { display: flex; align-items: center; border: 1.5px solid var(--blue-border); border-radius: 10px; overflow: hidden; background: rgba(255,255,255,0.90); transition: border-color .15s, box-shadow .15s; }
    .stepper:focus-within { border-color: var(--blue); box-shadow: 0 0 0 3px rgba(37,99,235,0.12); }
    .stepper-btn { width: 44px; height: 46px; border: none; background: var(--blue-dim); color: var(--blue); font-size: 20px; font-weight: 700; cursor: pointer; display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: background .14s; user-select: none; }
    .stepper-btn:hover { background: var(--blue-border); }
    .stepper-input { flex: 1; border: none; outline: none; padding: 11px 8px; background: transparent; font-family: 'JetBrains Mono', monospace; font-size: 20px; font-weight: 700; color: #0f1733; text-align: center; }
    .stepper-suffix { padding: 11px 14px; font-size: 12px; font-weight: 600; color: var(--muted); border-left: 1.5px solid var(--blue-border); background: rgba(219,234,254,0.30); white-space: nowrap; }

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
</style>

<div class="page-header">
    <div class="ph-left">
        <div class="ph-kicker">Manajemen Keuangan</div>
        <div class="ph-title">Edit Pemasukan</div>
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

<form action="{{ route('pemasukan.update', $p->id_pemasukan) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-layout">

        {{-- Form utama --}}
        <div class="sc">
            <div class="sc-head">
                <div>
                    <div class="sc-title">Edit Detail Pemasukan</div>
                    <div class="sc-desc">Perbarui data transaksi pembayaran sewa</div>
                </div>
            </div>
            <div class="sc-body">

                {{-- Info penghuni (readonly) --}}
                <div class="info-strip">
                    <div class="info-av">{{ strtoupper(substr($p->nama_penghuni ?? '-', 0, 1)) }}</div>
                    <div>
                        <div class="info-name">{{ $p->nama_penghuni ?? '-' }}</div>
                        <div class="info-meta">
                            <span class="info-pill info-pill-blue">
                                <i class="bi bi-door-closed-fill" style="font-size:9px"></i>
                                Kamar {{ $p->nomor_kamar ?? '-' }}
                            </span>
                            <span class="info-pill info-pill-lock">
                                <i class="bi bi-lock-fill" style="font-size:9px"></i>
                                Tidak dapat diubah
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Tanggal --}}
                <div class="fg">
                    <label class="fl">Tanggal Pemasukan</label>
                    <input type="date" name="tanggal_pemasukan" id="inputTanggal" class="fc"
                           value="{{ old('tanggal_pemasukan', \Carbon\Carbon::parse($p->tanggal_pemasukan)->format('Y-m-d')) }}"
                           required>
                </div>

                {{-- Jumlah bulan --}}
                <div class="fg">
                    <label class="fl">Jumlah Bulan Dibayar</label>
                    <div class="stepper">
                        <button type="button" class="stepper-btn" onclick="step(-1)">−</button>
                        <input type="number" name="jumlah_bulan" id="jumlahBulan"
                               class="stepper-input" value="{{ old('jumlah_bulan', 1) }}" min="1" max="24">
                        <span class="stepper-suffix">bulan</span>
                    </div>
                    <div class="fh"><i class="bi bi-info-circle"></i> Berapa bulan yang dibayar pada transaksi ini</div>
                </div>

            </div>
            <div class="actions">
                <a href="{{ route('pemasukan') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-save"><i class="bi bi-floppy2-fill"></i> Simpan Perubahan</button>
            </div>
        </div>

        {{-- Sidebar preview --}}
        <div>
            <div class="sb">
                <div class="sb-head">
                    <div class="sb-kicker">Preview</div>
                    <div class="sb-title">Tampilan Transaksi</div>
                </div>
                <div class="sb-body">
                    <div class="prev-nominal-box">
                        <div class="prev-nominal-label">Jumlah Pembayaran</div>
                        <div class="prev-nominal-value" id="prevNominal">
                            Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}
                        </div>
                        <div class="prev-nominal-sub" id="prevTanggalSub">
                            {{ \Carbon\Carbon::parse($p->tanggal_pemasukan)->format('d M Y') }}
                        </div>
                    </div>

                    <ul class="prev-list">
                        <li class="prev-item">
                            <div class="prev-ico"><i class="bi bi-person-fill"></i></div>
                            <div>
                                <div class="prev-lbl">Penghuni</div>
                                <div class="prev-val">{{ $p->nama_penghuni ?? '-' }}</div>
                            </div>
                        </li>
                        <li class="prev-item">
                            <div class="prev-ico"><i class="bi bi-door-closed-fill"></i></div>
                            <div>
                                <div class="prev-lbl">Kamar</div>
                                <div class="prev-val">Kamar {{ $p->nomor_kamar ?? '-' }}</div>
                            </div>
                        </li>
                        <li class="prev-item">
                            <div class="prev-ico"><i class="bi bi-calendar3"></i></div>
                            <div>
                                <div class="prev-lbl">Tanggal</div>
                                <div class="prev-val" id="prevTanggal">
                                    {{ \Carbon\Carbon::parse($p->tanggal_pemasukan)->format('d M Y') }}
                                </div>
                            </div>
                        </li>
                        <li class="prev-item">
                            <div class="prev-ico"><i class="bi bi-calendar-range-fill"></i></div>
                            <div>
                                <div class="prev-lbl">Jumlah Bulan</div>
                                <div class="prev-val" id="prevBulan">1 bulan</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

    {{-- Hidden jumlah_bayar dihitung otomatis --}}
    <input type="hidden" name="jumlah_bayar" id="jumlahBayar" value="{{ $p->jumlah_bayar }}">
</form>

<script>
    const hargaPerBulan = {{ (int)(optional(optional($p->sewa)->kamar)->harga_sewa ?? 0) }};

    function step(delta) {
        const inp = document.getElementById('jumlahBulan');
        inp.value = Math.max(1, (parseInt(inp.value) || 1) + delta);
        update();
    }

    function update() {
        const bulan = parseInt(document.getElementById('jumlahBulan').value) || 0;
        const total = bulan * hargaPerBulan;

        // Nominal
        const elNominal = document.getElementById('prevNominal');
        elNominal.textContent = 'Rp ' + total.toLocaleString('id-ID');
        elNominal.classList.remove('empty');

        // Bulan label
        document.getElementById('prevBulan').textContent = bulan + ' bulan';

        // Hidden
        document.getElementById('jumlahBayar').value = total;
    }

    function formatTgl(val) {
        if (!val) return null;
        const d = new Date(val);
        if (isNaN(d)) return null;
        return d.toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' });
    }

    document.getElementById('inputTanggal').addEventListener('change', function () {
        const fmt = formatTgl(this.value);
        const display = fmt || '—';
        document.getElementById('prevTanggal').textContent    = display;
        document.getElementById('prevTanggalSub').textContent = display;
    });

    document.getElementById('jumlahBulan').addEventListener('input', update);

    // Init
    update();
</script>

@endsection