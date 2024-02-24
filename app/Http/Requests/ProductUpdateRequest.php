<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Você pode definir regras de autorização aqui, se necessário.
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required',
            'sku' => 'nullable|string|max:30',
            'name' => 'string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'images' => 'required|max:2048',
            'category_id' => 'required',
            'brand' => 'required|string|max:20',
            'colors' => 'nullable|array',
            'colors.*' => 'nullable|string',
            'variation' => 'required',
            'variation.*' => 'required',
            'quantity' => 'required|integer',
            'status' => 'required',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'id.required' => 'O campo ID é obrigatório.',
            'sku.max' => 'O campo SKU deve ter no máximo 30 caracteres.',
            'description.required' => 'O campo descrição é obrigatório.',
            'description.string' => 'O campo descrição deve ser uma string.',
            'price.required' => 'O campo preço é obrigatório.',
            'price.numeric' => 'O campo preço deve ser numérico.',
            'images.required' => 'O campo imagens é obrigatório.',
            'images.max' => 'O campo imagens não deve exceder 2048 kilobytes.',
            'category_id.required' => 'O campo ID da categoria é obrigatório.',
            'brand.required' => 'O campo marca é obrigatório.',
            'brand.string' => 'O campo marca deve ser uma string.',
            'brand.max' => 'O campo marca deve ter no máximo 20 caracteres.',
            'variation.required' => 'O campo variação é obrigatório.',
            'quantity.required' => 'O campo quantidade é obrigatório.',
            'quantity.integer' => 'O campo quantidade deve ser um número inteiro.',
            'status.required' => 'O campo status é obrigatório.',
        ];
    }

}
