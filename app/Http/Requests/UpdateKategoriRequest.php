<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateKategoriRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'nama' => [
                'required',
                'string',
                'max:100',
                Rule::unique('kategoris')->where(function ($query) {
                    return $query->where('user_id', auth()->id());
                })->ignore($this->kategori->id),
            ],
            'warna' => ['nullable', 'string', 'regex:/^#([a-f0-9]{6})$/i', 'max:7'],
        ];
    }
}
