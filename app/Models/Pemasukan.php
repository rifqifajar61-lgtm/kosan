<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    protected $table      = 'pemasukan';
    protected $primaryKey = 'id_pemasukan';
    public    $incrementing = false;
    protected $keyType    = 'string';
    public    $timestamps = false;

    protected $fillable = [
        'id_pemasukan',
        'id_sewa',
        'tanggal_pemasukan',
        'jumlah_bayar',
        'bulan_dibayar',   // ✅ kolom baru: array bulan, e.g. ["2025-01","2025-02"]
    ];

    protected $casts = [
        'bulan_dibayar' => 'array',   // otomatis encode/decode JSON
    ];

    public function sewa()
    {
        return $this->belongsTo(Sewa::class, 'id_sewa', 'id_sewa');
    }
}