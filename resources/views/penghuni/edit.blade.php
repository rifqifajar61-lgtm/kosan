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
    .ph-title  { font-size: 26px; font-weight: 800; color: var(--blue-dark); letter-spacing: -0.6px; line-height: 1; display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
    .ph-badge  { font-size: 10px; font-weight: 700; letter-spacing: 1px; background: var(--blue-dim); color: var(--blue); border: 1px solid var(--blue-border); padding: 2px 10px; border-radius: 6px; font-family: 'JetBrains Mono', monospace; max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    .btn-back  { display: inline-flex; align-items: center; gap: 7px; padding: 9px 18px; border: 1.5px solid var(--blue-border); background: var(--surface); color: var(--blue); font-family: 'Sora', sans-serif; font-size: 13px; font-weight: 600; border-radius: 10px; text-decoration: none; transition: all .18s; flex-shrink: 0; }
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
    textarea.fc { resize: vertical; min-height: 110px; line-height: 1.65; }
    .fh { display: flex; gap: 5px; align-items: flex-start; font-size: 11.5px; color: #b0bac9; margin-top: 6px; }
    .fh i { color: var(--faint); font-size: 11px; margin-top: 1px; flex-shrink: 0; }

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

    .prev-avatar { width: 54px; height: 54px; border-radius: 14px; background: var(--blue-dim); border: 1.5px solid var(--blue-border); display: flex; align-items: center; justify-content: center; font-size: 22px; font-weight: 800; color: var(--blue); font-family: 'JetBrains Mono', monospace; margin: 0 auto 12px; }
    .prev-name { font-size: 16px; font-weight: 800; color: var(--blue-dark); text-align: center; }
    .prev-hp   { font-size: 12px; color: var(--muted); text-align: center; margin-top: 3px; }
    .prev-divider { height: 1px; background: var(--blue-dim); margin: 14px 0; }
    .prev-field { margin-bottom: 12px; }
    .prev-field-label { font-size: 10px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: var(--faint); font-family: 'JetBrains Mono', monospace; margin-bottom: 3px; }
    .prev-field-value { font-size: 13px; font-weight: 600; color: var(--blue-dark); }
    .prev-field-value.laki { color: #1D4ED8; }
    .prev-field-value.perempuan { color: #BE185D; }

    .edit-info { background: rgba(219,234,254,0.35); border: 1px solid var(--blue-border); border-radius: 10px; padding: 12px 14px; margin-top: 14px; font-size: 12px; color: var(--muted); line-height: 1.6; font-weight: 500; }
    .edit-info strong { color: var(--blue); }

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
        <div class="ph-kicker">Manajemen Penghuni</div>
        <div class="ph-title">Edit Penghuni </div>
    </div>
    <a href="{{ route('penghuni') }}" class="btn-back">Kembali</a>
</div>

<form method="POST" action="{{ route('penghuni.update', $penghuni->id_penghuni) }}" id="formEdit">
    @csrf
    @method('PUT')
    <div class="form-layout">
        <div>
            <div class="sc">
                <div class="sc-head">
                    <div><div class="sc-title">Identitas Penghuni</div><div class="sc-desc">Perbarui nama dan nomor KTP</div></div>
                </div>
                <div class="sc-body">
                    <div class="fg">
                        <label class="fl">Nama Penghuni <span class="req">*</span></label>
                        <input type="text" name="nama_penghuni" id="inputNama" class="fc"
                               value="{{ $penghuni->nama_penghuni }}" required>
                    </div>
                    <div class="fg">
                        <label class="fl">No KTP <span class="req">*</span></label>
                        <input type="text" name="no_ktp" id="inputKtp" class="fc"
                               value="{{ $penghuni->no_ktp }}" maxlength="16" inputmode="numeric" required>
                       
                    </div>
                </div>
            </div>

            <div class="sc">
                <div class="sc-head">
                   
                    <div><div class="sc-title">Kontak & Jenis Kelamin</div><div class="sc-desc">Nomor HP dan jenis kelamin</div></div>
                </div>
                <div class="sc-body">
                    <div class="fg fg-grid2">
                        <div>
                            <label class="fl">No HP <span class="req">*</span></label>
                            <input type="text" name="no_hp" id="inputHp" class="fc"
                                   value="{{ $penghuni->no_hp }}" required>
                        </div>
                        <div>
                            <label class="fl">Jenis Kelamin <span class="req">*</span></label>
                            <select name="jenis_kelamin" id="inputJK" class="fc" required>
                                <option value="Laki-laki"  {{ $penghuni->jenis_kelamin=='Laki-laki'  ? 'selected':'' }}>&#9794; Laki-laki</option>
                                <option value="Perempuan"  {{ $penghuni->jenis_kelamin=='Perempuan'  ? 'selected':'' }}>&#9792; Perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sc">
                <div class="sc-head">
                    <div><div class="sc-title">Alamat Asal</div><div class="sc-desc">Alamat domisili penghuni</div></div>
                </div>
                <div class="sc-body">
                    <div class="fg">
                        <label class="fl">Alamat</label>
                        <textarea name="alamat_penghuni" id="inputAlamat" class="fc">{{ $penghuni->alamat_penghuni }}</textarea>
                    </div>
                </div>
                <div class="actions">
                    <a href="{{ route('penghuni') }}" class="btn-cancel">Batal</a>
<button type="submit" class="btn-save">Update Penghuni</button>
                </div>
            </div>
        </div>

        <div>
            <div class="sb">
                <div class="sb-head">
                    
                    <div class="sb-title">Tampilan Perubahan Data Penghuni </div>
                </div>
                <div class="sb-body">
                    <div class="prev-avatar" id="prevAvatar">{{ strtoupper(substr($penghuni->nama_penghuni,0,1)) }}</div>
                    <div class="prev-name" id="prevNama">{{ $penghuni->nama_penghuni }}</div>
                    <div class="prev-hp" id="prevHp">{{ $penghuni->no_hp }}</div>
                    <div class="prev-divider"></div>
                    <div class="prev-field">
                        <div class="prev-field-label">No KTP</div>
                        <div class="prev-field-value" id="prevKtp">{{ $penghuni->no_ktp }}</div>
                    </div>
                    <div class="prev-field">
                        <div class="prev-field-label">Jenis Kelamin</div>
                        <div class="prev-field-value {{ $penghuni->jenis_kelamin=='Laki-laki' ? 'laki' : 'perempuan' }}" id="prevJK">
                            {{ $penghuni->jenis_kelamin=='Laki-laki' ? '♂ Laki-laki' : '♀ Perempuan' }}
                        </div>
                    </div>
                    <div class="prev-field">
                        <div class="prev-field-label">Alamat</div>
                        <div class="prev-field-value" id="prevAlamat" style="font-size:12px;font-weight:400;color:var(--muted)">
                            {{ Str::limit($penghuni->alamat_penghuni, 65) ?: '—' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    document.getElementById('inputNama').addEventListener('input', function() {
        const v = this.value.trim();
        document.getElementById('prevAvatar').textContent = v ? v[0].toUpperCase() : '?';
        document.getElementById('prevNama').textContent   = v || 'Nama Penghuni';
    });
    document.getElementById('inputKtp').addEventListener('input', function() {
        this.value = this.value.replace(/\D/g,'').slice(0,16);
        document.getElementById('prevKtp').textContent = this.value.trim() || '—';
    });
    document.getElementById('inputHp').addEventListener('input', function() {
        document.getElementById('prevHp').textContent = this.value.trim() || '—';
    });
    document.getElementById('inputJK').addEventListener('change', function() {
        const el = document.getElementById('prevJK');
        if (this.value === 'Laki-laki') { el.textContent = '\u2642 Laki-laki'; el.className = 'prev-field-value laki'; }
        else { el.textContent = '\u2640 Perempuan'; el.className = 'prev-field-value perempuan'; }
    });
    document.getElementById('inputAlamat').addEventListener('input', function() {
        const v = this.value.trim();
        document.getElementById('prevAlamat').textContent = v ? (v.length > 65 ? v.substring(0,65)+'\u2026' : v) : '—';
    });
</script>

@endsection