<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'cover' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'complete' => 'nullable|string',
            'favorite' => 'nullable|string',
            'stars' => 'required|integer|min:1|max:5',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'O título é obrigatório.',
            'title.string' => 'O título deve ser um texto.',
            'title.max' => 'O título não pode ter mais de 255 caracteres.',

            'author.required' => 'O autor é obrigatório.',
            'author.string' => 'O autor deve ser um texto.',
            'author.max' => 'O nome do autor não pode ter mais de 255 caracteres.',

            'cover.image'    => 'O arquivo precisa ser uma imagem válida.',
            'cover.max'      => 'O arquivo deve ter no máximo 2MB.',

            'description.string' => 'A descrição deve ser um texto.',

            'category_id.required' => 'A categoria é obrigatória.',
            'category_id.exists' => 'A categoria selecionada é inválida.',

            'complete.string' => 'O campo "completo" é inválido.',
            'favorite.string' => 'O campo "Favorito" é inválido.',

            'stars.required' => 'A classificação por estrelas é obrigatória.',
            'stars.integer' => 'A classificação por estrelas deve ser um número inteiro.',
            'stars.min' => 'A classificação mínima é 1 estrela.',
            'stars.max' => 'A classificação máxima é 5 estrelas.',
        ];
    }
}
