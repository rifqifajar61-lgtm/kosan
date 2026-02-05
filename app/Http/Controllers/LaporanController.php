<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index');
    }

    public function filter(Request $request)
    {
        $bulan = $request->bulan;

        // pemasukan berdasarkan kolom bulan (text)
        $pemasukan = DB::table('pemasukan')
            ->where('bulan', $bulan)
            ->get();

        // pengeluaran difilter dari nama bulan pada tanggal
        $pengeluaran = DB::table('pengeluaran')
            ->whereRaw("MONTHNAME(tanggal) = ?", [$this->bulanInggris($bulan)])
            ->get();

        $totalPemasukan = $pemasukan->sum('jumlah_bayar');
        $totalPengeluaran = $pengeluaran->sum('nominal');

        return view('laporan.index', compact(
            'pemasukan',
            'pengeluaran',
            'bulan',
            'totalPemasukan',
            'totalPengeluaran'
        ));
    }

    // helper konversi bulan Indo → Inggris
    private function bulanInggris($bulan)
    {
        $map = [
            'Januari'   => 'January',
            'Februari'  => 'February',
            'Maret'     => 'March',
            'April'     => 'April',
            'Mei'       => 'May',
            'Juni'      => 'June',
            'Juli'      => 'July',
            'Agustus'   => 'August',
            'September' => 'September',
            'Oktober'   => 'October',
            'November'  => 'November',
            'Desember'  => 'December',
        ];

        return $map[$bulan] ?? null;
    }
}
