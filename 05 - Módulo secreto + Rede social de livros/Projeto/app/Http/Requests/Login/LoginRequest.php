<?php

namespace App\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|min:4|max:20',
            'password' => 'required|string|min:6|max:32',
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'O nome de usuário é obrigatório.',
            'username.min' => 'O nome de usuário deve ter no mínimo :min caracteres.',
            'username.max' => 'O nome de usuário deve ter no máximo :max caracteres.',


            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter no mínimo :min caracteres.',
            'password.max' => 'A senha deve ter no máximo :max caracteres.',
        ];
    }
}
