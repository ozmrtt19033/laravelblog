<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    // Bu method true döndürürse form request kullanıma açılır.
    public function authorize(): bool
    {
        // Şimdilik true. Daha sonra policy ile kontrol edebiliriz.
        return true;
    }

    // Validation kuralları
    public function rules()
    {
        return [
            'title'  => 'required|string|min:3|max:255',
            'content'   => 'required|string|min:10',
            'status' => 'nullable|in:draft,published',
            // eğer categories gönderiyorsan:
            // 'categories' => 'array',
            // 'categories.*' => 'exists:categories,id'
        ];
    }

    // İsteğe bağlı: Türkçe özel hata mesajları
    public function messages()
    {
        return [
            'title.required' => 'Başlık alanı zorunludur.',
            'title.min' => 'Başlık en az 3 karakter olmalı.',
            'content.required' => 'İçerik zorunludur.',
            'content.min' => 'İçerik en az 10 karakter olmalı.',
        ];
    }
}
