<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Penghuni extends Model
{
    protected $table = 'penghuni';
    protected $primaryKey = 'id_penghuni';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama_penghuni',
        'alamat_penghuni',
        'no_ktp',
        'no_hp',
        'jenis_kelamin',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->id_penghuni) {
                $model->id_penghuni = (string) Str::uuid();
            }
        });
    }
}