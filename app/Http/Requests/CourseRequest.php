<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return false;
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
            // The validation rules should be written here.
            'name' => 'required',
            'price' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo <strong>Nome do Curso</strong> é obrigatório.',
            'price.required' => 'O campo <strong>Preço</strong> é obrigatório.',
            // 'email.email' => 'O Email deve estar em um formato válido.',
            // 'password.min' => 'A senha deve ter no mínimo :min caracteres.',
        ];
    }
}
