<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KamarController extends Controller
{
    public function index()
    {
        $kamar = DB::table('kamar')->get();
        return view('kamar.index', compact('kamar'));
    }

    public function create()
    {
        return view('kamar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_kamar'     => 'required',
            'harga_sewa'      => 'required|numeric',
            'fasilitas_kamar' => 'nullable'
        ]);

        DB::table('kamar')->insert([
            'id_kamar'        => Str::uuid(),
            'nomor_kamar'     => $request->nomor_kamar,
            'harga_sewa'      => $request->harga_sewa,
            'fasilitas_kamar' => $request->fasilitas_kamar,
        ]);

        return redirect()->route('kamar')->with('success', 'Data kamar berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kamar = DB::table('kamar')
            ->where('id_kamar', $id)
            ->first();

        return view('kamar.edit', compact('kamar'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_kamar'     => 'required',
            'harga_sewa'      => 'required|numeric',
            'fasilitas_kamar' => 'nullable'
        ]);

        DB::table('kamar')
            ->where('id_kamar', $id)
            ->update([
                'nomor_kamar'     => $request->nomor_kamar,
                'harga_sewa'      => $request->harga_sewa,
                'fasilitas_kamar' => $request->fasilitas_kamar,
            ]);

        return redirect()->route('kamar')->with('success', 'Data kamar berhasil diupdate');
    }

    public function destroy($id)
    {
        DB::table('kamar')
            ->where('id_kamar', $id)
            ->delete();

        return redirect()->route('kamar')->with('success', 'Data kamar berhasil dihapus');
    }
}
