<?php

namespace Products\App\Actions;

use Products\App\Models\ProductVariation;

class CreateProductAttribute
{

    public function __invoke($request, $product)
    {
        $productAttributes = [];

        $productAttributes += collect($request->input('product_attributes'))->map(function ($value, $key) {
            return [
                'attribute_id' => $key,
                'value' => $value
            ];
        })->toArray();

        $product->attributes()->sync($productAttributes);

        $productVariations = [];

        $productVariations = collect($request->input('product_variation_values'))->map(function ($value, $key) use ($request, $product) {
            $value['attribute_id'] = $request->input('product_variation_id');
            $value['product_id'] = $product->id;
            return $value;
        })->toArray();

        ProductVariation::query()->insert($productVariations);
    }
}
