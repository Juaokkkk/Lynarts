<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class ClothesRequest extends FormRequest
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
            'description' => 'string|max:255',
            'id_size' => 'integer',
            'id_style' => 'integer',
            'price' => 'decimal:2',
            'amount' => 'integer'
        ];
    }

    public function messages(): array
    {
        return [
            'description.required' => 'A descrição é obrigatória.',
            'size.required' => 'O tamanho é obrigatório.',
            'size.exists' => 'O tamanho informado não existe.',
            'style.required' => 'O estilo é obrigatório.',
            'style.exists' => 'O estilo informado não existe.',
            'price.required' => 'O preço é obrigatório.',
            'price.numeric' => 'O preço deve ser um número.',
            'price.min' => 'O preço não pode ser negativo.'
        ];
    }
}
