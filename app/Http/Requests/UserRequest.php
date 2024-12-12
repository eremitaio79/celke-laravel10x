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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ];
    }

    // Translate messages to pt-br.
    public function messages()
    {
        return [
            'name.required' => 'O campo <strong>Nome do Usuário</strong> é obrigatório.',
            'email.required' => 'O campo <strong>E-mail do Usuário</strong> é obrigatório.',
            'password.required' => 'O campo <strong>Senha do Usuário</strong> é obrigatório.',
            // 'course_id.required' => 'O campo <strong>Preço</strong> é obrigatório.',
            // 'email.email' => 'O Email deve estar em um formato válido.',
            // 'password.min' => 'A senha deve ter no mínimo :min caracteres.',
        ];
    }
}
