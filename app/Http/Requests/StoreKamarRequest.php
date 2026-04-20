<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKamarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_kamar'        => 'required|string|max:255|unique:kamar,id_kamar',
            'nomor_kamar'     => 'required|string|max:255',
            'harga_sewa'      => 'required|numeric',
            'fasilitas_kamar' => 'required|string',
        ];
    }
}
