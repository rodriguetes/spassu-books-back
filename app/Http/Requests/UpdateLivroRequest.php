<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLivroRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => [
                'required',
                'string',
                'max:40',
            ],
            'editora' => [
                'required',
                'string',
                'max:40',
            ],
            'edicao' => [
                'integer',
                'required',
            ],
            'ano_publicacao' => [
                'required',
                'max:4',
            ],
            'valor' => [
                'numeric',
                'required',
            ],
            'autores' => [
                'required',
                'array',
                'exists:autor,id'
            ],
            'assuntos' => [
                'required',
                'array',
                'exists:assunto,id'
            ]
        ];
    }
}
