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
                'sewa.*',
                'penghuni.nama_penghuni',
                'kamar.nomor_kamar as nama_kamar'
            )
            ->get();

        return view('sewa.index', compact('sewa'));
    }

    public function create()
    {
        $penghuni = DB::table('penghuni')->get();
        $kamar = DB::table('kamar')
            ->where('status', 'kosong')
            ->get();

        return view('sewa.create', compact('penghuni', 'kamar'));
    }

    public function store(Request $request)
    {
        $idSewa = Str::uuid();

        // simpan data sewa
        DB::table('sewa')->insert([
            'id_sewa' => $idSewa,
            'id_penghuni' => $request->id_penghuni,
            'id_kamar' => $request->id_kamar,
            'status' => $request->status
        ]);

        // simpan pemasukan
        DB::table('pemasukan')->insert([
            'id_pemasukan' => Str::uuid(),
            'id_sewa' => $idSewa,
            'tanggal' => $request->tanggal,
            'bulan' => $request->bulan,
            'jumlah_bayar' => $request->jumlah_bayar
        ]);

        // update status kamar
        DB::table('kamar')
            ->where('id_kamar', $request->id_kamar)
            ->update(['status' => 'terisi']);

        return redirect('/sewa');
    }
}
