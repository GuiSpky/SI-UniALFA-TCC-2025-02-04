<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsuarioRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Permitir que qualquer usuário autenticado use a requisição (ajuste conforme sua lógica)
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => 'required|string|min:3|max:100',
            'email' => 'required|email|unique:usuarios,email',
            'telefone' => 'required|string|min:8|max:20',
            'cargo' => 'required|integer|in:1,2,3,4',
            'id_escola' => 'required|integer|exists:escolas,id',
            'senha' => 'required|string|min:6|max:50',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'O nome é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'telefone.required' => 'O telefone é obrigatório.',
            'cargo.required' => 'Selecione um cargo.',
            'cargo.in' => 'Cargo inválido.',
            'id_escola.required' => 'Selecione uma escola.',
            'id_escola.exists' => 'Escola não encontrada.',
            'senha.required' => 'A senha é obrigatória.',
            'senha.min' => 'A senha deve ter no mínimo 6 caracteres.',
        ];
    }
}
