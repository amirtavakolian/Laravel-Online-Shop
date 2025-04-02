<?php

namespace Products\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            "name" => "required|min:3",
            "brand_id" => "required|exists:brands,id",
            "slug" => 'required|min:3|unique:products,slug',
            "tags_id" => "required|exists:tags,id",
            "description" => "required|min:10",
            "category_id" => "required|exists:categories,id",
            'primary_image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'secondary_images' => 'required|array',
            'secondary_images.*' => 'image|mimes:jpeg,png,jpg,gif',
            "product_attributes" => "required|array",
            "product_attributes.*" => "min:2",
            "product_attributes_ids.*" => "integer|exists:attributes,id",
            "product_variation_id" => "required|exists:attributes,id",
            "product_variation_values" => "required|array",
            'delivery_amount' => "required",
            'delivery_amount_per_product' => 'required'
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'product_attributes_ids' => array_keys($this->product_attributes)
        ]);
    }
}
