<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreKategoriRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check(); 
    }

    public function rules(): array
    {
        return [
            // Nama harus unik di antara kategori user yang sama
            'nama' => [
                'required', 
                'string', 
                'max:100',
                Rule::unique('kategoris')->where(function ($query) {
                    return $query->where('user_id', auth()->id());
                }),
            ],
            // Warna opsional, harus format hex (misal: #RRGGBB)
            'warna' => ['nullable', 'string', 'regex:/^#([a-f0-9]{6})$/i', 'max:7'], 
        ];
    }
}