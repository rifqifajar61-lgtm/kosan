<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePenghuniRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_penghuni'   => 'required|string|max:100',
            'alamat_penghuni' => 'required|string',
            'no_ktp'          => 'required|string|max:20',
            'no_hp'           => 'required|string|max:15',
            'jenis_kelamin'   => 'required|in:Laki-laki,Perempuan',
        ];
    }
}