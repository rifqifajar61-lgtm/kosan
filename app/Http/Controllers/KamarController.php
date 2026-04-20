<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    private function formatSingkat($angka): string
    {
        if ($angka >= 1000000000) {
            return 'Rp ' . number_format($angka / 1000000000, 0, ',', '.') . ' M';
        }
        if ($angka >= 1000000) {
            return 'Rp ' . number_format($angka / 1000000, 0, ',', '.') . ' Jt';
        }
        if ($angka >= 1000) {
            return 'Rp ' . number_format($angka / 1000, 0, ',', '.') . ' Rb';
        }
        return 'Rp ' . number_format($angka, 0, ',', '.');
    }

    public function index()
    {
        $kamar = Kamar::orderBy('nomor_kamar')
                      ->orderBy('id_kamar')
                      ->paginate(5);

        $total = Kamar::count();

        return view('kamar.index', [
            'kamar'         => $kamar,
            'maxHarga'      => $total ? $this->formatSingkat((int) Kamar::max('harga_sewa')) : 'Rp 0',
            'minHarga'      => $total ? $this->formatSingkat((int) Kamar::min('harga_sewa')) : 'Rp 0',
            'totalAktif'    => Kamar::where('status_kamar','aktif')->count(),
            'totalNonaktif' => Kamar::where('status_kamar','nonaktif')->count(),
        ]);
    }

    public function create()
    {
        return view('kamar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_kamar'     => 'required|string|max:20',
            'harga_sewa'      => 'required',
            'fasilitas_kamar' => 'nullable|string',
        ]);

        // 🔥 FIX UTAMA
        $harga = (int) $request->harga_sewa;

        Kamar::create([
            'nomor_kamar'     => $request->nomor_kamar,
            'harga_sewa'      => $harga,
            'fasilitas_kamar' => $request->fasilitas_kamar,
            'status_kamar'    => 'aktif',
        ]);

        return redirect()->route('kamar')->with('success', 'Berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kamar = Kamar::findOrFail($id);
        return view('kamar.edit', compact('kamar'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_kamar'     => 'required|string|max:20',
            'harga_sewa'      => 'required',
            'fasilitas_kamar' => 'nullable|string',
            'status_kamar'    => 'required|in:aktif,nonaktif',
        ]);

        $kamar = Kamar::findOrFail($id);

        // 🔥 FIX UTAMA
        $harga = (int) $request->harga_sewa;

        $kamar->update([
            'nomor_kamar'     => $request->nomor_kamar,
            'harga_sewa'      => $harga,
            'fasilitas_kamar' => $request->fasilitas_kamar,
            'status_kamar'    => $request->status_kamar,
        ]);

        return redirect()->route('kamar')->with('success', 'Berhasil diupdate');
    }

    public function destroy($id)
    {
        Kamar::findOrFail($id)->delete();
        return redirect()->route('kamar')->with('success', 'Berhasil dihapus');
    }
}