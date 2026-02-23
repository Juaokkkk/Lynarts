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
            'price' => 'decimal:2|min:0',
            'amount' => 'integer',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
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
            'price.min' => 'O preço não pode ser negativo.',
            'img.image' => 'O arquivo enviado deve ser uma imagem.',
            'img.mimes' => 'A imagem deve ser do tipo: jpeg, png, jpg, gif ou svg.',
            'img.max' => 'A imagem não pode ultrapassar 2MB.',
        ];
    }
}
