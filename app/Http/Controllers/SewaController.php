<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Sewa;
use App\Models\Penghuni;
use App\Models\Kamar;
use Carbon\Carbon;

class SewaController extends Controller
{
    // GET /sewa
    public function index()
    {
        $today = Carbon::today();

        $sewa = Sewa::with(['penghuni', 'kamar'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->each(function ($item) use ($today) {
                $item->nama_penghuni = optional($item->penghuni)->nama_penghuni;
                $item->nomor_kamar   = optional($item->kamar)->nomor_kamar;
                $item->harga_sewa    = optional($item->kamar)->harga_sewa;

                // ── Hitung keterlambatan per bulan ──
                $mulai   = Carbon::parse($item->tanggal_mulai);
                $selesai = Carbon::parse($item->tanggal_selesai);
                // Hitung durasi dulu
                $durasiTotal = (int) $mulai->diffInMonths($selesai);

// ── Bangun daftar semua bulan dalam kontrak ──
$semuaBulanKontrak = [];
for ($i = 0; $i < $durasiTotal; $i++) {
    $semuaBulanKontrak[] = $mulai->copy()->addMonths($i)->format('Y-m');
}

                // Bulan yang sudah dibayar via Pemasukan
                $riwayatBayar = \App\Models\Pemasukan::where('id_sewa', $item->id_sewa)->get();
                $bulanSudahDibayar = $riwayatBayar
                    ->map(function ($p) {
                        $bulan = $p->bulan_dibayar;
                        if (is_string($bulan)) $bulan = json_decode($bulan, true);
                        return $bulan ?? [];
                    })
                    ->flatten()
                    ->unique()
                    ->values()
                    ->toArray();

                // Bulan belum dibayar
                $bulanBelumDibayar = array_values(array_diff($semuaBulanKontrak, $bulanSudahDibayar));

                // Bulan terlambat: belum bayar DAN sudah lewat akhir bulan tersebut
                $bulanTerlambat  = [];
                $totalHariTelat  = 0;
                $totalDenda      = 0;
                $dendaPerHari    = $item->denda_per_hari ?? 10000;

                foreach ($bulanBelumDibayar as $bln) {
                    $jatuhTempoBulan = Carbon::createFromFormat('Y-m', $bln)->endOfMonth()->startOfDay();

                    if ($today->gt($jatuhTempoBulan)) {
                        $bulanTerlambat[] = $bln;
                        $hariTelatBulan   = $jatuhTempoBulan->diffInDays($today);
                        $totalHariTelat  += $hariTelatBulan;
                        $totalDenda      += $hariTelatBulan * $dendaPerHari;
                    }
                }

                // Tentukan status jatuh tempo untuk badge warna
                if ($item->status === 'selesai') {
                    $statusJT = 'selesai';
                } elseif (count($bulanTerlambat) > 0) {
                    $statusJT = 'telat';
                } elseif (count($bulanBelumDibayar) > 0) {
                    $bulanBerikutnya   = $bulanBelumDibayar[0];
                    $jtBulanBerikutnya = Carbon::createFromFormat('Y-m', $bulanBerikutnya)->endOfMonth()->startOfDay();
                    $statusJT = $today->isSameDay($jtBulanBerikutnya) ? 'jatuh' : 'aman';
                } else {
                    $statusJT = 'lunas';
                }

                $item->bulan_terlambat   = $bulanTerlambat;
                $item->jumlah_bulan_telat = count($bulanTerlambat);
                $item->total_hari_telat  = $totalHariTelat;
                $item->total_denda       = $totalDenda;
                $item->denda_per_hari    = $dendaPerHari;
                $item->status_jt         = $statusJT;
            });

        return view('sewa.index', compact('sewa'));
    }

    // GET /sewa/tambah
    public function create()
    {
        $penghuniAktif = Sewa::where('status', 'aktif')->pluck('id_penghuni')->toArray();
        $penghuni = Penghuni::whereNotIn('id_penghuni', $penghuniAktif)
            ->orderBy('nama_penghuni')
            ->get();

        $kamarDisewa = Sewa::where('status', 'aktif')->pluck('id_kamar')->toArray();
        $kamar = Kamar::where('status_kamar', 'aktif')
                      ->whereNotIn('id_kamar', $kamarDisewa)
                      ->orderBy('nomor_kamar')
                      ->get();

        return view('sewa.create', compact('penghuni', 'kamar'));
    }

    // POST /sewa/simpan
    public function store(Request $request)
    {
        $request->validate([
            'id_penghuni'     => 'required|exists:penghuni,id_penghuni',
            'id_kamar'        => 'required|exists:kamar,id_kamar',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
        ]);

        $kamarSudahDihuni = Sewa::where('id_kamar', $request->id_kamar)
            ->where('status', 'aktif')
            ->exists();

        if ($kamarSudahDihuni) {
            $kamar = Kamar::find($request->id_kamar);
            return back()->withInput()->withErrors([
                'id_kamar' => 'Kamar ' . ($kamar->nomor_kamar ?? '') . ' sedang aktif dihuni.',
            ]);
        }

        $penghuniBerKontrak = Sewa::where('id_penghuni', $request->id_penghuni)
            ->where('status', 'aktif')
            ->exists();

        if ($penghuniBerKontrak) {
            return back()->withInput()->withErrors([
                'id_penghuni' => 'Penghuni ini sudah memiliki kontrak sewa yang aktif.',
            ]);
        }

        $existing = Sewa::where('id_penghuni', $request->id_penghuni)
            ->where('id_kamar', $request->id_kamar)
            ->where('status', 'selesai')
            ->first();

        if ($existing) {
            $existing->update([
                'tanggal_mulai'   => $request->tanggal_mulai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'status'          => 'aktif',
            ]);

            return redirect()->route('sewa')
                ->with('success', 'Kontrak sewa ' . optional($existing->penghuni)->nama_penghuni . ' berhasil diaktifkan kembali.');
        }

        Sewa::create([
            'id_sewa'         => Str::uuid(),
            'id_penghuni'     => $request->id_penghuni,
            'id_kamar'        => $request->id_kamar,
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status'          => 'aktif',
        ]);

        return redirect()->route('sewa')->with('success', 'Data sewa berhasil ditambahkan.');
    }

    // GET /sewa/edit/{id}
    public function edit($id)
    {
        $sewa = Sewa::with(['penghuni', 'kamar'])
            ->where('id_sewa', $id)
            ->firstOrFail();

        $sewa->nama_penghuni = optional($sewa->penghuni)->nama_penghuni;
        $sewa->nomor_kamar   = optional($sewa->kamar)->nomor_kamar;
        $sewa->harga_sewa    = optional($sewa->kamar)->harga_sewa;

        return view('sewa.edit', compact('sewa'));
    }

    // POST /sewa/update/{id}
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'status'          => 'required|in:aktif,selesai',
        ]);

