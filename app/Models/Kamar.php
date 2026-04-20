<?php
// app/Models/Kamar.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kamar extends Model
{
    protected $table      = 'kamar';
    protected $primaryKey = 'id_kamar';
    protected $keyType    = 'string';
    public    $incrementing = false;

    protected $fillable = [
        'id_kamar',
        'nomor_kamar',
        'harga_sewa',
        'fasilitas_kamar',
        'status_kamar',   // ← tambahkan
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id_kamar)) {
                $model->id_kamar = (string) Str::uuid();
            }
        });
    }

    public function sewa()
    {
        return $this->hasMany(Sewa::class, 'id_kamar', 'id_kamar');
    }
}