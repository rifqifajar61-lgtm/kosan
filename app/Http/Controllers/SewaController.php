<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SewaController extends Controller
{
    public function index()
{
    $sewa = DB::table('sewa')
        ->join('penghuni', 'sewa.id_penghuni', '=', 'penghuni.id_penghuni')
        ->join('kamar', 'sewa.id_kamar', '=', 'kamar.id_kamar')
        ->select(
            'sewa.id_sewa',
            'penghuni.nama_penghuni',
            'kamar.nomor_kamar',
            'sewa.status'
        )
        ->get();

    $penghuni = DB::table('penghuni')->get();

    $kamar = DB::table('kamar')
        ->whereNotIn('id_kamar', function ($q) {
            $q->select('id_kamar')
              ->from('sewa')
              ->where('status', 'aktif');
        })
        ->get();

    return view('sewa.index', compact('sewa','penghuni','kamar'));
}

    public function create()
    {
        $penghuni = DB::table('penghuni')->get();

        // hanya kamar yang BELUM disewa
        $kamar = DB::table('kamar')
            ->whereNotIn('id_kamar', function ($q) {
                $q->select('id_kamar')->from('sewa')->where('status', 'aktif');
            })
            ->get();

        return view('sewa.create', compact('penghuni', 'kamar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_penghuni'      => 'required',
            'id_kamar'         => 'required',
            'status'           => 'required',
            'tanggal_pemasukan'=> 'required',
            'jumlah_bayar'     => 'required|numeric'
        ]);

        $idSewa = Str::uuid();

        // simpan SEWA
        DB::table('sewa')->insert([
            'id_sewa'     => $idSewa,
            'id_penghuni' => $request->id_penghuni,
            'id_kamar'    => $request->id_kamar,
            'status'      => $request->status
        ]);

        // simpan PEMASUKAN
        DB::table('pemasukan')->insert([
            'id_pemasukan'      => Str::uuid(),
            'id_sewa'           => $idSewa,
            'tanggal_pemasukan' => $request->tanggal_pemasukan,
            'jumlah_bayar'      => $request->jumlah_bayar
        ]);

        return redirect('/sewa')->with('success', 'Data sewa berhasil disimpan');
    }
}
