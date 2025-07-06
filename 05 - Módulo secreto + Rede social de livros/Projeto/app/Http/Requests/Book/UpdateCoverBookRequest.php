<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCoverBookRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cover' => 'required|image|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'cover.required' => 'Selecione uma imagem.',
            'cover.image'    => 'O arquivo precisa ser uma imagem válida.',
            'cover.max'      => 'O arquivo deve ter no máximo 2MB.',
        ];
    }
}
