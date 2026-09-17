<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AutorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string|min:3|max:255',
            'nacionalidade' => 'nullable|string|min:3|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome do autor é obrigatório.',
            'nome.min' => 'O nome deve ter pelo menos :min caracteres.',
            'nome.max' => 'O nome pode ter no máximo :max caracteres.',
            'nacionalidade.min' => 'A nacionalidade deve ter pelo menos :min caracteres.',
            'nacionalidade.max' => 'A nacionalidade pode ter no máximo :max caracteres.',
        ];
    }
}
