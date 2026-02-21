<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PenghuniController extends Controller
{
    public function index()
    {
        $penghuni = DB::table('penghuni')->get();
        return view('penghuni.index', compact('penghuni'));
    }

    public function create()
    {
        return view('penghuni.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_penghuni'    => 'required',
            'no_ktp'           => 'required',
            'no_hp'            => 'required',
            'alamat_penghuni'  => 'required',
            'tanggal_masuk'    => 'required',
        ]);

        DB::table('penghuni')->insert([
            'id_penghuni'      => Str::uuid(),
            'nama_penghuni'    => $request->nama_penghuni,
            'no_ktp'           => $request->no_ktp,
            'no_hp'            => $request->no_hp,
            'alamat_penghuni'  => $request->alamat_penghuni,
            'tanggal_masuk'    => $request->tanggal_masuk,
        ]);

        return redirect()->route('penghuni')->with('success', 'Data penghuni berhasil ditambahkan');
    }

    public function edit($id)
    {
        $penghuni = DB::table('penghuni')
            ->where('id_penghuni', $id)
            ->first();

        return view('penghuni.edit', compact('penghuni'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_penghuni'    => 'required',
            'no_ktp'           => 'required',
            'no_hp'            => 'required',
            'alamat_penghuni'  => 'required',
            'tanggal_masuk'    => 'required',
        ]);

        DB::table('penghuni')
            ->where('id_penghuni', $id)
            ->update([
                'nama_penghuni'    => $request->nama_penghuni,
                'no_ktp'           => $request->no_ktp,
                'no_hp'            => $request->no_hp,
                'alamat_penghuni'  => $request->alamat_penghuni,
                'tanggal_masuk'    => $request->tanggal_masuk,
            ]);

        return redirect()->route('penghuni')->with('success', 'Data penghuni berhasil diupdate');
    }

    public function destroy($id)
    {
        DB::table('penghuni')
            ->where('id_penghuni', $id)
            ->delete();

        return redirect()->route('penghuni')->with('success', 'Data penghuni berhasil dihapus');
    }
}
