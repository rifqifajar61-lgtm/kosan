<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengeluaran;
use Illuminate\Support\Str;

class PengeluaranApiController extends Controller
{
    // ===============================
    // GET DATA
    // ===============================
    public function index()
    {
        $data = Pengeluaran::orderBy('tanggal','desc')->get();

        return response()->json($data);
    }

    // ===============================
    // INSERT DATA
    // ===============================
    public function store(Request $request)
    {
        $pengeluaran = Pengeluaran::create([
            'id_pengeluaran' => Str::uuid(),
            'tanggal' => $request->tanggal,
            'jenis_pengeluaran' => $request->jenis_pengeluaran,
            'jumlah' => $request->jumlah
        ]);

        return response()->json([
            'message' => 'Pengeluaran berhasil ditambahkan',
            'data' => $pengeluaran
        ]);
    }

    // ===============================
    // UPDATE DATA
    // ===============================
    public function update(Request $request, $id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);

        $pengeluaran->update([
            'tanggal' => $request->tanggal,
            'jenis_pengeluaran' => $request->jenis_pengeluaran,
            'jumlah' => $request->jumlah
        ]);

        return response()->json([
            'message' => 'Pengeluaran berhasil diupdate'
        ]);
    }

    // ===============================
    // DELETE DATA
    // ===============================
    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $pengeluaran->delete();

        return response()->json([
            'message' => 'Pengeluaran berhasil dihapus'
        ]);
    }

    // ===============================
    // DETAIL DATA
    // ===============================
    public function show($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);

        return response()->json($pengeluaran);
    }
}