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

    /* HEADER */
    .page-header { display: flex; align-items: flex-end; justify-content: space-between; gap: 16px; margin-bottom: 24px; animation: fadeUp .35s ease both; }
    .ph-left { display: flex; flex-direction: column; gap: 4px; }
    .ph-kicker { font-size: 10px; font-weight: 700; letter-spacing: 3px; text-transform: uppercase; color: var(--faint); font-family: 'JetBrains Mono', monospace; }
    .ph-title  { font-size: 26px; font-weight: 800; color: var(--blue-dark); letter-spacing: -0.6px; line-height: 1; }
    .ph-sub    { font-size: 13px; color: var(--muted); margin-top: 5px; }

    /* FILTER CARD */
    .filter-card { background: var(--surface); border: 1.5px solid rgba(37,99,235,0.13); border-radius: var(--radius); padding: 22px 26px; margin-bottom: 24px; box-shadow: 0 2px 16px rgba(37,99,235,0.07); animation: fadeUp .4s .05s ease both; }
    .filter-card::before { content: ''; display: block; height: 2px; background: var(--blue); border-radius: var(--radius) var(--radius) 0 0; margin: -22px -26px 20px; }
    .filter-grid { display: grid; grid-template-columns: 1fr 1fr auto; gap: 14px; align-items: end; }
    @media (max-width: 640px) { .filter-grid { grid-template-columns: 1fr; } }
    .filter-label { display: block; font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--muted); margin-bottom: 7px; }
    .fc { width: 100%; padding: 11px 14px; background: rgba(255,255,255,0.90); border: 1.5px solid var(--blue-border); border-radius: 10px; font-family: 'Sora', sans-serif; font-size: 14px; color: #0f1733; transition: border-color .15s, box-shadow .15s; outline: none; box-sizing: border-box; }
    .fc:focus { border-color: var(--blue); box-shadow: 0 0 0 3px rgba(37,99,235,0.12); background: #fff; }
    select.fc { appearance: none; -webkit-appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%232563EB' stroke-width='2.5'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 14px center; padding-right: 38px; background-color: rgba(255,255,255,0.90); }
    select.fc option { background: #fff; color: #0f1733; }
    .btn-filter { display: inline-flex; align-items: center; justify-content: center; gap: 7px; padding: 11px 24px; background: var(--blue); color: #fff; font-family: 'Sora', sans-serif; font-size: 13px; font-weight: 700; border: none; border-radius: 10px; cursor: pointer; box-shadow: 0 3px 14px rgba(37,99,235,0.38); transition: all .18s; white-space: nowrap; }
    .btn-filter:hover { background: var(--blue-dark); transform: translateY(-1px); box-shadow: 0 6px 22px rgba(37,99,235,0.48); }

    /* SUMMARY */
    .summary-row { display: grid; grid-template-columns: repeat(3,1fr); gap: 14px; margin-bottom: 24px; }
    @media (max-width: 700px) { .summary-row { grid-template-columns: 1fr; } }
    .sum-pill { background: var(--surface); border: 1.5px solid rgba(37,99,235,0.13); border-radius: var(--radius); padding: 20px 18px; text-align: center; box-shadow: 0 2px 16px rgba(37,99,235,0.07); animation: fadeUp .4s .08s ease both; }
    .sum-pill-label { font-size: 10px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: var(--faint); margin-bottom: 8px; }
    .sum-pill-value { font-size: 18px; font-weight: 800; font-family: 'JetBrains Mono', monospace; letter-spacing: -0.5px; line-height: 1; }
    .sum-pill-sub { font-size: 11px; color: var(--muted); margin-top: 6px; }
    .sum-income  { border-top: 2px solid #10b981; }
    .sum-expense { border-top: 2px solid #ef4444; }
    .sum-net     { border-top: 2px solid var(--blue); }
    .val-income  { color: #059669; }
    .val-expense { color: #dc2626; }
    .val-net-pos { color: var(--blue-dark); }
    .val-net-neg { color: #dc2626; }

    /* SECTION CARD */
    .sc { background: var(--surface); border: 1.5px solid rgba(37,99,235,0.13); border-radius: var(--radius); overflow: hidden; box-shadow: 0 2px 16px rgba(37,99,235,0.07); margin-bottom: 20px; animation: fadeUp .4s .1s ease both; }
    .sc:last-child { margin-bottom: 0; }
    .sc.income  { border-top: 2px solid #10b981; }
    .sc.expense { border-top: 2px solid #ef4444; }
    .sc.net     { border-top: 2px solid var(--blue); }

    .sc-head { padding: 16px 22px; border-bottom: 1.5px solid var(--blue-dim); background: rgba(219,234,254,0.20); display: flex; align-items: center; justify-content: space-between; gap: 12px; }
    .sc-head-left { display: flex; align-items: center; gap: 10px; }
    .sc-icon { width: 36px; height: 36px; border-radius: 9px; border: 1.5px solid; display: flex; align-items: center; justify-content: center; font-size: 15px; flex-shrink: 0; }
    .sc-icon.green  { background: rgba(16,185,129,0.10); border-color: rgba(16,185,129,0.25); color: #059669; }
    .sc-icon.red    { background: rgba(239,68,68,0.10); border-color: rgba(239,68,68,0.22); color: #dc2626; }
    .sc-icon.blue   { background: var(--blue-dim); border-color: var(--blue-border); color: var(--blue); }
    .sc-title { font-size: 13px; font-weight: 700; color: var(--blue-dark); }
    .sc-sub   { font-size: 11px; color: var(--muted); margin-top: 1px; }
    .sc-badge { display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; border-radius: 10px; font-size: 13px; font-weight: 800; font-family: 'JetBrains Mono', monospace; border: 1.5px solid; white-space: nowrap; }
    .badge-green  { background: rgba(16,185,129,0.10); border-color: rgba(16,185,129,0.25); color: #059669; }
    .badge-red    { background: rgba(239,68,68,0.08); border-color: rgba(239,68,68,0.20); color: #dc2626; }

    /* TABLE */
    .tbl { width: 100%; border-collapse: collapse; }
    .tbl thead tr { background: rgba(219,234,254,0.30); }
    .tbl thead th { padding: 11px 20px; font-size: 10.5px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--blue); border-bottom: 1.5px solid var(--blue-dim); white-space: nowrap; }
    .tbl tbody tr { border-bottom: 1px solid var(--blue-dim); transition: background .12s; }
    .tbl tbody tr:last-child { border-bottom: none; }
    .tbl tbody tr:hover { background: rgba(219,234,254,0.25); }
    .tbl tbody td { padding: 14px 20px; font-size: 13px; vertical-align: middle; color: #0f1733; }
    .tfoot-row td { padding: 12px 20px; font-weight: 700; font-size: 13px; background: rgba(219,234,254,0.30); border-top: 1.5px solid var(--blue-border); }

    .row-num { font-size: 11px; font-family: 'JetBrains Mono', monospace; color: var(--faint); }

    .name-cell { display: flex; align-items: center; gap: 9px; }
    .avatar { width: 32px; height: 32px; border-radius: 9px; background: var(--blue-dim); border: 1.5px solid var(--blue-border); color: var(--blue); display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 800; flex-shrink: 0; font-family: 'JetBrains Mono', monospace; }
    .name-text { font-weight: 600; font-size: 13px; color: var(--blue-dark); }

    .room-pill { display: inline-flex; align-items: center; gap: 5px; background: var(--blue-dim); border: 1px solid var(--blue-border); border-radius: 8px; padding: 4px 10px; font-size: 12px; font-weight: 700; font-family: 'JetBrains Mono', monospace; color: var(--blue-dark); }
    .room-dot  { width: 5px; height: 5px; border-radius: 50%; background: var(--blue); flex-shrink: 0; }

    .amount-income  { font-weight: 700; font-family: 'JetBrains Mono', monospace; color: #059669; font-size: 13px; }
    .amount-expense { font-weight: 700; font-family: 'JetBrains Mono', monospace; color: #dc2626; font-size: 13px; }
    .date-text { font-family: 'JetBrains Mono', monospace; font-size: 12px; color: var(--muted); font-weight: 600; }

    .bulan-tags { display: flex; flex-wrap: wrap; gap: 4px; }
    .bulan-tag  { display: inline-flex; align-items: center; gap: 4px; background: var(--blue-dim); border: 1px solid var(--blue-border); border-radius: 6px; padding: 2px 7px; font-size: 11px; font-weight: 700; color: var(--blue-dark); font-family: 'JetBrains Mono', monospace; white-space: nowrap; }

    .jenis-badge { display: inline-flex; align-items: center; gap: 5px; background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.20); border-radius: 8px; padding: 4px 10px; font-size: 12px; font-weight: 700; color: #dc2626; }

    /* Ringkasan per jenis */
    .ringkasan-grid { display: grid; grid-template-columns: repeat(auto-fill,minmax(180px,1fr)); gap: 10px; padding: 16px 22px; border-bottom: 1.5px solid var(--blue-dim); }
    .ringkasan-item { background: rgba(255,255,255,0.65); border: 1.5px solid rgba(239,68,68,0.15); border-top: 2px solid #ef4444; border-radius: 10px; padding: 12px 14px; }
    .ringkasan-item-label { font-size: 10px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color: var(--muted); margin-bottom: 5px; display: flex; align-items: center; gap: 5px; }
    .ringkasan-item-value { font-size: 15px; font-weight: 800; color: #dc2626; font-family: 'JetBrains Mono', monospace; }
    .ringkasan-item-count { font-size: 11px; color: var(--faint); margin-top: 3px; }

    /* Saldo */
    .saldo-box { display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 20px 22px; flex-wrap: wrap; }
    .saldo-label   { font-size: 11px; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--muted); margin-bottom: 4px; }
    .saldo-formula { font-size: 12px; color: var(--faint); font-family: 'JetBrains Mono', monospace; }
    .saldo-val-pos { font-size: 22px; font-weight: 800; font-family: 'JetBrains Mono', monospace; color: var(--blue-dark); letter-spacing: -0.5px; }
    .saldo-val-neg { font-size: 22px; font-weight: 800; font-family: 'JetBrains Mono', monospace; color: #dc2626; letter-spacing: -0.5px; }
    .saldo-aman  { display: flex; align-items: center; gap: 7px; background: rgba(16,185,129,0.08); border: 1.5px solid rgba(16,185,129,0.22); border-radius: 10px; padding: 9px 14px; font-size: 12px; font-weight: 700; color: #059669; }
    .saldo-alert { display: flex; align-items: center; gap: 7px; background: rgba(239,68,68,0.08); border: 1.5px solid rgba(239,68,68,0.20); border-radius: 10px; padding: 9px 14px; font-size: 12px; font-weight: 700; color: #dc2626; }

    /* Empty */
    .empty-state { text-align: center; padding: 48px 32px; }
    .empty-icon  { font-size: 40px; opacity: 0.20; display: block; margin-bottom: 14px; }
    .empty-text  { font-size: 13px; color: var(--muted); }

    
</style>

<div class="page-header">
    <div class="ph-left">
        <div class="ph-kicker">Manajemen Keuangan</div>
        <div class="ph-title">Laporan Keuangan</div>
        <div class="ph-sub">Pemasukan per kamar & penghuni, rincian pengeluaran per jenis</div>
    </div>
</div>

{{-- FILTER --}}
<div class="filter-card">
    <form method="POST" action="{{ route('laporan.filter') }}">
        @csrf
        <div class="filter-grid">
            <div>
                <label class="filter-label">Bulan</label>
                <select name="bulan" class="fc" required>
                    <option value="">— Pilih Bulan —</option>
                    @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $b)
                        <option value="{{ $b }}" {{ (isset($bulanDipilih) && $bulanDipilih==$b) ? 'selected':'' }}>{{ $b }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="filter-label">Tahun</label>
                <select name="tahun" class="fc" required>
                    <option value="">— Pilih Tahun —</option>
                    @for($t = date('Y'); $t >= 2000; $t--)
                        <option value="{{ $t }}" {{ (isset($tahunDipilih) && $tahunDipilih==$t) ? 'selected':'' }}>{{ $t }}</option>
                    @endfor
                </select>
            </div>
            <div>
                <button type="submit" class="btn-filter"><i class="bi bi-search"></i> Tampilkan</button>
            </div>
        </div>
    </form>
</div>

@if(isset($bulanDipilih))

{{-- SUMMARY --}}
<div class="summary-row">
    <div class="sum-pill sum-income">
        <div class="sum-pill-label">Total Pemasukan</div>
        <div class="sum-pill-value val-income">Rp {{ number_format($totalPemasukan,0,',','.') }}</div>
        <div class="sum-pill-sub">{{ $detailPemasukan->count() }} transaksi</div>
    </div>
    <div class="sum-pill sum-expense">
        <div class="sum-pill-label">Total Pengeluaran</div>
        <div class="sum-pill-value val-expense">Rp {{ number_format($totalPengeluaran,0,',','.') }}</div>
        <div class="sum-pill-sub">{{ $detailPengeluaran->count() }} transaksi</div>
    </div>
    <div class="sum-pill sum-net">
        <div class="sum-pill-label">{{ $saldoBulanIni >= 0 ? 'Selisih' : 'Defisit' }}</div>
        <div class="sum-pill-value {{ $saldoBulanIni >= 0 ? 'val-net-pos' : 'val-net-neg' }}">
            {{ $saldoBulanIni >= 0 ? '+' : '' }}Rp {{ number_format($saldoBulanIni,0,',','.') }}
        </div>
        <div class="sum-pill-sub">{{ $bulanDipilih }} {{ $tahunDipilih }}</div>
    </div>
</div>

{{-- DETAIL PEMASUKAN --}}
<div class="sc income">
    <div class="sc-head">
        <div class="sc-head-left">
            <div class="sc-icon green"><i class="bi bi-cash-stack"></i></div>
            <div>
                <div class="sc-title">Detail Pemasukan</div>
                <div class="sc-sub">{{ $bulanDipilih }} {{ $tahunDipilih }} — rincian per kamar & penghuni</div>
            </div>
        </div>
        <div class="sc-badge badge-green"><i class="bi bi-arrow-up-circle-fill"></i> Rp {{ number_format($totalPemasukan,0,',','.') }}</div>
    </div>

    @if($detailPemasukan->count() > 0)
    <div style="overflow-x:auto">
        <table class="tbl">
            <thead>
                <tr>
                    <th style="padding-left:24px;width:44px">#</th>
                    <th>Penghuni</th>
                    <th>Kamar</th>
                    <th>Bulan Dibayar</th>
                    <th>Tanggal Catat</th>
                    <th style="text-align:right;padding-right:24px">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detailPemasukan as $p)
                <tr>
                    <td style="padding-left:24px"><span class="row-num">{{ str_pad($loop->iteration,2,'0',STR_PAD_LEFT) }}</span></td>
                    <td>
                        <div class="name-cell">
                            <div class="avatar">{{ strtoupper(substr($p->nama_penghuni,0,1)) }}</div>
                            <span class="name-text">{{ $p->nama_penghuni }}</span>
                        </div>
                    </td>
                    <td><div class="room-pill"><span class="room-dot"></span> Kamar {{ $p->nomor_kamar }}</div></td>
                    <td>
                        @if(!empty($p->bulan_dibayar))
                            <div class="bulan-tags">
                               @foreach($p->bulan_dibayar as $bln)
                                    <span class="bulan-tag"><i class="bi bi-calendar-check" style="font-size:9px"></i> {{ \Carbon\Carbon::createFromFormat('Y-m', trim($bln))->translatedFormat('M Y') }}</span>
                                @endforeach
                            </div>
                        @else
                            <span style="color:var(--faint);font-size:12px;font-style:italic">—</span>
                        @endif
                    </td>
                    <td><span class="date-text">{{ \Carbon\Carbon::parse($p->tanggal_pemasukan)->format('d M Y') }}</span></td>
                    <td style="text-align:right;padding-right:24px"><span class="amount-income">Rp {{ number_format($p->jumlah_bayar,0,',','.') }}</span></td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="tfoot-row">
                    <td colspan="5" style="color:#059669">Total Pemasukan {{ $bulanDipilih }} {{ $tahunDipilih }}</td>
                    <td style="text-align:right;padding-right:24px;color:#059669;font-family:'JetBrains Mono',monospace">Rp {{ number_format($totalPemasukan,0,',','.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
    @else
    <div class="empty-state">
        <span class="empty-icon">💰</span>
        <div class="empty-text">Belum ada pemasukan di bulan <strong>{{ $bulanDipilih }} {{ $tahunDipilih }}</strong></div>
    </div>
    @endif
</div>

{{-- DETAIL PENGELUARAN --}}
<div class="sc expense">
    <div class="sc-head">
        <div class="sc-head-left">
            <div class="sc-icon red"><i class="bi bi-receipt-cutoff"></i></div>
            <div>
                <div class="sc-title">Detail Pengeluaran</div>
                <div class="sc-sub">{{ $bulanDipilih }} {{ $tahunDipilih }} — rincian per jenis</div>
            </div>
        </div>
        <div class="sc-badge badge-red"><i class="bi bi-arrow-down-circle-fill"></i> Rp {{ number_format($totalPengeluaran,0,',','.') }}</div>
    </div>

    @if($detailPengeluaran->count() > 0)
        @if($ringkasanPengeluaran->count() > 1)
        <div class="ringkasan-grid">
           @foreach($ringkasanPengeluaran as $item)
@php $cnt = $detailPengeluaran->where('jenis_pengeluaran', $item->jenis_pengeluaran)->count(); @endphp
<div class="ringkasan-item">
    <div class="ringkasan-item-label"><i class="bi bi-tag-fill" style="font-size:9px"></i> {{ $item->jenis_pengeluaran }}</div>
    <div class="ringkasan-item-value">Rp {{ number_format($item->total,0,',','.') }}</div>
    <div class="ringkasan-item-count">{{ $cnt }} transaksi</div>
</div>
@endforeach
        </div>
        @endif
        <div style="overflow-x:auto">
            <table class="tbl">
                <thead>
                    <tr>
                        <th style="padding-left:24px;width:44px">#</th>
                        <th>Jenis Pengeluaran</th>
                        <th>Tanggal</th>
                        <th style="text-align:right;padding-right:24px">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detailPengeluaran as $e)
                    <tr>
                        <td style="padding-left:24px"><span class="row-num">{{ str_pad($loop->iteration,2,'0',STR_PAD_LEFT) }}</span></td>
                        <td><div class="jenis-badge"><i class="bi bi-tag-fill" style="font-size:9px"></i> {{ $e->jenis_pengeluaran }}</div></td>
                        <td><span class="date-text">{{ \Carbon\Carbon::parse($e->tanggal)->format('d M Y') }}</span></td>
                        <td style="text-align:right;padding-right:24px"><span class="amount-expense">Rp {{ number_format($e->jumlah,0,',','.') }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="tfoot-row">
                        <td colspan="3" style="color:#dc2626">Total Pengeluaran {{ $bulanDipilih }} {{ $tahunDipilih }}</td>
                        <td style="text-align:right;padding-right:24px;color:#dc2626;font-family:'JetBrains Mono',monospace">Rp {{ number_format($totalPengeluaran,0,',','.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    @else
    <div class="empty-state">
        <span class="empty-icon">🧾</span>
        <div class="empty-text">Belum ada pengeluaran di bulan <strong>{{ $bulanDipilih }} {{ $tahunDipilih }}</strong></div>
    </div>
    @endif
</div>

{{-- SALDO BERSIH --}}
<div class="sc net">
    <div class="saldo-box">
        <div>
            <div class="saldo-label">Saldo Bersih {{ $bulanDipilih }} {{ $tahunDipilih }}</div>
            <div class="saldo-formula">Rp {{ number_format($totalPemasukan,0,',','.') }} − Rp {{ number_format($totalPengeluaran,0,',','.') }}</div>
        </div>
        <div>
            @if($saldoBulanIni >= 0)
                <div class="saldo-val-pos">+Rp {{ number_format($saldoBulanIni,0,',','.') }}</div>
            @else
                <div class="saldo-val-neg">−Rp {{ number_format(abs($saldoBulanIni),0,',','.') }}</div>
            @endif
        </div>
        <div>
            @if($saldoBulanIni >= 0)
                <div class="saldo-aman"><i class="bi bi-check-circle-fill"></i> Keuangan bulan ini aman</div>
            @else
                <div class="saldo-alert"><i class="bi bi-exclamation-triangle-fill"></i> Defisit bulan ini!</div>
            @endif
        </div>
    </div>
</div>

@else
<div class="sc net">
    <div class="empty-state">
        <span class="empty-icon">📊</span>
        <div class="empty-text">Pilih <strong>bulan</strong> dan <strong>tahun</strong> di atas,<br>lalu klik <strong>Tampilkan</strong> untuk melihat laporan detail.</div>
    </div>
</div>
@endif

@endsection