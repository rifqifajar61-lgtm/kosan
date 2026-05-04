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

    @keyframes fadeUp { from{opacity:0;transform:translateY(14px)}to{opacity:1;transform:translateY(0)} }
    @keyframes pulse  { 0%,100%{opacity:1}50%{opacity:0.4} }

    .page-header { display:flex; align-items:flex-end; justify-content:space-between; gap:16px; margin-bottom:20px; animation:fadeUp .35s ease both; }
    .ph-left { display:flex; flex-direction:column; gap:4px; }
    .ph-kicker { font-size:10px; font-weight:700; letter-spacing:3px; text-transform:uppercase; color:var(--faint); font-family:'JetBrains Mono',monospace; }
    .ph-title  { font-size:26px; font-weight:800; color:var(--blue-dark); letter-spacing:-0.6px; line-height:1; display:flex; align-items:center; gap:8px; }
    .ph-badge  { font-size:10px; font-weight:700; background:var(--blue-dim); color:var(--blue); border:1px solid var(--blue-border); padding:2px 10px; border-radius:6px; font-family:'JetBrains Mono',monospace; }
    .btn-back  { display:inline-flex; align-items:center; gap:7px; padding:9px 18px; border:1.5px solid var(--blue-border); background:var(--surface); color:var(--blue); font-family:'Sora',sans-serif; font-size:13px; font-weight:600; border-radius:10px; text-decoration:none; transition:all .18s; flex-shrink:0; }
    .btn-back:hover { background:var(--blue-dim); border-color:var(--blue); color:var(--blue-dark); transform:translateX(-2px); }

    .bc { display:flex; align-items:center; gap:6px; font-size:12px; color:var(--muted); margin-bottom:22px; }
    .bc a { color:var(--muted); text-decoration:none; }
    .bc a:hover { color:var(--blue); }
    .bc .sep { color:var(--blue-border); }
    .bc .cur { color:var(--blue); font-weight:700; }

    .form-layout { display:grid; grid-template-columns:1fr 300px; gap:20px; align-items:start; animation:fadeUp .4s .05s ease both; }
    @media(max-width:860px){ .form-layout{ grid-template-columns:1fr; } }

    .sc { background:var(--surface); border:1.5px solid rgba(37,99,235,0.13); border-radius:var(--radius); overflow:hidden; margin-bottom:16px; box-shadow:0 2px 16px rgba(37,99,235,0.07); }
    .sc:last-child { margin-bottom:0; }
    .sc::before { content:''; display:block; height:2px; background:var(--blue); }
    .sc-head { padding:15px 22px; border-bottom:1.5px solid var(--blue-dim); background:rgba(219,234,254,0.28); display:flex; align-items:center; gap:10px; }
    .sc-icon { width:34px; height:34px; border-radius:9px; background:var(--blue-dim); border:1.5px solid var(--blue-border); display:flex; align-items:center; justify-content:center; font-size:15px; color:var(--blue); flex-shrink:0; }
    .sc-title { font-size:13px; font-weight:700; color:var(--blue-dark); }
    .sc-desc  { font-size:11px; color:var(--muted); margin-top:1px; }
    .sc-body  { padding:22px; }

    .fg { margin-bottom:18px; }
    .fg:last-child { margin-bottom:0; }
    .fg-grid2 { display:grid; grid-template-columns:1fr 1fr; gap:14px; }
    @media(max-width:560px){ .fg-grid2{ grid-template-columns:1fr; } }
    .fl { display:block; font-size:11px; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; color:var(--muted); margin-bottom:7px; }
    .fl .req { color:#EF4444; margin-left:2px; }
    .fc { width:100%; padding:11px 14px; background:rgba(255,255,255,0.90); border:1.5px solid var(--blue-border); border-radius:10px; font-family:'Sora',sans-serif; font-size:14px; color:#0f1733; transition:border-color .15s,box-shadow .15s; outline:none; box-sizing:border-box; }
    .fc:focus { border-color:var(--blue); box-shadow:0 0 0 3px rgba(37,99,235,0.12); background:#fff; }
    .fc.is-invalid { border-color:rgba(239,68,68,0.50) !important; }
    .fh { display:flex; gap:5px; align-items:flex-start; font-size:11.5px; color:#b0bac9; margin-top:6px; }
    .fh i { color:var(--faint); font-size:11px; margin-top:1px; flex-shrink:0; }
    .fh strong { color:var(--blue); }
    .field-error { font-size:11.5px; color:#dc2626; margin-top:6px; display:flex; align-items:center; gap:5px; }

    .info-box { display:flex; align-items:center; gap:10px; padding:11px 14px; background:rgba(219,234,254,0.40); border:1.5px solid var(--blue-border); border-radius:10px; font-size:14px; font-weight:600; color:var(--blue-dark); }
    .info-avatar { width:28px; height:28px; border-radius:7px; background:var(--blue-dim); border:1px solid var(--blue-border); color:var(--blue); display:flex; align-items:center; justify-content:center; font-size:11px; font-weight:800; flex-shrink:0; font-family:'JetBrains Mono',monospace; }
    .info-dot { width:8px; height:8px; border-radius:50%; background:var(--blue); flex-shrink:0; }

    .lock-note { display:flex; align-items:center; gap:7px; font-size:11.5px; color:var(--muted); background:rgba(219,234,254,0.35); border:1px solid var(--blue-border); border-radius:8px; padding:8px 12px; margin-bottom:16px; font-weight:500; }
    .lock-note i { color:var(--faint); font-size:11px; }

    /* Radio card */
    .radio-card { display:flex; align-items:center; justify-content:center; padding:14px; border:1.5px solid #e5e7eb; border-radius:10px; cursor:pointer; transition:all .15s; background:#fff; user-select:none; }
    .radio-card input[type=radio] { display:none; }
    .rc-label { font-size:14px; font-weight:600; color:#374151; transition:color .15s; }
    .radio-card:hover { border-color:var(--blue-border); background:var(--blue-dim); }
    .radio-card:hover .rc-label { color:var(--blue-dark); }
    .radio-card.checked-aktif { background:#f0fdf4; border-color:#86efac; }
    .radio-card.checked-aktif .rc-label { color:#16a34a; }
    .radio-card.checked-selesai { background:#eff6ff; border-color:var(--blue-border); }
    .radio-card.checked-selesai .rc-label { color:var(--blue); }

    .alert-error { display:flex; align-items:flex-start; gap:12px; background:rgba(239,68,68,0.06); border:1.5px solid rgba(239,68,68,0.20); border-radius:12px; padding:14px 18px; margin-bottom:20px; }
    .alert-error-title { font-size:13px; font-weight:700; color:#dc2626; margin-bottom:4px; }
    .alert-error-list { list-style:none; padding:0; margin:0; }
    .alert-error-list li { font-size:12px; color:#ef4444; padding:2px 0; display:flex; align-items:flex-start; gap:6px; font-weight:500; }
    .alert-error-list li::before { content:'→'; flex-shrink:0; }
    .alert-success { display:flex; align-items:center; gap:10px; background:rgba(16,185,129,0.08); border:1.5px solid rgba(16,185,129,0.22); border-radius:12px; padding:12px 18px; margin-bottom:20px; font-size:13px; color:#059669; font-weight:700; }

    .actions { display:flex; justify-content:flex-end; align-items:center; gap:10px; padding:16px 22px; border-top:1.5px solid var(--blue-dim); background:rgba(219,234,254,0.18); }
    .btn-cancel { display:inline-flex; align-items:center; gap:6px; padding:10px 20px; border:1.5px solid var(--blue-border); background:transparent; color:var(--muted); font-family:'Sora',sans-serif; font-size:13px; font-weight:600; border-radius:10px; text-decoration:none; transition:all .15s; }
    .btn-cancel:hover { background:var(--blue-dim); color:var(--blue-dark); border-color:var(--blue); }
    .btn-save { display:inline-flex; align-items:center; gap:7px; padding:10px 24px; background:var(--blue); color:#fff; font-family:'Sora',sans-serif; font-size:13px; font-weight:700; border:none; border-radius:10px; cursor:pointer; box-shadow:0 3px 14px rgba(37,99,235,0.38); transition:all .18s; }
    .btn-save:hover { background:var(--blue-dark); transform:translateY(-1px); }

    .sb { background:var(--surface); border:1.5px solid rgba(37,99,235,0.13); border-radius:var(--radius); overflow:hidden; box-shadow:0 2px 16px rgba(37,99,235,0.07); position:sticky; top:24px; }
    .sb::before { content:''; display:block; height:2px; background:var(--blue); }
    .sb-head { padding:14px 20px; border-bottom:1.5px solid var(--blue-dim); background:rgba(219,234,254,0.28); }
    .sb-kicker { font-size:10px; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:var(--faint); font-family:'JetBrains Mono',monospace; }
    .sb-title  { font-size:13px; font-weight:800; color:var(--blue-dark); margin-top:2px; }
    .sb-body   { padding:18px; }
    .prev-card { border:1.5px solid var(--blue-dim); border-radius:12px; padding:16px; background:rgba(255,255,255,0.65); }
    .prev-penghuni { display:flex; align-items:center; gap:10px; margin-bottom:14px; padding-bottom:14px; border-bottom:1px solid var(--blue-dim); }
    .prev-av { width:40px; height:40px; border-radius:11px; background:var(--blue-dim); border:1.5px solid var(--blue-border); color:var(--blue); display:flex; align-items:center; justify-content:center; font-size:16px; font-weight:800; font-family:'JetBrains Mono',monospace; flex-shrink:0; }
    .prev-pname { font-size:14px; font-weight:700; color:var(--blue-dark); }
    .prev-list { list-style:none; padding:0; margin:0; }
    .prev-item { display:flex; align-items:flex-start; gap:9px; padding:8px 0; border-bottom:1px solid var(--blue-dim); }
    .prev-item:last-child { border-bottom:none; }
    .prev-ico { width:26px; height:26px; border-radius:7px; background:var(--blue-dim); border:1px solid var(--blue-border); display:flex; align-items:center; justify-content:center; font-size:11px; color:var(--blue); flex-shrink:0; margin-top:1px; }
    .prev-lbl { font-size:10px; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; color:var(--faint); margin-bottom:2px; }
    .prev-val { font-size:12px; font-weight:600; color:var(--blue-dark); }
    .prev-val.empty { color:var(--faint); font-style:italic; font-weight:400; }
    .status-badge { display:inline-flex; align-items:center; gap:5px; padding:3px 10px; border-radius:999px; font-size:11px; font-weight:700; }
    .status-badge.aktif { background:rgba(37,99,235,0.10); border:1px solid var(--blue-border); color:var(--blue); }
    .status-badge.aktif::before { content:''; width:6px; height:6px; border-radius:50%; background:var(--blue); display:inline-block; animation:pulse 2s infinite; }
    .status-badge.selesai { background:rgba(16,185,129,0.10); border:1px solid rgba(16,185,129,0.25); color:#059669; }
    .status-badge.selesai::before { content:''; width:6px; height:6px; border-radius:50%; background:#10b981; display:inline-block; }

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
        <div class="ph-kicker">Manajemen Sewa</div>
        <div class="ph-title">Edit Data Sewa</div>
    </div>
</div>

@if ($errors->any())
<div class="alert-error">
    <div>
        <div class="alert-error-title">Tidak bisa menyimpan perubahan:</div>
        <ul class="alert-error-list">
            @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
</div>
@endif
@if (session('success'))
<div class="alert-success"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
@endif

<form action="{{ route('sewa.update', $sewa->id_sewa) }}" method="POST" id="formEditSewa">
    @csrf
    <div class="form-layout">
        <div>
            {{-- Info readonly --}}
            <div class="sc">
                <div class="sc-head">
                    
                    <div><div class="sc-title">Info Kontrak</div><div class="sc-desc">Penghuni dan kamar tidak dapat diubah</div></div>
                </div>
                <div class="sc-body">
                    <div class="lock-note"> Note: Penghuni dan kamar bersifat tetap. Hapus kontrak ini untuk mengubahnya.</div>
                    <div class="fg">
                        <label class="fl">Penghuni</label>
                        <div class="info-box">
                            <div class="info-avatar">{{ strtoupper(substr($sewa->nama_penghuni,0,1)) }}</div>
                            {{ $sewa->nama_penghuni }}
                        </div>
                    </div>
                    <div class="fg">
                        <label class="fl">Kamar</label>
                        <div class="info-box">
                            <div class="info-dot"></div>
                            Kamar {{ $sewa->nomor_kamar }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Periode --}}
            <div class="sc">
                <div class="sc-head">
                    
                    <div><div class="sc-title">Periode Sewa</div><div class="sc-desc">Ubah tanggal mulai dan selesai kontrak</div></div>
                </div>
                <div class="sc-body">
                    <div class="fg fg-grid2">
                        <div>
                            <label class="fl">Tanggal Mulai <span class="req">*</span></label>
                            <input type="date" name="tanggal_mulai" id="inputMulai"
                                   class="fc @error('tanggal_mulai') is-invalid @enderror"
                                   value="{{ old('tanggal_mulai', \Carbon\Carbon::parse($sewa->tanggal_mulai)->format('Y-m-d')) }}" required>
                            @error('tanggal_mulai')<div class="field-error"><i class="bi bi-exclamation-circle-fill"></i> {{ $message }}</div>@enderror
                        </div>
                        <div>
                            <label class="fl">Tanggal Selesai <span class="req">*</span></label>
                            <input type="date" name="tanggal_selesai" id="inputSelesai"
                                   class="fc @error('tanggal_selesai') is-invalid @enderror"
                                   value="{{ old('tanggal_selesai', $sewa->tanggal_selesai ? \Carbon\Carbon::parse($sewa->tanggal_selesai)->format('Y-m-d') : '') }}" required>
                            @error('tanggal_selesai')<div class="field-error"><i class="bi bi-exclamation-circle-fill"></i> {{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Status --}}
            <div class="sc">
                <div class="sc-head">

                    <div><div class="sc-title">Status Kontrak</div><div class="sc-desc">Ubah status aktif atau selesai</div></div>
                </div>
                <div class="sc-body">
                    <div class="fg">
                        <label class="fl">Status <span class="req">*</span></label>
                        <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px">
                            <label class="radio-card" id="card-aktif">
                                <input type="radio" name="status" value="aktif" id="radioAktif"
                                       {{ old('status', $sewa->status) == 'aktif' ? 'checked' : '' }} required>
                                <span class="rc-label">Aktif</span>
                            </label>
                            <label class="radio-card" id="card-selesai">
                                <input type="radio" name="status" value="selesai" id="radioSelesai"
                                       {{ old('status', $sewa->status) == 'selesai' ? 'checked' : '' }}>
                                <span class="rc-label">Selesai</span>
                            </label>
                        </div>
                        @error('status')<div class="field-error"><i class="bi bi-exclamation-circle-fill"></i> {{ $message }}</div>@enderror
                        <div class="fh"></div>
                    </div>
                </div>
                <div class="actions">
                    <a href="{{ route('sewa') }}" class="btn-cancel"><i class="bi bi-x-lg"></i> Batal</a>
                    <button type="submit" class="btn-save"><i class="bi bi-check-lg"></i> Simpan Perubahan</button>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div>
            <div class="sb">
                <div class="sb-head">
                    <div class="sb-title">Tampilan Perubahan Data Kontrak Sewa</div>
                </div>
                <div class="sb-body">
                    <div class="prev-card">
                        <div class="prev-penghuni">
                            <div class="prev-av">{{ strtoupper(substr($sewa->nama_penghuni,0,1)) }}</div>
                            <div class="prev-pname">{{ $sewa->nama_penghuni }}</div>
                        </div>
                        <ul class="prev-list">
                            <li class="prev-item">
                               
                                <div><div class="prev-lbl">Kamar</div><div class="prev-val">Kamar {{ $sewa->nomor_kamar }}</div></div>
                            </li>
                            <li class="prev-item">
                                
                                <div><div class="prev-lbl">Tanggal Mulai</div><div class="prev-val" id="prevMulai">{{ \Carbon\Carbon::parse($sewa->tanggal_mulai)->format('d M Y') }}</div></div>
                            </li>
                            <li class="prev-item">
                                
                                <div><div class="prev-lbl">Tanggal Selesai</div><div class="prev-val {{ $sewa->tanggal_selesai ? '' : 'empty' }}" id="prevSelesai">{{ $sewa->tanggal_selesai ? \Carbon\Carbon::parse($sewa->tanggal_selesai)->format('d M Y') : '—' }}</div></div>
                            </li>
                            <li class="prev-item">
                                <div><div class="prev-lbl">Status</div><div id="prevStatus"></div></div>
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
        const [y,m,d] = val.split('-');
        const b = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        return d+' '+b[parseInt(m)-1]+' '+y;
    }
    function setVal(el,val,emptyText){
        if(val){el.textContent=val;el.classList.remove('empty');}
        else{el.textContent=emptyText;el.classList.add('empty');}
    }

    // Tanggal
    const inputMulai=document.getElementById('inputMulai');
    const inputSelesai=document.getElementById('inputSelesai');
    function updateTanggal(){
        setVal(document.getElementById('prevMulai'),formatTgl(inputMulai.value),'—');
        setVal(document.getElementById('prevSelesai'),formatTgl(inputSelesai.value),'—');
        if(inputMulai.value&&inputSelesai.value){
            const s=Math.round((new Date(inputSelesai.value)-new Date(inputMulai.value))/86400000);
            if(s>0){const b=Math.floor(s/30),r=s%30;let t='';if(b>0)t+=b+' bulan ';if(r>0)t+=r+' hari';document.getElementById('durasiText').textContent='Durasi: '+t.trim();document.getElementById('durasiHelper').style.display='flex';}
            else{document.getElementById('durasiHelper').style.display='none';}
        }else{document.getElementById('durasiHelper').style.display='none';}
    }
    inputMulai.addEventListener('change',updateTanggal);
    inputSelesai.addEventListener('change',updateTanggal);

    // Radio card status
    function updateRadioCards(){
        const aktif   = document.getElementById('radioAktif').checked;
        const selesai = document.getElementById('radioSelesai').checked;
        const cAktif  = document.getElementById('card-aktif');
        const cSelesai= document.getElementById('card-selesai');
        cAktif.className   = 'radio-card' + (aktif   ? ' checked-aktif'   : '');
        cSelesai.className = 'radio-card' + (selesai ? ' checked-selesai' : '');
        document.getElementById('prevStatus').innerHTML = aktif
            ? '<span class="status-badge aktif">Aktif</span>'
            : '<span class="status-badge selesai">Selesai</span>';
    }
    document.getElementById('radioAktif').addEventListener('change', updateRadioCards);
    document.getElementById('radioSelesai').addEventListener('change', updateRadioCards);

    updateTanggal();
    updateRadioCards();
</script>

@endsection