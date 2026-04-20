<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePengeluaranRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_pengeluaran'   => 'required|string|max:255|unique:pengeluaran,id_pengeluaran',
            'tanggal'          => 'required|date',
            'jenis_pengeluaran'=> 'required|string|max:255',
            'jumlah'           => 'required|numeric',
        ];
    }
}
