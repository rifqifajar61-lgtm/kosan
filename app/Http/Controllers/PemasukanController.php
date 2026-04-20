<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Pemasukan;
use App\Models\Sewa;
use Carbon\Carbon;

class PemasukanController extends Controller
{
    // ─────────────────────────────────────────────
    // GET /pemasukan
    // ─────────────────────────────────────────────
    public function index()
    {
        $pemasukan = Pemasukan::with(['sewa.penghuni', 'sewa.kamar'])
            ->orderBy('tanggal_pemasukan', 'desc')
            ->get()
            ->each(function ($item) {
                $item->nama_penghuni = optional(optional($item->sewa)->penghuni)->nama_penghuni;
                $item->nomor_kamar   = optional(optional($item->sewa)->kamar)->nomor_kamar;
            });

        return view('pemasukan.index', compact('pemasukan'));
    }

    // ─────────────────────────────────────────────
    // GET /pemasukan/tambah
    // ─────────────────────────────────────────────
    public function create()
{
    $sewa = Sewa::with(['penghuni', 'kamar'])
        ->where('status', 'aktif')
        ->get()
        ->map(function ($s) {

            $mulai   = Carbon::parse($s->tanggal_mulai);
            $selesai = $s->tanggal_selesai
                ? Carbon::parse($s->tanggal_selesai)
                : null;

            // 20 Apr → 20 Jun = 2 bulan (bukan 3)
            $durasiTotal = $selesai
                ? (int) $mulai->diffInMonths($selesai)
                : null;

            $sudahDibayar = Pemasukan::where('id_sewa', $s->id_sewa)
                ->get()
                ->pluck('bulan_dibayar')
                ->filter()
                ->flatten()
                ->unique()
                ->count();

            $sisaKuota = $durasiTotal !== null
                ? max(0, $durasiTotal - $sudahDibayar)
                : null;

            return (object) [
                'id_sewa'         => $s->id_sewa,
                'nama_penghuni'   => optional($s->penghuni)->nama_penghuni ?? '-',
                'nomor_kamar'     => optional($s->kamar)->nomor_kamar ?? '-',
                'harga_sewa'      => optional($s->kamar)->harga_sewa ?? 0,
                'tanggal_mulai'   => $s->tanggal_mulai,
                'tanggal_selesai' => $s->tanggal_selesai,
                'durasi_total'    => $durasiTotal,
                'sudah_dibayar'   => $sudahDibayar,
                'sisa_kuota'      => $sisaKuota,
            ];
        });

        return view('pemasukan.create', compact('sewa'));
    }

    // ─────────────────────────────────────────────
    // POST /pemasukan/simpan
    // ─────────────────────────────────────────────
    public function store(Request $request)
{
    $request->validate([
        'id_sewa'           => 'required|exists:sewa,id_sewa',
        'tanggal_pemasukan' => 'required|date',
        'jumlah_bulan'      => 'required|integer|min:1',
    ]);

    $sewa      = Sewa::with('kamar')->where('id_sewa', $request->id_sewa)->firstOrFail();
    $hargaSewa = optional($sewa->kamar)->harga_sewa ?? 0;

    $mulai   = Carbon::parse($sewa->tanggal_mulai);
    $selesai = $sewa->tanggal_selesai
        ? Carbon::parse($sewa->tanggal_selesai)
        : null;

    // 20 Apr → 20 Jun = 2 bulan (bukan 3)
    $durasiTotal = $selesai
        ? (int) $mulai->diffInMonths($selesai)
        : null;

    $bulanSudahDibayar = Pemasukan::where('id_sewa', $request->id_sewa)
        ->get()
        ->pluck('bulan_dibayar')
        ->filter()
        ->flatten()
        ->unique()
        ->values()
        ->toArray();

    $sudahDibayarCount = count($bulanSudahDibayar);
    $jumlahBulan       = (int) $request->jumlah_bulan;

    if ($durasiTotal !== null) {
        $sisaKuota = $durasiTotal - $sudahDibayarCount;

        if ($sisaKuota <= 0) {
            return back()->withInput()->withErrors([
                'jumlah_bulan' => 'Semua bulan sudah lunas.'
            ]);
        }

        if ($jumlahBulan > $sisaKuota) {
            return back()->withInput()->withErrors([
                'jumlah_bulan' => 'Melebihi sisa pembayaran.'
            ]);
        }
    }

    // Bulan mulai bayar = bulan ke-(sudah+1) dihitung dari tanggal_mulai
    // Contoh: mulai Apr, sudah bayar 0 → mulai dari Apr (index 0)
    $bulanDibayarArray = [];
    for ($i = 0; $i < $jumlahBulan; $i++) {
        $bulanDibayarArray[] = $mulai->copy()
            ->addMonths($sudahDibayarCount + $i)
            ->format('Y-m');
    }

    Pemasukan::create([
        'id_pemasukan'      => Str::uuid(),
        'id_sewa'           => $request->id_sewa,
        'tanggal_pemasukan' => $request->tanggal_pemasukan,
        'jumlah_bayar'      => $jumlahBulan * $hargaSewa,
        'bulan_dibayar'     => $bulanDibayarArray,
    ]);

    return redirect()->route('pemasukan')
        ->with('success', 'Data pemasukan berhasil ditambahkan');
}
    // ─────────────────────────────────────────────
    // EDIT
    // ─────────────────────────────────────────────
   public function edit($id)
{
    $p = Pemasukan::with(['sewa.penghuni', 'sewa.kamar'])->findOrFail($id);

    $p->nama_penghuni = optional(optional($p->sewa)->penghuni)->nama_penghuni ?? '-';
    $p->nomor_kamar   = optional(optional($p->sewa)->kamar)->nomor_kamar ?? '-';

    return view('pemasukan.edit', compact('p'));
}

    // ─────────────────────────────────────────────
    // UPDATE
    // ─────────────────────────────────────────────
    public function update(Request $request, $id)
    {
        $p = Pemasukan::findOrFail($id);

        $p->update([
            'tanggal_pemasukan' => $request->tanggal_pemasukan,
            'jumlah_bayar'      => $request->jumlah_bayar,
            'bulan_dibayar'     => $request->bulan_dibayar ?? [],
        ]);

        return redirect()->route('pemasukan')
            ->with('success', 'Data pemasukan berhasil diperbarui!');
    }

    // ─────────────────────────────────────────────
    // AJAX INFO SEWA
    // ─────────────────────────────────────────────
    public function sewaInfo($id)
    {
        $sewa = Sewa::with('kamar')->where('id_sewa', $id)->firstOrFail();

        return response()->json([
            'harga_sewa' => optional($sewa->kamar)->harga_sewa ?? 0
        ]);
    }
}