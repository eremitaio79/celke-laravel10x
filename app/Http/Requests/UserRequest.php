<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
        // return auth()->check(); // Apenas usuários autenticados podem enviar este request.
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
            'email' => 'required',
            // 'password' => 'required|string|min:8|confirmed', // Adiciona validação de confirmação
            'roles' => 'required',
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
            'roles.required' => 'O campo <strong>Nível de Acesso</strong> é obrigatório.',
        ];
    }
}
