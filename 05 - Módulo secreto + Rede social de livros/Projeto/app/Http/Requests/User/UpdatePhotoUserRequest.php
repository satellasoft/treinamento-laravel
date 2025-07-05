<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePhotoUserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'photo' => 'required|image|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'photo.required' => 'Selecione uma imagem.',
            'photo.image'    => 'O arquivo precisa ser uma imagem válida.',
            'photo.max'      => 'O arquivo deve ter no máximo 2MB.',
        ];
    }
}
