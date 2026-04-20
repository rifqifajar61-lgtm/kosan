<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemasukan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PemasukanApiController extends Controller
{
    // ===============================
    // GET DATA PEMASUKAN
    // ===============================
    public function index()
{
    $data = DB::table('pemasukan')
        ->join('sewa', 'pemasukan.id_sewa', '=', 'sewa.id_sewa')
        ->join('penghuni', 'sewa.id_penghuni', '=', 'penghuni.id_penghuni')
        ->join('kamar', 'sewa.id_kamar', '=', 'kamar.id_kamar')
        ->select(
            'pemasukan.id_pemasukan',
            'pemasukan.id_sewa',
            'penghuni.nama_penghuni',
            'kamar.nomor_kamar',
            'pemasukan.tanggal_pemasukan',
            'pemasukan.jumlah_bayar'
        )
        ->orderBy('pemasukan.tanggal_pemasukan', 'desc')
        ->get();

    return response()->json($data);
}

    // ===============================
    // INSERT DATA
    // ===============================
    public function store(Request $request)
    {
        $pemasukan = Pemasukan::create([
            'id_pemasukan' => Str::uuid(),
            'id_sewa' => $request->id_sewa,
            'tanggal_pemasukan' => $request->tanggal_pemasukan,
            'jumlah_bayar' => $request->jumlah_bayar
        ]);

        return response()->json([
            'message' => 'Pemasukan berhasil ditambahkan',
            'data' => $pemasukan
        ]);
    }

    // ===============================
    // UPDATE DATA
    // ===============================
    public function update(Request $request, $id)
    {
        $pemasukan = Pemasukan::findOrFail($id);

        $pemasukan->update([
            'id_sewa' => $request->id_sewa,
            'tanggal_pemasukan' => $request->tanggal_pemasukan,
            'jumlah_bayar' => $request->jumlah_bayar
        ]);

        return response()->json([
            'message' => 'Pemasukan berhasil diupdate'
        ]);
    }

    // ===============================
    // DELETE DATA
    // ===============================
    public function destroy($id)
    {
        $pemasukan = Pemasukan::findOrFail($id);
        $pemasukan->delete();

        return response()->json([
            'message' => 'Pemasukan berhasil dihapus'
        ]);
    }

    // ===============================
    // SHOW DETAIL
    // ===============================
    public function show($id)
    {
        $pemasukan = Pemasukan::findOrFail($id);

        return response()->json($pemasukan);
    }
}