<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LivroRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo' => 'required|string|min:2|max:255',
            'ano' => 'nullable|integer|min:1000|max:' . date('Y'),
            'autor_id' => 'required|exists:autores,id',
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'O título é obrigatório.',
            'titulo.min' => 'O título deve ter pelo menos :min caracteres.',
            'titulo.max' => 'O título pode ter no máximo :max caracteres.',
            'ano.integer' => 'O ano deve ser um número inteiro.',
            'ano.min' => 'O ano deve ser maior ou igual a :min.',
            'ano.max' => 'O ano não pode ser maior que :max.',
            'autor_id.required' => 'Selecione um autor.',
            'autor_id.exists' => 'O autor selecionado não existe.',
        ];
    }
}
