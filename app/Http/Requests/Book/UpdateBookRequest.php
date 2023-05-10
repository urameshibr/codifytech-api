<?php

namespace App\Http\Requests\Book;

use App\Rules\ValidAuthorRule;
use App\Traits\HasFailedValidationJson;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    use HasFailedValidationJson;

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
        $id = $this->route('book');

        return [
            'title' => [
                'required',
                'string',
                'min:2',
                'max:100',
                \Illuminate\Validation\Rule::unique('books')->ignore($id),
            ],
            'page_amount' => [
                'nullable',
                'numeric',
                'min:1',
                'max:100000',
            ],
            'authors' => [
                'nullable',
                new ValidAuthorRule,
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => ':attribute é obrigatório.',
            'title.unique' => ':attribute já está cadastrado.',
            'title.min' => ':attribute deve ter pelo menos :min caracteres.',
            'title.max' => ':attribute deve ter no máximo :max caracteres.',

            'page_amount.min' => ':attribute deve ter pelo menos :min páginas.',
            'page_amount.max' => ':attribute deve ter no máximo :max páginas.',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Título',
            'page_amount' => 'Nº de páginas',
            'authors' => 'Autores',
        ];
    }
}
