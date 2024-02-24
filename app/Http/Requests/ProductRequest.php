<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sku' => 'nullable|string|max:30',
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'images' => 'required',
            'brand' => 'required|string|max:20',
            'colors' => 'nullable|array',
            'colors.*' => 'exists:colors,id',
            'variation' => 'required|array',
            'variation.*' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:active,inactive,out_of_stock',
            'category_id' => 'required',
            'height' => 'required|numeric|min:1|max:500',
            'width' => 'required|numeric|min:1|max:500',
            'length' => 'required|numeric|min:1|max:500',
            'weight' => 'required|numeric|min:0.01|max:500',
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
            'price.numeric' => 'O campo price deve ser um número.',
            'category.exists' => 'A categoria selecionada não é válida.',
            'name.required' => 'O campo nome é obrigatório.',
            'description.required' => 'O campo descrição é obrigatório.',
            'images.required' => 'É necessário adicionar ao menos uma imagem.',
            'brand.required' => 'O campo marca é obrigatório.',
            'colors.*.exists' => 'A cor selecionada não é válida.',
            'variation.required' => 'É necessário adicionar variações.',
            'quantity.required' => 'O campo quantidade é obrigatório.',
            'quantity.integer' => 'A quantidade deve ser um número inteiro.',
            'quantity.min' => 'A quantidade mínima é 1.',
            'status.required' => 'O campo status é obrigatório.',
            'status.in' => 'O status selecionado é inválido.',
            'category.required' => 'O campo categoria é obrigatório.',
            'height.required' => 'O campo altura é obrigatório.',
            'height.numeric' => 'A altura deve ser um número.',
            'height.min' => 'A altura mínima é 1 cm.',
            'height.max' => 'A altura máxima é 200 cm.',
            'width.required' => 'O campo largura é obrigatório.',
            'width.numeric' => 'A largura deve ser um número.',
            'width.min' => 'A largura mínima é 1 cm.',
            'width.max' => 'A largura máxima é 200 cm.',
            'length.required' => 'O campo comprimento é obrigatório.',
            'length.numeric' => 'O comprimento deve ser um número.',
            'length.min' => 'O comprimento mínimo é 1 cm.',
            'length.max' => 'O comprimento máximo é 200 cm.',
            'weight.required' => 'O campo peso é obrigatório.',
            'weight.numeric' => 'O peso deve ser um número.',
            'weight.min' => 'O peso mínimo é 0.01 kg.',
            'weight.max' => 'O peso máximo é 500 kg.',
        ];
    }
}
