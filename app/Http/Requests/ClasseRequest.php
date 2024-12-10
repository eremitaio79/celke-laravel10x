<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClasseRequest extends FormRequest
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
            // Validation request for Classe Request.
            'name' => 'required',
            // 'course_id' => 'requested',
        ];
    }

    // Translate messages to pt-br.
    public function messages()
    {
        return [
            'name.required' => 'O campo <strong>Nome da Aula</strong> é obrigatório.',
            // 'course_id.required' => 'O campo <strong>Preço</strong> é obrigatório.',
            // 'email.email' => 'O Email deve estar em um formato válido.',
            // 'password.min' => 'A senha deve ter no mínimo :min caracteres.',
        ];
    }
}
