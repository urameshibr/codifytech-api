<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email'    => [
                'required',
                'exists:users,email',
            ],
            'password' => [
                'required',
                'min:8',
                'max:255',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'    => 'E-mail é obrigatório.',
            'email.exists'      => 'E-mail inválido.',
            'password.required' => 'Senha é obrigatório.',
            'password.min'      => 'Senha deve ter no mínimo 8 caracteres.',
            'password.max'      => 'Senha deve ter no máximo 255 caracteres.',
            'password.regex'    => 'Senha inválida, use letras maiúsculas, minusculas e números.',
        ];
    }
}
