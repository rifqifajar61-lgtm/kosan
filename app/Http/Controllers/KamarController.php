<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            'nama_kamar' => 'required',
            'harga' => 'required',
            'status' => 'required'
        ]);

        DB::table('kamar')->insert([
            'nama_kamar' => $request->nama_kamar,
            'harga' => $request->harga,
            'status' => $request->status
        ]);

        return redirect('/kamar');
    }
}
