<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PenghuniApiController extends Controller
{
    public function index()
{
    return response()->json(
        DB::table('penghuni')
            ->orderBy('nama_penghuni','asc')
            ->get()
    );
}

    public function show($id)
    {
        return response()->json(
            DB::table('penghuni')->where('id_penghuni',$id)->first()
        );
    }

    public function store(Request $request)
    {
        $id = Str::uuid();

        DB::table('penghuni')->insert([
            'id_penghuni'      => $id,
            'nama_penghuni'    => $request->nama_penghuni,
            'no_ktp'           => $request->no_ktp,
            'no_hp'            => $request->no_hp,
            'alamat_penghuni'  => $request->alamat_penghuni,
            'jenis_kelamin'    => $request->jenis_kelamin,
        ]);

        return response()->json([
            'success' => true,
            'id' => $id
        ]);
    }

    public function update(Request $request, $id)
    {
        DB::table('penghuni')
            ->where('id_penghuni',$id)
            ->update([
                'nama_penghuni'    => $request->nama_penghuni,
                'no_ktp'           => $request->no_ktp,
                'no_hp'            => $request->no_hp,
                'alamat_penghuni'  => $request->alamat_penghuni,
                'jenis_kelamin'    => $request->jenis_kelamin,
            ]);

        return response()->json(['success'=>true]);
    }

    public function destroy($id)
    {
        DB::table('penghuni')
            ->where('id_penghuni',$id)
            ->delete();

        return response()->json(['success'=>true]);
    }
}