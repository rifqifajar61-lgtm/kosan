<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePemasukanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_pemasukan'     => 'required|string|max:255|unique:pemasukan,id_pemasukan',
            'id_sewa'          => 'required|exists:sewa,id_sewa',
            'tanggal_pemasukan'=> 'required|date',
            'jumlah_bayar'     => 'required|numeric',
        ];
    }
}
