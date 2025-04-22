<?php

namespace Products\App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "slug" => $this->slug,
            "primary_image" => $this->primary_image,
            "secondary_images" => $this->images,
            "description" => $this->description,
            "status" => $this->status,
            "is_active" => $this->is_active ? 'فعال' : 'غیر فعال',
            "delivery_amount" => $this->delivery_amount,
            "delivery_amount_per_product" => $this->delivery_amount_per_product,
            "attributes" => ProductAttributeResource::collection($this->attributes),
            "product_variation" => $this->productVariation,
            "brand_id" => new BrandResource($this->brand),
            "category_id" => new CategoryResource($this->category),
        ];
    }
}
