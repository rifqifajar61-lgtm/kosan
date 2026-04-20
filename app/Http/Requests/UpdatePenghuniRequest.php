<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePenghuniRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

   public function rules(): array
{
    return [
        'nama_penghuni'   => 'required|string|max:255',
        'alamat_penghuni' => 'nullable|string',
        'no_ktp'          => 'required|string|max:255',
        'no_hp'           => 'required|string|max:255',
        'jenis_kelamin'   => 'required|in:Laki-laki,Perempuan',
    ];
}
}
