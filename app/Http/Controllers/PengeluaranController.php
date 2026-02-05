<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengeluaranController extends Controller
{
    public function index()
    {
        $pengeluaran = DB::table('pengeluaran')->get();
        return view('pengeluaran.index', compact('pengeluaran'));
    }

    public function create()
    {
        return view('pengeluaran.create');
    }

    public function store(Request $request)
    {
        // validasi sederhana
        $request->validate([
            'tanggal' => 'required|date',
            'jenis_pengeluaran' => 'required',
            'nominal' => 'required|numeric',
        ]);

        DB::table('pengeluaran')->insert([
            'id_pengeluaran'   => uniqid('PG-'),
            'tanggal'          => $request->tanggal,
            'jenis_pengeluaran'=> $request->jenis_pengeluaran,
            'nominal'          => $request->nominal,
        ]);

        return redirect('/pengeluaran');
    }
}
