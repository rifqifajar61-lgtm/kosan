<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKamarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nomor_kamar'     => 'required|string|max:255',
            'harga_sewa'      => 'required|numeric',
            'fasilitas_kamar' => 'required|string',
        ];
    }
}
