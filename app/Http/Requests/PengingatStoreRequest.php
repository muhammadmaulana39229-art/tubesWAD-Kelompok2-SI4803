<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengingatStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Semua user yang login diizinkan membuat pengingat
        return true; 
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            
            // Aturan Kunci: Waktu harus sekarang atau di masa depan
            'waktu_pengingat' => [
                'required', 
                'date', 
                'after_or_equal:now' 
            ],
        ];
    }
    
    /**
     * Customize the validation messages.
     */
    public function messages(): array
    {
        return [
            'waktu_pengingat.after_or_equal' => 'Waktu pengingat harus berupa waktu sekarang atau di masa depan.',
        ];
    }
}