        $sewa = Sewa::where('id_sewa', $id)->firstOrFail();

        if ($request->status === 'aktif') {
            $konflik = Sewa::where('id_kamar', $sewa->id_kamar)
                ->where('status', 'aktif')
                ->where('id_sewa', '!=', $id)
                ->exists();

            if ($konflik) {
                $kamar = Kamar::find($sewa->id_kamar);
                return back()->withInput()->withErrors([
                    'status' => 'Kamar ' . ($kamar->nomor_kamar ?? '') . ' sudah aktif dihuni orang lain.',
                ]);
            }
        }

        $sewa->update([
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status'          => $request->status,
        ]);

        return redirect()->route('sewa')->with('success', 'Data sewa berhasil diperbarui.');
    }

    // GET /sewa/hapus/{id}
    public function destroy($id)
    {
        Sewa::where('id_sewa', $id)->firstOrFail()->delete();
        return redirect()->route('sewa')->with('success', 'Data sewa berhasil dihapus.');
    }

    // GET /sewa/{id}/detail
    public function detail($id)
    {
        $sewa = Sewa::with(['penghuni', 'kamar'])->findOrFail($id);

        $sewa->nama_penghuni = optional($sewa->penghuni)->nama_penghuni;
        $sewa->nomor_kamar   = optional($sewa->kamar)->nomor_kamar;
        $sewa->harga_sewa    = optional($sewa->kamar)->harga_sewa ?? 0;

        $today   = Carbon::today();
$mulai   = Carbon::parse($sewa->tanggal_mulai);
$selesai = Carbon::parse($sewa->tanggal_selesai);

// ✅ HITUNG DULU (INI YANG KURANG)
$durasiTotal = (int) $mulai->diffInMonths($selesai);

// ── Bangun daftar semua bulan dalam kontrak ──
$semuaBulanKontrak = [];
for ($i = 0; $i < $durasiTotal; $i++) {
    $semuaBulanKontrak[] = $mulai->copy()->addMonths($i)->format('Y-m');
}

        // ── Riwayat pembayaran ──
        $riwayatBayar = \App\Models\Pemasukan::where('id_sewa', $sewa->id_sewa)
            ->orderBy('tanggal_pemasukan')
            ->get()
            ->map(function ($p) {
                $bulan = $p->bulan_dibayar;
                if (is_string($bulan)) $bulan = json_decode($bulan, true);
                $p->bulan_dibayar = $bulan ?? [];
                return $p;
            });

        // ── Bulan yang sudah dibayar ──
        $bulanSudahDibayar = $riwayatBayar
            ->pluck('bulan_dibayar')
            ->flatten()
            ->unique()
            ->values()
            ->toArray();

        // ── Bulan belum dibayar ──
        $bulanBelumDibayar = array_values(array_diff($semuaBulanKontrak, $bulanSudahDibayar));

        /*
         * ── LOGIKA KETERLAMBATAN PER BULAN ──
         *
         * Setiap bulan punya jatuh tempo sendiri = akhir bulan tersebut.
         * Contoh: bulan April (2025-04) → jatuh tempo = 30 April 2025.
         *
         * Sebuah bulan dianggap TERLAMBAT jika:
         *   1. Belum ada pembayaran yang mencakup bulan itu, DAN
         *   2. Hari ini sudah melewati akhir bulan tersebut (today > endOfMonth(bulan))
         *
         * Hari telat per bulan = selisih hari antara akhir bulan dengan hari ini.
         */
        $bulanTerlambat = [];
        $detailKeterlambatan = []; // data lengkap per bulan untuk tabel

       foreach ($bulanBelumDibayar as $bln) {
    $indexBulan      = array_search($bln, $semuaBulanKontrak);
    $jatuhTempoBulan = $mulai->copy()->addMonths($indexBulan + 1)->startOfDay();


            // Hanya terlambat jika hari ini sudah MELEWATI akhir bulan itu
           if ($today->gte($jatuhTempoBulan)) {
        $bulanTerlambat[] = $bln;

        $hariTelatBulan = (int) $today->diffInDays($jatuhTempoBulan);
        $dendaPerHari   = $sewa->denda_per_hari ?? 10000;
        $dendaBulan     = $hariTelatBulan * $dendaPerHari;

        $detailKeterlambatan[] = [
            'bulan'       => $bln,
            'jatuh_tempo' => $jatuhTempoBulan,
            'hari_telat'  => $hariTelatBulan,
            'denda'       => $dendaBulan,
            ];
            }
        }

        // ── Statistik ringkasan ──
        $durasiTotal = (int) $mulai->diffInMonths($selesai);
        $sudahBayarCount = count($bulanSudahDibayar);
        $progressPct     = $durasiTotal > 0 ? round(($sudahBayarCount / $durasiTotal) * 100) : 0;

        $dendaPerHari    = $sewa->denda_per_hari ?? 10000;
        $totalHariTelat  = array_sum(array_column($detailKeterlambatan, 'hari_telat'));
        $totalDenda      = array_sum(array_column($detailKeterlambatan, 'denda'));

        /*
         * ── Properti legacy untuk hero card & kalkulasi card ──
         *
         * Jatuh tempo yang ditampilkan di hero = jatuh tempo bulan terlambat PERTAMA
         * (atau akhir kontrak jika tidak ada keterlambatan).
         */
        if (count($bulanTerlambat) > 0) {
            $bulanPertamaTelat = $bulanTerlambat[0];
            $jatuhTempoHero    = Carbon::createFromFormat('Y-m', $bulanPertamaTelat)->endOfMonth()->startOfDay();
        } else {
            $jatuhTempoHero = Carbon::parse($sewa->tanggal_selesai);
        }

        $sewa->jatuh_tempo    = $jatuhTempoHero;
        $sewa->hari_telat     = $totalHariTelat;
        $sewa->denda_per_hari = $dendaPerHari;
        $sewa->total_denda    = $totalDenda;
        $sewa->durasi_bulan   = $durasiTotal;

        // Status hero card
        if ($sewa->status === 'selesai') {
            $sewa->status_jatuh_tempo = 'selesai';
        } elseif (count($bulanTerlambat) > 0) {
            $sewa->status_jatuh_tempo = 'telat';
        } elseif (count($bulanBelumDibayar) > 0) {
            $bulanBerikutnya   = $bulanBelumDibayar[0];
            $jtBulanBerikutnya = Carbon::createFromFormat('Y-m', $bulanBerikutnya)->endOfMonth()->startOfDay();
            $sewa->status_jatuh_tempo = $today->isSameDay($jtBulanBerikutnya) ? 'jatuh' : 'aman';
            $sewa->jatuh_tempo        = $jtBulanBerikutnya;
        } else {
            $sewa->status_jatuh_tempo = 'aman';
        }

        return view('sewa.detail', compact(
            'sewa',
            'semuaBulanKontrak',
            'bulanSudahDibayar',
            'bulanBelumDibayar',
            'bulanTerlambat',
            'detailKeterlambatan',
            'riwayatBayar',
            'durasiTotal',
            'sudahBayarCount',
            'progressPct',
            'totalHariTelat',
            'totalDenda',
            'dendaPerHari',
        ));
    }
}