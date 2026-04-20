@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

@php
    use Carbon\Carbon;
    $today        = Carbon::today();
    $jatuhTempo   = $sewa->jatuh_tempo;
    $hariTelat    = $sewa->hari_telat;
    $totalDenda   = $sewa->total_denda;
    $dendaPerHari = $sewa->denda_per_hari ?? 10000;
    $statusJT     = $sewa->status_jatuh_tempo;

    $namaPenghuni = optional($sewa->penghuni)->nama_penghuni ?? '-';
    $nomorKamar   = optional($sewa->kamar)->nomor_kamar ?? '-';

    $namaBulanId = [
        '01'=>'Jan','02'=>'Feb','03'=>'Mar','04'=>'Apr',
        '05'=>'Mei','06'=>'Jun','07'=>'Jul','08'=>'Agu',
        '09'=>'Sep','10'=>'Okt','11'=>'Nov','12'=>'Des',
    ];
    $fmtBulan = fn($ym) => $namaBulanId[substr($ym,5,2)] . ' ' . substr($ym,0,4);
@endphp

<style>
    .wrap { max-width: 820px; margin: 0 auto; padding: 24px 16px 48px; }

    /* Breadcrumb */
    .bc { font-size: 13px; color: #6b7280; margin-bottom: 20px; }
    .bc a { color: #6b7280; text-decoration: none; }
    .bc a:hover { color: #2563eb; }



    /* Alert */
    .alert { background: #fffbeb; border: 1px solid #fde68a; border-radius: 8px; padding: 12px 16px; margin-bottom: 16px; font-size: 13px; color: #92400e; }
    .alert b { display: block; margin-bottom: 6px; }

    /* Card */
    .card { background: #fff; border: 1px solid #e5e7eb; border-radius: 10px; margin-bottom: 16px; overflow: hidden; }
    .card-head { padding: 12px 18px; border-bottom: 1px solid #e5e7eb; font-size: 13px; font-weight: 600; color: #374151; display: flex; align-items: center; justify-content: space-between; }
    .card-body { padding: 16px 18px; }

    /* Tabel info */
    .info-table { width: 100%; font-size: 13px; border-collapse: collapse; }
    .info-table tr td { padding: 7px 0; border-bottom: 1px solid #f3f4f6; }
    .info-table tr:last-child td { border-bottom: none; }
    .info-table td:first-child { color: #6b7280; width: 140px; }
    .info-table td:last-child { font-weight: 500; text-align: right; }

    /* Denda */
    .denda-box { background: #fef2f2; border: 1px solid #fecaca; border-radius: 8px; padding: 14px; text-align: center; margin-top: 12px; }
    .denda-box .label { font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #ef4444; margin-bottom: 4px; }
    .denda-box .amount { font-size: 22px; font-weight: 700; color: #dc2626; }
    .denda-box .detail { font-size: 11px; color: #b91c1c; margin-top: 2px; }

    .state-ok   { background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 8px; padding: 12px 16px; font-size: 13px; color: #1e40af; }
    .state-warn { background: #fffbeb; border: 1px solid #fde68a; border-radius: 8px; padding: 12px 16px; font-size: 13px; color: #92400e; }
    .state-gray { background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 8px; padding: 12px 16px; font-size: 13px; color: #6b7280; }

    /* Progress bulan */
    .month-grid { display: flex; flex-wrap: wrap; gap: 4px; }
    .m-item { width: 36px; height: 36px; border-radius: 6px; display: flex; flex-direction: column; align-items: center; justify-content: center; font-size: 9px; font-weight: 600; border: 1px solid; }
    .m-paid     { background: #f0fdf4; border-color: #86efac; color: #16a34a; }
    .m-late     { background: #fef2f2; border-color: #fca5a5; color: #dc2626; }
    .m-upcoming { background: #f3f4f6; border-color: #e5e7eb; color: #9ca3af; }

    /* Tabel */
    table.tbl { width: 100%; border-collapse: collapse; font-size: 13px; }
    table.tbl th { padding: 9px 14px; text-align: left; font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: .5px; color: #6b7280; border-bottom: 1px solid #e5e7eb; background: #f9fafb; }
    table.tbl td { padding: 10px 14px; border-bottom: 1px solid #f3f4f6; vertical-align: middle; }
    table.tbl tr:last-child td { border-bottom: none; }
    table.tbl tfoot td { padding: 10px 14px; font-weight: 600; color: #059669; border-top: 1px solid #e5e7eb; background: #f0fdf4; }

    /* Pill */
    .pill { display: inline-block; font-size: 11px; font-weight: 600; padding: 2px 8px; border-radius: 20px; }
    .pill-red  { background: #fef2f2; color: #dc2626; }
    .pill-warn { background: #fffbeb; color: #d97706; }
    .pill-ok   { background: #f0fdf4; color: #059669; }
    .pill-blue { background: #eff6ff; color: #2563eb; }

    .tag { display: inline-flex; align-items: center; gap: 3px; font-size: 11px; font-weight: 500; padding: 2px 7px; border-radius: 5px; border: 1px solid; }
    .tag-blue { background: #eff6ff; border-color: #bfdbfe; color: #1d4ed8; }
    .tag-red  { background: #fef2f2; border-color: #fecaca; color: #dc2626; }

    .footer { display: flex; justify-content: flex-end; margin-top: 8px; }
    .btn-back { display: inline-flex; align-items: center; gap: 6px; padding: 8px 18px; background: #fff; border: 1px solid #d1d5db; border-radius: 8px; font-size: 13px; color: #374151; text-decoration: none; }
    .btn-back:hover { background: #f3f4f6; }
</style>

<div class="wrap">

    {{-- Breadcrumb + tombol kembali --}}
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px">
        <div class="bc" style="margin-bottom:0">
            <a href="{{ route('sewa') }}">Data Sewa</a> / {{ $namaPenghuni }}
        </div>
        <a href="{{ route('sewa') }}" class="btn-back"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>

    {{-- Page title --}}
    <div style="background:#bfdbfe; border-radius:10px; padding:20px; text-align:center; margin-bottom:16px">
        <h2 style="font-size:18px; font-weight:600; color:#111827; margin:0">Detail Sewa</h2>
        <p style="font-size:13px; color:#374151; margin:4px 0 0">Informasi lengkap kontrak dan riwayat pembayaran penghuni.</p>
    </div>

    {{-- Alert bulan belum bayar --}}
    @if(count($bulanTerlambat) > 0)
    <div class="alert">
        <b>{{ count($bulanTerlambat) }} bulan belum dibayar:</b>
        @foreach($bulanTerlambat as $bln)
            <span class="tag tag-red" style="margin-right:4px">{{ $fmtBulan($bln) }}</span>
        @endforeach
    </div>
    @endif

    {{-- Grid 2 kolom --}}
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:16px">

        {{-- Informasi Kontrak --}}
        <div class="card">
            <div class="card-head">Informasi Kontrak</div>
            <div class="card-body">
                <table class="info-table">
                    <tr><td>Penghuni</td><td>{{ $namaPenghuni }}</td></tr>
                    <tr><td>Kamar</td><td>Kamar {{ $nomorKamar }}</td></tr>
                    <tr><td>Mulai</td><td>{{ Carbon::parse($sewa->tanggal_mulai)->format('d M Y') }}</td></tr>
                    <tr><td>Selesai</td><td>{{ Carbon::parse($sewa->tanggal_selesai)->format('d M Y') }}</td></tr>
                    <tr><td>Durasi</td><td>{{ $durasiTotal }} bulan</td></tr>
                    <tr><td>Harga/Bulan</td><td>Rp {{ number_format($sewa->harga_sewa,0,',','.') }}</td></tr>
                    <tr><td>Total</td><td>Rp {{ number_format($sewa->harga_sewa * $durasiTotal,0,',','.') }}</td></tr>
                    <tr>
                        <td>Status</td>
                        <td><span class="pill {{ $sewa->status === 'aktif' ? 'pill-blue' : 'pill-ok' }}">{{ ucfirst($sewa->status) }}</span></td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- Keterlambatan --}}
        <div class="card">
            <div class="card-head">Keterlambatan</div>
            <div class="card-body">
                @if($hariTelat > 0)
                <table class="info-table">
                    <tr><td>Jatuh Tempo</td><td>{{ $jatuhTempo->format('d M Y') }}</td></tr>
                    <tr><td>Hari Ini</td><td>{{ $today->format('d M Y') }}</td></tr>
                    <tr><td>Telat</td><td style="color:#dc2626">{{ $hariTelat }} hari</td></tr>
                    <tr><td>Denda/Hari</td><td>Rp {{ number_format($dendaPerHari,0,',','.') }}</td></tr>
                </table>
                <div class="denda-box">
                    <div class="label">Total Denda</div>
                    <div class="amount">Rp {{ number_format($totalDenda,0,',','.') }}</div>
                    <div class="detail">{{ $hariTelat }} hari × Rp {{ number_format($dendaPerHari,0,',','.') }}</div>
                </div>

                @elseif($statusJT === 'jatuh')
                <div class="state-warn">Jatuh tempo hari ini, {{ $today->format('d M Y') }}. Segera lakukan pembayaran.</div>

                @elseif($statusJT === 'aman')
                @php $sisaHari = $today->diffInDays($jatuhTempo); @endphp
                <div class="state-ok">Tidak ada keterlambatan. Jatuh tempo <b>{{ $jatuhTempo->format('d M Y') }}</b> — sisa {{ $sisaHari }} hari.</div>

                @else
                <div class="state-gray">Kontrak sudah selesai.</div>
                @endif
            </div>
        </div>
    </div>

    {{-- Progress bulan --}}
    <div class="card">
        <div class="card-head">
            <span>Progress Pembayaran</span>
            <span style="font-weight:400; font-size:12px; color:#6b7280">{{ $sudahBayarCount }}/{{ $durasiTotal }} bulan ({{ $progressPct }}%)</span>
        </div>
        <div class="card-body">
            <div class="month-grid">
                @foreach($semuaBulanKontrak as $bln)
                @php
                    $isBayar = in_array($bln, $bulanSudahDibayar);
                    $isTelat = in_array($bln, $bulanTerlambat);
                    $cls = $isBayar ? 'm-paid' : ($isTelat ? 'm-late' : 'm-upcoming');
                @endphp
                <div class="m-item {{ $cls }}" title="{{ $fmtBulan($bln) }}">
                    <div>{{ $namaBulanId[substr($bln,5,2)] }}</div>
                    <div style="font-size:8px;opacity:.7">{{ substr($bln,2,2) }}</div>
                </div>
                @endforeach
            </div>
            <div style="display:flex; gap:12px; margin-top:10px; font-size:11px; color:#6b7280">
                <span>🟢 Dibayar</span>
                <span>🔴 Terlambat</span>
                <span>⚪ Belum</span>
            </div>
        </div>
    </div>

    {{-- Riwayat Pembayaran --}}
    <div class="card">
        <div class="card-head">
            <span>Riwayat Pembayaran</span>
            <span style="font-weight:400; font-size:12px; color:#6b7280">{{ $riwayatBayar->count() }} transaksi</span>
        </div>

        @if($riwayatBayar->count() > 0)
        <div style="overflow-x:auto">
            <table class="tbl">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Bulan Dibayar</th>
                        <th style="text-align:center">Telat</th>
                        <th style="text-align:right">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($riwayatBayar as $r)
                    @php
    $hariTelatTrx = 0;
    if (!empty($r->bulan_dibayar)) {
        $indexBulan   = array_search($r->bulan_dibayar[0], $semuaBulanKontrak);
        $jtBulan      = Carbon::parse($sewa->tanggal_mulai)
                            ->addMonths($indexBulan + 1)
                            ->startOfDay();
        $tglBayar     = Carbon::parse($r->tanggal_pemasukan)->startOfDay();
        if ($tglBayar->gt($jtBulan)) {
            $hariTelatTrx = (int) $tglBayar->diffInDays($jtBulan);
        }
    }
@endphp
                    <tr>
                        <td style="color:#9ca3af; font-size:12px">{{ $loop->iteration }}</td>
                        <td style="color:#6b7280; font-size:12px">{{ Carbon::parse($r->tanggal_pemasukan)->format('d M Y') }}</td>
                        <td>
                            @foreach($r->bulan_dibayar ?? [] as $bln)
                                <span class="tag tag-blue" style="margin-right:3px">{{ $fmtBulan($bln) }}</span>
                            @endforeach
                        </td>
                        <td style="text-align:center">
                            @if($hariTelatTrx > 0)
                                <span class="pill {{ $hariTelatTrx > 30 ? 'pill-red' : 'pill-warn' }}">{{ $hariTelatTrx }} hari</span>
                            @else
                                <span class="pill pill-ok">Tepat waktu</span>
                            @endif
                        </td>
                        <td style="text-align:right; font-weight:600; color:#059669">Rp {{ number_format($r->jumlah_bayar,0,',','.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">Total Terbayar</td>
                        <td style="text-align:right">Rp {{ number_format($riwayatBayar->sum('jumlah_bayar'),0,',','.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        @else
        <div style="text-align:center; padding:32px; font-size:13px; color:#9ca3af">Belum ada pembayaran.</div>
        @endif
    </div>



</div>
@endsection