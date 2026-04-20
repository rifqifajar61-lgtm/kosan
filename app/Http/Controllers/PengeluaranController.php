<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;
use Illuminate\Support\Str;

class PengeluaranController extends Controller
{
    // GET /pengeluaran
    public function index()
    {
        $pengeluaran = Pengeluaran::orderBy('tanggal', 'desc')->get();
        return view('pengeluaran.index', compact('pengeluaran'));
    }

    // GET /pengeluaran/tambah
    public function create()
    {
        return view('pengeluaran.create');
    }

    // POST /pengeluaran/simpan
    public function store(Request $request)
    {
        $request->merge([
            'jumlah' => str_replace('.', '', $request->jumlah)
        ]);

        $request->validate([
            'tanggal'           => 'required|date',
            'jenis_pengeluaran' => 'required|string',
            'keterangan'        => 'nullable|string|max:255',
            'jumlah'            => 'required|numeric|min:1',
        ], [
            'tanggal.required'           => 'Tanggal pengeluaran wajib diisi.',
            'jenis_pengeluaran.required' => 'Jenis pengeluaran wajib dipilih.',
            'jumlah.required'            => 'Jumlah / nominal wajib diisi.',
            'jumlah.min'                 => 'Jumlah harus lebih dari 0.',
        ]);

        $jenis = $request->jenis_pengeluaran;
        if ($jenis === 'Lainnya' && $request->filled('keterangan')) {
            $jenis = $request->keterangan;
        }

        Pengeluaran::create([
            'id_pengeluaran'    => Str::uuid(),
            'tanggal'           => $request->tanggal,
            'jenis_pengeluaran' => $jenis,
            'jumlah'            => (int) $request->jumlah,
        ]);

        return redirect()->route('pengeluaran')
            ->with('success', 'Pengeluaran Rp ' . number_format($request->jumlah, 0, ',', '.') . ' berhasil dicatat.');
    }

    // GET /pengeluaran/{id}/edit
    public function edit($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);
        return view('pengeluaran.edit', compact('pengeluaran'));
    }

    // PUT /pengeluaran/{id}/update
    public function update(Request $request, $id)
    {
        $request->merge([
            'jumlah' => str_replace('.', '', $request->jumlah)
        ]);

        $request->validate([
            'tanggal'           => 'required|date',
            'jenis_pengeluaran' => 'required|string',
            'keterangan'        => 'nullable|string|max:255',
            'jumlah'            => 'required|numeric|min:1',
        ], [
            'tanggal.required'           => 'Tanggal pengeluaran wajib diisi.',
            'jenis_pengeluaran.required' => 'Jenis pengeluaran wajib dipilih.',
            'jumlah.required'            => 'Jumlah / nominal wajib diisi.',
            'jumlah.min'                 => 'Jumlah harus lebih dari 0.',
        ]);

        $pengeluaran = Pengeluaran::findOrFail($id);

        $jenis = $request->jenis_pengeluaran;
        if ($jenis === 'Lainnya' && $request->filled('keterangan')) {
            $jenis = $request->keterangan;
        }

        $pengeluaran->update([
            'tanggal'           => $request->tanggal,
            'jenis_pengeluaran' => $jenis,
            'jumlah'            => (int) $request->jumlah,
        ]);

        return redirect()->route('pengeluaran')
            ->with('success', 'Pengeluaran Rp ' . number_format($request->jumlah, 0, ',', '.') . ' berhasil diperbarui.');
    }
}