<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            // 'password' => 'required|string|min:4|confirmed', // Adiciona validação de confirmação
        ];
    }

    // Translate messages to pt-br.
    public function messages(): array
    {
        return [
            'name.required' => 'O campo <strong>Nome do Usuário</strong> é obrigatório.',
            'email.required' => 'O campo <strong>E-mail do Usuário</strong> é obrigatório.',
            'email.email' => 'O campo <strong>E-mail</strong> deve conter um endereço válido.',
            // 'email.unique' => 'O e-mail informado já está em uso.',
            // 'password.required' => 'O campo <strong>Senha do Usuário</strong> é obrigatório.',
            // 'password.min' => 'A <strong>Senha</strong> deve ter no mínimo :min caracteres.',
            // 'password.confirmed' => 'A confirmação da <strong>Senha</strong> não corresponde.',
        ];
    }
}