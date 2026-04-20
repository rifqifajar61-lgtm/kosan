<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SewaApiController extends Controller
{
   public function index()
{
    $data = DB::table('sewa')
        ->join('penghuni', 'sewa.id_penghuni', '=', 'penghuni.id_penghuni')
        ->join('kamar', 'sewa.id_kamar', '=', 'kamar.id_kamar')
        ->select(
            'sewa.id_sewa',
            'sewa.id_penghuni',
            'sewa.id_kamar',
            'penghuni.nama_penghuni',
            'kamar.nomor_kamar',
            'kamar.harga_sewa',  
            'sewa.tanggal_mulai',
            'sewa.tanggal_selesai',
            'sewa.status'
        )
        ->get();

    return response()->json($data);
}

    public function store(Request $request)
    {
        DB::table('sewa')->insert([
            'id_sewa' => Str::uuid(),
            'id_penghuni' => $request->id_penghuni,
            'id_kamar' => $request->id_kamar,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => $request->status
        ]);

        return response()->json(['message'=>'Data berhasil disimpan']);
    }

    public function update(Request $request,$id)
    {
        DB::table('sewa')
        ->where('id_sewa',$id)
        ->update([
            'id_penghuni' => $request->id_penghuni,
            'id_kamar' => $request->id_kamar,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => $request->status
        ]);

        return response()->json(['message'=>'Data berhasil diupdate']);
    }

    public function destroy($id)
    {
        DB::table('sewa')->where('id_sewa',$id)->delete();

        return response()->json(['message'=>'Data berhasil dihapus']);
    }
}