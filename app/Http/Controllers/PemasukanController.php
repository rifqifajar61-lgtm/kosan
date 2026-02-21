<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PemasukanController extends Controller
{
    public function index()
    {
        // DATA PEMASUKAN
        $pemasukan = DB::table('pemasukan')
            ->join('sewa', 'pemasukan.id_sewa', '=', 'sewa.id_sewa')
            ->join('penghuni', 'sewa.id_penghuni', '=', 'penghuni.id_penghuni')
            ->join('kamar', 'sewa.id_kamar', '=', 'kamar.id_kamar')
            ->select(
                'pemasukan.id_pemasukan',
                'pemasukan.tanggal_pemasukan',
                'pemasukan.jumlah_bayar',
                'penghuni.nama_penghuni',
                'kamar.nomor_kamar'
            )
            ->orderBy('pemasukan.tanggal_pemasukan','desc')
            ->get();

        // 🔥 DATA SEWA UNTUK DROPDOWN MODAL
        $sewa = DB::table('sewa')
            ->join('penghuni', 'sewa.id_penghuni', '=', 'penghuni.id_penghuni')
            ->join('kamar', 'sewa.id_kamar', '=', 'kamar.id_kamar')
            ->where('sewa.status', 'aktif')
            ->select(
                'sewa.id_sewa',
                'penghuni.nama_penghuni',
                'kamar.nomor_kamar'
            )
            ->orderBy('penghuni.nama_penghuni')
            ->get();

        return view('pemasukan.index', compact('pemasukan','sewa'));
    }

    public function create()
    {
        // (Optional kalau masih punya halaman create terpisah)
        $sewa = DB::table('sewa')
            ->join('penghuni', 'sewa.id_penghuni', '=', 'penghuni.id_penghuni')
            ->join('kamar', 'sewa.id_kamar', '=', 'kamar.id_kamar')
            ->where('sewa.status', 'aktif')
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
        $request->validate([
            'id_sewa'           => 'required',
            'tanggal_pemasukan' => 'required|date',
            'jumlah_bayar'      => 'required|numeric|min:0'
        ]);

        DB::table('pemasukan')->insert([
            'id_pemasukan'      => Str::uuid(),
            'id_sewa'           => $request->id_sewa,
            'tanggal_pemasukan' => $request->tanggal_pemasukan,
            'jumlah_bayar'      => $request->jumlah_bayar,
            'created_at'        => now(),
            'updated_at'        => now()
        ]);

        return redirect('/pemasukan')->with('success','Data pemasukan berhasil disimpan');
    }
}