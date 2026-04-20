<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    private array $namaBulan = [
        1  => 'Januari',  2  => 'Februari', 3  => 'Maret',
        4  => 'April',    5  => 'Mei',       6  => 'Juni',
        7  => 'Juli',     8  => 'Agustus',   9  => 'September',
        10 => 'Oktober',  11 => 'November',  12 => 'Desember',
    ];

    public function index()
    {
        $tahunTersedia = $this->getTahunTersedia();
        return view('laporan.index', compact('tahunTersedia'));
    }

    public function filter(Request $request)
    {
        $request->validate([
            'bulan' => 'required|string',
            'tahun' => 'required|integer|min:2000|max:2100',
        ]);

        $bulanDipilih = $request->bulan;
        $tahunDipilih = (int) $request->tahun;
        $noBulan = array_search($bulanDipilih, $this->namaBulan);

        // RANGE TANGGAL (LEBIH CEPAT DARI whereMonth)
        $startDate = "$tahunDipilih-$noBulan-01";
        $endDate   = date("Y-m-t", strtotime($startDate));

        // ==============================
        // ✅ DETAIL PEMASUKAN (LIMIT)
        // ==============================
        $detailPemasukan = DB::table('pemasukan')
            ->join('sewa', 'pemasukan.id_sewa', '=', 'sewa.id_sewa')
            ->join('penghuni', 'sewa.id_penghuni', '=', 'penghuni.id_penghuni')
            ->join('kamar', 'sewa.id_kamar', '=', 'kamar.id_kamar')
            ->select(
                'pemasukan.id_pemasukan',
                'pemasukan.tanggal_pemasukan',
                'pemasukan.jumlah_bayar',
                'pemasukan.bulan_dibayar',
                'penghuni.nama_penghuni',
                'kamar.nomor_kamar'
            )
            ->whereBetween('pemasukan.tanggal_pemasukan', [$startDate, $endDate])
            ->orderBy('kamar.nomor_kamar')
            ->limit(50) // 🔥 batasi biar ringan
            ->get();

            $detailPemasukan = $detailPemasukan->map(function ($item) {
    $item->bulan_dibayar = !empty($item->bulan_dibayar)
        ? json_decode($item->bulan_dibayar, true)
        : [];
    return $item;
});
        // ==============================
        // ✅ TOTAL PEMASUKAN (DB LANGSUNG)
        // ==============================
        $totalPemasukan = DB::table('pemasukan')
            ->whereBetween('tanggal_pemasukan', [$startDate, $endDate])
            ->sum('jumlah_bayar');

        // ==============================
        // ✅ DETAIL PENGELUARAN (LIMIT)
        // ==============================
        $detailPengeluaran = DB::table('pengeluaran')
            ->select(
                'id_pengeluaran',
                'tanggal',
                'jenis_pengeluaran',
                'jumlah'
            )
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->orderBy('tanggal')
            ->limit(50) // 🔥 batasi
            ->get();

        // ==============================
        // ✅ TOTAL PENGELUARAN
        // ==============================
        $totalPengeluaran = DB::table('pengeluaran')
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->sum('jumlah');

        // ==============================
        // ✅ RINGKASAN (LANGSUNG DB)
        // ==============================
        $ringkasanPengeluaran = DB::table('pengeluaran')
            ->select('jenis_pengeluaran', DB::raw('SUM(jumlah) as total'))
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->groupBy('jenis_pengeluaran')
            ->orderByDesc('total')
            ->get();

        $saldoBulanIni = $totalPemasukan - $totalPengeluaran;
        $tahunTersedia = $this->getTahunTersedia();

        return view('laporan.index', compact(
            'bulanDipilih',
            'tahunDipilih',
            'detailPemasukan',
            'detailPengeluaran',
            'ringkasanPengeluaran',
            'totalPemasukan',
            'totalPengeluaran',
            'saldoBulanIni',
            'tahunTersedia',
        ));
    }

    private function getTahunTersedia(): array
    {
        $tahunPemasukan = DB::table('pemasukan')
            ->selectRaw('YEAR(tanggal_pemasukan) as tahun')
            ->distinct()
            ->pluck('tahun')
            ->toArray();

        $tahunPengeluaran = DB::table('pengeluaran')
            ->selectRaw('YEAR(tanggal) as tahun')
            ->distinct()
            ->pluck('tahun')
            ->toArray();

        $semua = array_unique(array_merge($tahunPemasukan, $tahunPengeluaran));

        if (empty($semua)) {
            $semua = [date('Y')];
        }

        rsort($semua);
        return $semua;
    }
}