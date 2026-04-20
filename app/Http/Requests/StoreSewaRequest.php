<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSewaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_penghuni'    => 'required|exists:penghuni,id_penghuni',
            'id_kamar'       => 'required|exists:kamar,id_kamar',
            'tanggal_masuk'  => 'required|date',
            'tanggal_keluar' => 'nullable|date|after_or_equal:tanggal_masuk',
        ];
    }
}
