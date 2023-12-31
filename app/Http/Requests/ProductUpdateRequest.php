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
            'sku' => 'nullable|string|max:30',
            'name' => 'string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'images' => 'required|max:2048',
            //'category_id' => 'required|exists:categories,id',
            'brand' => 'required|string|max:20',
            'colors' => 'nullable|array', 
            'colors.*' => 'nullable|string', 
            'variation' => 'required',
            'variation.*' => 'required',
            'quantity' => 'required|integer',
            'status' => 'required',
            'category' => 'required',
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
            'price.integer' => 'O campo price deve ser um número inteiro.',
            'category_id.exists' => 'A categoria selecionada não é válida.',
        ];
    }
}
