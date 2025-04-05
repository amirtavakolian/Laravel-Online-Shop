<?php

namespace Products\App\Http\Requests;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{

    public function rules(): array
    {
        // Rule::unique('products')->where('slug', $this->route('product'))->ignore($this->route('product'))
        return [
            "name" => "required|min:3",
            "brand_id" => "required|exists:brands,id",
            "slug" => ['required', 'min:3', Rule::unique('products')->ignore($this->route('product'))],
            "tags_id" => "required|exists:tags,id",
            "description" => "required|min:10",
            "category_id" => "required|exists:categories,id",
            "product_attributes" => "required|array",
            "product_attributes.*" => "min:2",
            "product_attributes_ids.*" => "integer|exists:attributes,id",
            "product_variation_id" => "required|exists:attributes,id",
            "product_variation_values" => "required|array",
            'delivery_amount' => "required",
            'delivery_amount_per_product' => 'required'
        ];
    }
}
