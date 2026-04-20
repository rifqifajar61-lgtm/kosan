<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sewa extends Model
{
    protected $table      = 'sewa';
    protected $primaryKey = 'id_sewa';
    public    $incrementing = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'id_sewa',
        'id_penghuni',
        'id_kamar',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];

    protected $casts = [
        'tanggal_mulai'   => 'date',
        'tanggal_selesai' => 'date',
    ];

    // Relasi ke tabel penghuni
    public function penghuni()
    {
        return $this->belongsTo(Penghuni::class, 'id_penghuni', 'id_penghuni');
    }

    // Relasi ke tabel kamar
    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'id_kamar', 'id_kamar');
    }

    public function pemasukan()
{
    return $this->hasMany(\App\Models\Pemasukan::class, 'id_sewa', 'id_sewa');
}
}