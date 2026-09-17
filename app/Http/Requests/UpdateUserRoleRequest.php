<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'role' => ['required', Rule::in(array_keys(User::ROLES))],
        ];
    }

    public function messages(): array
    {
        return [
            'role.required' => 'Selecione um nível de acesso.',
            'role.in' => 'O nível de acesso selecionado é inválido.',
        ];
    }
}
