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
            'nama_penghuni' => 'required',
            'no_ktp' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'tanggal_masuk' => 'required',
        ]);

        DB::table('penghuni')->insert([
            'id_penghuni'   => Str::uuid(),
            'nama_penghuni' => $request->nama_penghuni,
            'no_ktp'        => $request->no_ktp,
            'no_hp'         => $request->no_hp,
            'alamat'        => $request->alamat,
            'tanggal_masuk' => $request->tanggal_masuk,
        ]);

        return redirect('/penghuni');
    }
}
