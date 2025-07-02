<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:7',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.max' => 'O nome não pode ter mais que 255 caracteres.',


            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail precisa ser um endereço válido.',
            'email.unique' => 'Este e-mail já está em uso.',


            'username.required' => 'O nome de usuário é obrigatório.',
            'username.unique' => 'Este nome de usuário já está em uso.',


            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter no mínimo 7 caracteres.',
        ];
    }
}
