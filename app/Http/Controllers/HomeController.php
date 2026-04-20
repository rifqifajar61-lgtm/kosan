<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Sewa;
use App\Models\Penghuni;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Total kamar
        $totalKamar = Kamar::count();

        // Kamar terisi (dari tabel sewa)
        $kamarTerisi = Sewa::count();

        // Total penghuni
        $totalPenghuni = Penghuni::count();

        // Persentase hunian
        $persenHunian = $totalKamar > 0 
            ? round(($kamarTerisi / $totalKamar) * 100)
            : 0;

        // Pemasukan bulan ini (PAKAI jumlah_bayar)
        $totalPemasukan = Pemasukan::whereMonth('tanggal_pemasukan', Carbon::now()->month)
            ->sum('jumlah_bayar');

        // Pengeluaran bulan ini (PAKAI jumlah)
        $totalPengeluaran = Pengeluaran::whereMonth('tanggal', Carbon::now()->month)
            ->sum('jumlah');

        // Saldo
        $saldo = $totalPemasukan - $totalPengeluaran;

        return view('home', compact(
            'totalKamar',
            'kamarTerisi',
            'persenHunian',
            'totalPenghuni',
            'totalPemasukan',
            'totalPengeluaran',
            'saldo'
        ));
    }
}