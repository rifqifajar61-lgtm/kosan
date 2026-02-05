<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemasukanController extends Controller
{
    public function index()
    {
        $pemasukan = DB::table('pemasukan')
            ->join('sewa', 'pemasukan.id_sewa', '=', 'sewa.id_sewa')
            ->join('kamar', 'sewa.id_kamar', '=', 'kamar.id_kamar')
            ->select(
                'pemasukan.*',
                'kamar.nomor_kamar'
            )
            ->get();

        return view('pemasukan.index', compact('pemasukan'));
    }

    public function create()
    {
        $sewa = DB::table('sewa')
            ->join('penghuni', 'sewa.id_penghuni', '=', 'penghuni.id_penghuni')
            ->join('kamar', 'sewa.id_kamar', '=', 'kamar.id_kamar')
            ->select(
                'sewa.id_sewa',
                'penghuni.nama_penghuni',
                'kamar.nomor_kamar'
            )
            ->get();

        return view('pemasukan.create', compact('sewa'));
    }

    public function store(Request $request)
    {
        DB::table('pemasukan')->insert([
            'id_pemasukan' => uniqid('PM-'),
            'id_sewa' => $request->id_sewa,
            'tanggal' => $request->tanggal,
            'bulan' => $request->bulan,
            'jumlah_bayar' => $request->jumlah_bayar,
        ]);

        return redirect('/pemasukan')->with('success', 'Data pemasukan berhasil disimpan');
    }
}
