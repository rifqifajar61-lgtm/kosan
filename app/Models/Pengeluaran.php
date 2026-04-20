<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'pengeluaran'; // ← TAMBAH INI

    protected $primaryKey = 'id_pengeluaran';
    public $incrementing  = false;
    protected $keyType    = 'string';

    protected $fillable = [
        'id_pengeluaran',
        'tanggal',
        'jenis_pengeluaran',
        'jumlah',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jumlah'  => 'integer',
    ];
}