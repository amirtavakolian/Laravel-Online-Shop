<?php

namespace Products\App\Actions;

use Products\App\Models\Product;

class CreateProduct
{

    public function __invoke($request, $imagesPath)
    {

        $product = Product::query()->create([
            'name' => $request->input('name'),
            'is_active' => $request->input('is_active'),
            'primary_image' => reset($imagesPath['primary_image']),
            'description' => $request->input('description'),
            'slug' => $request->input('slug'),
            'brand_id' => $request->input('brand_id'),
            'category_id' => $request->input('category_id'),
            'delivery_amount' => $request->input('delivery_amount'),
            'delivery_amount_per_product' => $request->input('delivery_amount_per_product'),
        ]);

        $product->images()->insert(
            collect($imagesPath['secondary_images'])
                ->map(fn($path) => [
                    'product_id' => $product->id,
                    'image' => $path,
                ])->toArray()
        );

        return $product;
    }
}
