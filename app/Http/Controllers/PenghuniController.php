<?php

namespace App\Http\Controllers;

use App\Models\Penghuni;
use App\Http\Requests\StorePenghuniRequest;
use App\Http\Requests\UpdatePenghuniRequest;

class PenghuniController extends Controller
{
    
public function index()
{
    $penghuni  = Penghuni::orderBy('nama_penghuni', 'asc')
                         ->orderBy('id_penghuni', 'asc') // ← tambahkan ini
                         ->paginate(5);

    $lakiLaki  = Penghuni::where('jenis_kelamin', 'Laki-laki')->count();
    $perempuan = Penghuni::where('jenis_kelamin', 'Perempuan')->count();

    return view('penghuni.index', compact('penghuni', 'lakiLaki', 'perempuan'));
}

    public function create()
    {
        return view('penghuni.create');
    }

    public function store(StorePenghuniRequest $request)
    {
        Penghuni::create($request->validated());

        return redirect()->route('penghuni')
            ->with('success', 'Penghuni berhasil ditambahkan');
    }

    public function edit($id)
    {
        $penghuni = Penghuni::findOrFail($id);

        return view('penghuni.edit', compact('penghuni'));
    }

    public function update(UpdatePenghuniRequest $request, $id)
    {
        $penghuni = Penghuni::findOrFail($id);
        $penghuni->update($request->validated());

        return redirect()->route('penghuni')
            ->with('success', 'Penghuni berhasil diperbarui');
    }

    public function destroy($id)
    {
        Penghuni::findOrFail($id)->delete();

        return redirect()->route('penghuni')
            ->with('success', 'Penghuni berhasil dihapus');
    }
}