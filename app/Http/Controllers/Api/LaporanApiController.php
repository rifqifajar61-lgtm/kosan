<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;

class LaporanApiController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');

        $pemasukan = Pemasukan::whereMonth('tanggal_pemasukan', $bulan)
            ->whereYear('tanggal_pemasukan', $tahun)
            ->get();

        $pengeluaran = Pengeluaran::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->get();

        $total_pemasukan = $pemasukan->sum('jumlah_bayar');
        $total_pengeluaran = $pengeluaran->sum('jumlah');

        return response()->json([
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
            'total_pemasukan' => $total_pemasukan,
            'total_pengeluaran' => $total_pengeluaran,
            'saldo' => $total_pemasukan - $total_pengeluaran
        ]);
    }
}