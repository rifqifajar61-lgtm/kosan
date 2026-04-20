<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KamarApiController extends Controller
{
    public function index()
    {
        return response()->json(
            DB::table('kamar')->get()
        );
    }

    public function show($id)
    {
        return response()->json(
            DB::table('kamar')->where('id_kamar',$id)->first()
        );
    }

    public function store(Request $request)
    {
        $id = Str::uuid();

        DB::table('kamar')->insert([
    'id_kamar' => $id,
    'nomor_kamar' => $request->nomor_kamar,
    'harga_sewa' => $request->harga_sewa,
    'fasilitas_kamar' => $request->fasilitas_kamar,

    // 🔥 DEFAULT AKTIF
    'status_kamar' => 'aktif',

    'created_at' => now(),
    'updated_at' => now()
]);

        return response()->json([
            'success' => true,
            'id' => $id
        ]);
    }

   public function update(Request $request, $id)
{
    DB::table('kamar')
        ->where('id_kamar', $id)
        ->update([
            'nomor_kamar' => $request->nomor_kamar,
            'harga_sewa' => $request->harga_sewa,
            'fasilitas_kamar' => $request->fasilitas_kamar,

            // 🔥 INI YANG PALING PENTING
            'status_kamar' => $request->status_kamar,

            'updated_at' => now()
        ]);

    return response()->json([
        'success' => true
    ]);
}

    public function destroy($id)
    {
        DB::table('kamar')
        ->where('id_kamar',$id)
        ->delete();

        return response()->json([
            'success' => true
        ]);
    }
}